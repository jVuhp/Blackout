<?php
session_start();
require_once('../config.php');
require_once('../function.php');


if ($_POST['result'] == 'download') {
	
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$view_type = $_POST['view_type'];
	$hiddenColumns = [];
	$columnMappings = array(
		'id' => lang($messages, 'download', 'content', 'table', 'id'), 
		'user' => lang($messages, 'download', 'content', 'table', 'user'),
		'file' => lang($messages, 'download', 'content', 'table', 'file'),
		'code' => lang($messages, 'download', 'content', 'table', 'code'),
		'since' => lang($messages, 'download', 'content', 'table', 'since')
	);
	$columnDisplay = array();
	$exploder = array();
	$remplacer = array();
	$limiter = array('column' => 'user', 'result' => userDev('id', $_SESSION['dbb_user']['id']), 'permission' => 'dbb.download.other');
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	if (has('dbb.download.*') OR has('dbb.download.erase')) $buttons = '<a href="' . URI . '/download/:id:" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="Erase"><i class="fa fa-erase"></i></a>';
	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'download\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 'column_start' => '<tr class="license">', 'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>Actions</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => false ],
		'type' => [ 'database' => 'download' ],
	);
	
	$other = array(
		'user' => [
			'table' => $dbb_user, 
			'explode' => false, 
			'type' => 'id', 
			'id' => ':user:',
			'result' => '<div class="media align-items-center"><a href="' . URI . '/user/:id:" class="mr-3"><img src=":avatar:" style="width: 48px; height: 48px; border-radius: 10%;"></a> <div class="media-body"><h5 class="mb-0 text-sm"><b>:username:</b></h5><h6 class="text-muted">:udid:</h6></div></div>',
			'unknown' => ':user:'
		],
	);
	
	echo createTable($dbb_download, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter, '', $view_type);
	closeDBConnection();
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

if ($_POST['result'] == 'downloadItems') {
	
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
		$docsSQL = $connx->prepare("SELECT * FROM `$dbb_basket_checkout` WHERE `user` = ? AND `type` = 'completed';");
		$docsSQL->execute([$_SESSION['dbb_user']['id']]);
		if ($docsSQL->RowCount() > 0) {
			while ($docs = $docsSQL->fetch(PDO::FETCH_ASSOC)) {
				
			$transactionSQL = $connx->prepare("SELECT * FROM `$dbb_basket_payment` WHERE `user` = ? AND `transaction_id` = ?;");
			$transactionSQL->execute([$_SESSION['dbb_user']['id'], $docs['transaction_id']]);
			if ($transaction = $transactionSQL->fetch(PDO::FETCH_ASSOC)) {
				
				$productSQL = $connx->prepare("SELECT * FROM `$dbb_product_actions` WHERE `product` = ?;");
				$productSQL->execute([$transaction['product']]);
				$product = $productSQL->fetch(PDO::FETCH_ASSOC);
				
				$productsSQL = $connx->prepare("SELECT * FROM `$dbb_product` WHERE `id` = ?;");
				$productsSQL->execute([$product['product']]);
				$products = $productsSQL->fetch(PDO::FETCH_ASSOC);
				
				$json_data = $product['data'];
				$datas = json_decode($json_data, true);
				$file_download_count = count($datas['file_download']);
				foreach ($datas['file_download'] as $file) {
					
					$basename = basename($file['name']);
					$filename_without_extension = pathinfo($basename, PATHINFO_FILENAME);
			
				echo '<li class="border-top-0 downloadlistfile" data-id="' . $docs['id'] . '" data-file="' . $file['name'] . '" data-secret="' . $file['id'] . '">
    <div class="row d-flex align-items-center">
        <a class="col-9 passive-link" style="text-decoration: none;" href="#" onclick="event.preventDefault();">
            <div class="package-name d-inline-block ml-3">
                <h5 class="mb-0" style="font-size: 15px !important;">' . $filename_without_extension . '</h5>
            </div>
        </a>
        <div class="col-3 text-right d-flex align-items-center justify-content-end">
            <button class="btn btn-primary download_files" data-file="' . $file['name'] . '" data-secret="' . $file['id'] . '">
                <i class="ti ti-' . lang($messages, 'download', 'header', 'icon') . '"></i> 
                ' . lang($messages, 'download', 'content', 'buttons', 'download') . '
            </button>
        </div>
    </div>
</li>';
				}
			}
			}
		}
		
		closeDBConnection();
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

/* LICENSE TABLE */
if ($_POST['result'] == 'license') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
		

	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$view_type = $_POST['view_type'];
	$hiddenColumns = ["id", "ip", "activity", "custom_addons", "addons", "reason"];
	$columnMappings = array(
		'client' => lang($messages, 'license', 'content', 'table', 'client'), 
		'key' => lang($messages, 'license', 'content', 'table', 'key'), 
		'product' => lang($messages, 'license', 'content', 'table', 'product'), 
		'expire' => lang($messages, 'license', 'content', 'table', 'expire'), 
		'status' => lang($messages, 'license', 'content', 'table', 'status', 'name'), 
		'since' => lang($messages, 'license', 'content', 'table', 'since')
	);
	$columnDisplay = array();
	$exploder = array();
	$remplacer = array(
		'status' => [
			'1' => '<i class="text-success fa-solid fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'license', 'content', 'table', 'status', 'active') . '"></i>', 
			'0' => '<i class="text-danger fa-regular fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'license', 'content', 'table', 'status', 'inactive') . '"></i>'
		], 
		'expire' => ['strtotime' => ':expire:']
	);
	$limiter = array('column' => 'client', 'result' => userDev('udid', $_SESSION['dbb_user']['id']), 'permission' => 'dbb.admin.license.other');
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$btn_icon = '<i class="fa fa-gear"></i>';
	$buttons = '<div role="group">';
	$buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2" onclick="copyText(\':key:\');" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'license', 'content', 'table', 'buttons', 'copy_key', 'tooltip') . '">' . lang($messages, 'license', 'content', 'table', 'buttons', 'copy_key', 'text') . '</a>';
	$buttons .= '<a href="' . URI . '/license/:id:" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'license', 'content', 'table', 'buttons', 'overview', 'tooltip') . '">' . lang($messages, 'license', 'content', 'table', 'buttons', 'overview', 'text') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.clone') OR has('dbb.admin.license.edit') OR has('dbb.admin.license.erase') OR has('dbb.admin.license.regenerate') OR has('dbb.admin.license.resetips') OR has('dbb.admin.license.resetlogs')) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; width: 32px; height: 32px;" data-bs-toggle="dropdown" aria-expanded="false">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'text') . '</a><div class="dropdown-menu">';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.clone')) $buttons .= '<a href="#" class="dropdown-item licenseClonation" data-id=":id:">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'clone') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.edit')) $buttons .= '<a href="' . URI . '/license/:id:/edit" class="dropdown-item">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'edit') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.erase')) $buttons .= '<a href="#" class="dropdown-item erase" data-id=":id:" data-type="license">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'erase') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.clone') OR has('dbb.admin.license.edit') OR has('dbb.admin.license.erase') OR has('dbb.admin.license.regenerate') OR has('dbb.admin.license.resetips') OR has('dbb.admin.license.resetlogs')) $buttons .= '<hr class="dropdown-divider">';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.regenerate')) $buttons .= '<a href="#" class="dropdown-item licenseRefreshKey" data-id=":id:">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'refresh') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.resetips')) $buttons .= '<a href="#" class="dropdown-item licenseResetIps" data-id=":id:">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'reset_ips') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.resetlogs')) $buttons .= '<a href="#" class="dropdown-item licenseResetLogs" data-id=":id:">' . lang($messages, 'license', 'content', 'table', 'buttons', 'settings', 'reset_logs') . '</a>';
	if (has('dbb.admin.license.*') OR has('dbb.admin.license.clone') OR has('dbb.admin.license.edit') OR has('dbb.admin.license.erase') OR has('dbb.admin.license.regenerate') OR has('dbb.admin.license.resetips') OR has('dbb.admin.license.resetlogs')) if (has('dbb.admin.license.resetlogs')) $buttons .= '</div>';
	$buttons .= '<a href="#" width="16" height="16" class="btn-a claim_gift_addons rounded-circle border" data-id=":id:" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'license', 'content', 'table', 'buttons', 'gift', 'tooltip') . '">' . lang($messages, 'license', 'content', 'table', 'buttons', 'gift', 'text') . '</a></div>';
	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'license\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 'column_start' => '<tr class="license">', 'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'license', 'content', 'table', 'no_results') . '</td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>' . lang($messages, 'license', 'content', 'table', 'actions') . '</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => true ],
		'type' => [ 'database' => 'license' ],
	);
	
	$other = array(
		'client' => [
			'table' => $dbb_user, 
			'explode' => false, 
			'type' => 'udid', 
			'id' => ':client:',
			'result' => ':username:',
			'unknown' => '<i class="text-danger fa-regular fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'error', 'user_unknown') . '"></i> :client:'
		],
	);
	
	echo createTable($dbb_license, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter, '', $view_type);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}


/* PRODUCT TABLE */
if ($_POST['result'] == 'product') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "icon_bg", "icon", "id_name", "tebex", "status"];
	$columnMappings = array(
		'icon_type' => lang($messages, 'product', 'content', 'table', 'icon'), 
		'name' => lang($messages, 'product', 'content', 'table', 'name'), 
		'description' => lang($messages, 'product', 'content', 'table', 'description'), 
		'price' => lang($messages, 'product', 'content', 'table', 'price'), 
		'version' => lang($messages, 'product', 'content', 'table', 'version'), 
		'since' => lang($messages, 'product', 'content', 'table', 'since'),
	);
	$columnDisplay = array();
	$exploder = array();
	$remplacer = array(
		'icon_type' => [
			'1' => '<img src=":icon:" class=":icon_bg:" width="48px" height="48px" alt="DevByBit" style="padding: 3px; border-radius: 5px;">', 
			'0' => '<h5 class=":icon_bg:" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;">:icon:</h5>'
		]
	);
	$limiter = array();
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$btn_icon = '<i class="fa fa-gear"></i>';
	$buttons = '';
	if (TEBEX_PAYMENT) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2 add_to_cart" data-id=":id:" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'product', 'content', 'table', 'buttons', 'add_to_cart', 'tooltip') . '">' . lang($messages, 'product', 'content', 'table', 'buttons', 'add_to_cart', 'text') . '</a>';

	if (has('dbb.admin.product.*') OR has('dbb.admin.product')) $buttons .= '<a href="' . URI . '/product/:id:" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'product', 'content', 'table', 'buttons', 'overview', 'tooltip') . '">' . lang($messages, 'product', 'content', 'table', 'buttons', 'overview', 'text') . '</a>';
	if (has('dbb.admin.product.*') OR has('dbb.admin.product.clone') OR has('dbb.admin.product.edit') OR has('dbb.admin.product.erase')) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; width: 32px; height: 32px;" data-bs-toggle="dropdown" aria-expanded="false">' . lang($messages, 'product', 'content', 'table', 'buttons', 'settings', 'icon') . '</a><div class="dropdown-menu">';
	if (has('dbb.admin.product.*') OR has('dbb.admin.product.clone')) $buttons .= '<a href="#" class="dropdown-item  productClonation" data-id=":id:">' . lang($messages, 'product', 'content', 'table', 'buttons', 'settings', 'clone') . '</a>';
	if (has('dbb.admin.product.*') OR has('dbb.admin.product.edit')) $buttons .= '<a href="' . URI . '/product/:id:/edit" class="dropdown-item">' . lang($messages, 'product', 'content', 'table', 'buttons', 'settings', 'edit') . '</a>';
	if (has('dbb.admin.product.*') OR has('dbb.admin.product.erase')) $buttons .= '<a href="#" class="dropdown-item erase" data-id=":id:" data-type="product">' . lang($messages, 'product', 'content', 'table', 'buttons', 'settings', 'erase') . '</a>';
	if (has('dbb.admin.product.*') OR has('dbb.admin.product.clone') OR has('dbb.admin.product.erase') OR has('dbb.admin.product.edit')) $buttons .= '</div>';

	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'product\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 'column_start' => '<tr class="product">', 'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'product', 'content', 'table', 'no_results') . '</td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>' . lang($messages, 'product', 'content', 'table', 'actions') . '</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => true ],
		'type' => [ 'database' => 'product' ],
	);
	$other = array();
	$length = array('description' => 40);
	
	echo createTable($dbb_product, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter, $length);
	closeDBConnection();
}

if ($_POST['result'] == 'keys_list_actions') {
	$new_id = randomCode(6, 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789');
	
	echo '<section class="article mb-2" data-id="' . $new_id . '">' .
	 '<div class="article-header"><div class="d-flex justify-content-between align-items-lg-center"><h3>Configuration for license generation #' . $new_id . '</h3><span><a href="#" class="btn-a" id="preview-erase" data-id="' . $new_id . '"><i class="fa fa-xmark"></i></a><a href="#" class="btn-a" id="preview-list" data-id="' . $new_id . '"><i class="fa fa-chevron-down"></i></a></span></div></div>' .
	 '<div class="article-body" data-id="' . $new_id . '" style="display: none;"><div class="mb-3"><div class="row d-flex align-items-center"><div class="col-md-6 col-sm-12 mb-3">' .
	 '<label for="ips" class="d-flex justify-content-between align-items-lg-center mb-2"><span>IP Cap</span> <span><i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="License overuse limiter, Limiting up to * ips in the license."></i> </span></label><input type="number" class="form-control" placeholder="5" value="5" id="ips" name="ips"></div>' .
	 '<div class="col-md-6 col-sm-12 mb-3"><label for="expire" class="d-flex justify-content-between align-items-lg-center mb-2"><span>Expiration <a href="#" class="expire_time_text' . $new_id . '" data-id="' . $new_id . '">Days</a></span> <div role="group"><a href="#" width="16" height="16" class="" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-warning fa fa-gear"></i></a><div class="dropdown-menu"><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Seconds">Seconds</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Minutes">Minutes</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Hours">Hours</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Days">Days</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Months">Months</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Years">Years</a><a href="#" class="dropdown-item change-time-expire" data-id="' . $new_id . '" data-type="Never">Never</a></div></div></label>' .
	 '<div class="input-group"><button type="button" style="border-radius: 3px 0px 0px 3px;"><i class="fa fa-calendar"></i></button><input type="text" hidden value="Days" id="expire_time' . $new_id . '" name="expire_time" data-id="' . $new_id . '"><input type="number" class="form-control" value="1" autocomplete="expiration" style="border-radius: 0px 3px 3px 0px !important;" placeholder="Expiration" id="expire" name="expire"></div></div></div></div>' .
	 '<div class="mb-3">' .
	 '<div class="row d-flex align-items-center"><div class="col-md-8"><label for="addons" class="mb-2">Custom Addons</label></div><div class="col-md-4" align="right">Addons <span id="quantAddons' . $new_id . '">0</span> of <span id="maxQuantAddons">5</span></div>' .
	 '</div><section class="custom-addons"></section><div class="custom-addons-add"><i class="fa fa-plus" style="margin-right: 7px;"></i> Custom Addons</div></div>' .
	 '<div class="mb-3">' .
	 '<label for="addons" class="mb-2">Addons</label>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="bound" name="bound" type="checkbox" value="1" checked /><label class="cbx" for="bound"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Only accept the type of product placed. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you try to use the license with another product, This action will not accept that request."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="ip_log" name="ip_log" type="checkbox" value="1" checked /><label class="cbx" for="ip_log"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Obtain and save the IP\'s that use this license.</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="logs" name="logs" type="checkbox" value="1" checked /><label class="cbx" for="logs"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Save any type of logs. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="IP log does not count in this option."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="delete_ips" name="delete_ips" type="checkbox" value="1" /><label class="cbx" for="delete_ips"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Delete the IPs used every so often after making another request. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="It will delete all the IPs used and that an exact time has passed since their last use."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="limit" name="limit" type="checkbox" value="1" /><label class="cbx" for="limit"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Set frozen status if the license has 100 requests in 1 hour. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="When the license has more than 100 requests in less than 1 hour, freeze it for 1 day. This could help you maintain very high security. It is recommended if the requests are not made by the server."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="product_verify" name="product_verify" type="checkbox" value="1" /><label class="cbx" for="product_verify"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>The product has to be in the products category. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you activate this, if the product is not found in the product category, it will automatically deny the requests. Unless it exists. With this you will also get the latest version of the product in case you want to make an update message."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="require_version" name="require_version" type="checkbox" value="1" /><label class="cbx" for="require_version"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>The version of the request must be the same as that of the mandatory product. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="If you want to make the key require that the version of the request be the same as the current version of the product, you can enable this option."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="expire_erase" name="expire_erase" type="checkbox" value="1" /><label class="cbx" for="expire_erase"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Delete the key if it is expired.</span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="send_discord" name="send_discord" type="checkbox" value="1" /><label class="cbx" for="send_discord"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Send message to the client\'s private message on discord. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="For this function, the bot token, secret key and client id must be configured. By activating this function, it may take 1-5 seconds for creation."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '<div class="checkbox-wrapper-4 mb-1"><input class="inp-cbx" id="send_webhook" name="send_webhook" type="checkbox" value="1" checked /><label class="cbx" for="send_webhook"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span><span>Send a message to the discord webhook, When creating the license. <i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="It is necessary to have configured the webhook url for this function to work."></i></span></label><svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg></div>' .
	 '</div></div>' .
	'</section>';
}


if ($_POST['result'] == 'basket') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "user", "basket", "tebex_product", "quantity", "expire", "since", "cost"];
	$columnMappings = array();
	$columnDisplay = array();
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = '';
	$limiter = array('column' => 'user', 'result' => $_SESSION['dbb_user']['id'], 'permission' => 'dbb.admin.basket.other');
	
	$buttons = '<a href="#" width="16" height="16" class="btn-a remove_of_basket mr-2" data-id=":id:" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'basket', 'content', 'remove') . '"><i class="fa fa-xmark"></i></a>';
	
	$template = array(
		'header' => [
			'title' => '<div class="package-page mb-3" id="packages-card-body"><div class="categories"><div class="category" id="group_list">', 
			'column_start' => '', 
			'column_body' => '', 
			'column_end' => '<ul class="packages mb-0 collapse show ntp-packages" id="groups_list">' 
		],
		'body' => [ 
			'column_start' => '<li class="border-top-0" data-id=":id:">', 
			'column_body' => '<div class="row d-flex align-items-center">:column_name: <div class="col-2" id="price_art_:id:">$:cost: USD</div> <div class="col-2"><a href="#" class="btn-a-success up_quantity_update" data-id=":id:"><i class="fa fa-plus"></i></a> <span class="basket_quantity" id="quantity_:id:">:quantity:</span> <a href="#" class="btn-a-danger down_quantity_update" data-id=":id:"><i class="fa fa-minus"></i></a></div> <div class="col-2 text-right d-flex align-items-center justify-content-end">' . $buttons . '</div></div>', 
			'column_end' => '</li>', 
			'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'basket', 'content', 'table', 'no_results') . '</td>',
			'enable' => false
		],
		'footer' => [ 'column_close' => '</ul>', 'title_end' => '</div></div></div>' ],
		'actions' => [ 'header_column' => '', 'body_column' => ':action_btn:', 'enable' => false ],
		'type' => [ 'database' => 'basket' ],
	);
	
	$exploder = array();
	$remplacer = array();
	
	$other = array(
		'product' => [
			'table' => $dbb_product, 
			'explode' => false, 
			'type' => 'id', 
			'id' => ':product:',
			'result' => '<a class="col-6 passive-link" style="text-decoration: none;" href="#"><div class="package-name d-inline-block ml-3"><h5 class="mb-0" style="font-size: 15px !important;"> :name: </h5></div></a>',
			'unknown' => lang($messages, 'filters', 'unknown')
		],
	);
	
	echo createTable($dbb_basket, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

/* USER TABLE */
if ($_POST['result'] == 'user') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "avatar", "password", "token"];
	$columnMappings = array(
		'username' => lang($messages, 'user', 'content', 'table', 'username'), 
		'email' => lang($messages, 'user', 'content', 'table', 'email'), 
		'since' => lang($messages, 'user', 'content', 'table', 'since'), 
		'last_token' => lang($messages, 'user', 'content', 'table', 'token'), 
		'udid' => lang($messages, 'user', 'content', 'table', 'keys'), 
		'secret_key' => lang($messages, 'user', 'content', 'table', 'group')
	);
	$columnDisplay = array(
		'id' => ':id:',
		'username' => '<div class="media align-items-center"><a href="' . URI . '/user/:id:" class="mr-3"><img src=":avatar:" style="width: 48px; height: 48px; border-radius: 10%;"></a> <div class="media-body"><h5 class="mb-0 text-sm"><b>:username:</b></h5><h6 class="text-muted">:udid:</h6></div></div>',
	);
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$buttons = '<a href="' . URI . '/user/:id:" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'user', 'content', 'table', 'buttons', 'overview') . '"><i class="fa fa-chart-simple"></i></a>';
	if (has('dbb.admin.user.*') OR has('dbb.admin.user.group')) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2" onclick="updateGroups(this);" data-id=":id:" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'user', 'content', 'table', 'buttons', 'groups') . '"><i class="fa fa-layer-group"></i></a>';
	if (has('dbb.admin.user.*') OR has('dbb.admin.user.edit')) $buttons .= '<a href="' . URI . '/user/:id:/edit" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'user', 'content', 'table', 'buttons', 'edit') . '"><i class="fa-regular fa-pen-to-square"></i></a>';
	if (has('dbb.admin.user.*') OR has('dbb.admin.user.erase')) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2 erase" data-id=":id:" data-type="user" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'user', 'content', 'table', 'buttons', 'erase') . '"><i class="fa fa-eraser"></i></a>';
	
	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'user\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 
			'column_start' => '<tr class="user">', 
			'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 
			'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>' . lang($messages, 'user', 'content', 'table', 'actions') . '</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => true ],
		'type' => [ 'database' => 'user' ],
	);
	$other = array(
		'udid' => [
			'table' => $dbb_license, 
			'type' => 'client', 
			'id' => ':udid:',
			'result' => '',
			'alias' => 'count',
			'unknown' => '<i class="text-danger fa-regular fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'error', 'user_unknown') . '"></i> :client:'
		],
		'secret_key' => [
			'table' => '', 
			'type' => 'name', 
			'id' => ':id:',
			'result' => '',
			'alias' => 'primary_group',
			'unknown' => '<i class="text-danger fa-regular fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'error', 'user_unknown') . '"></i> :client:'
		],
	);
	
	echo createTable($dbb_user, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other);
	closeDBConnection();
	
    } catch (Exception $e) {
		echo $e;
		closeDBConnection();
		return;
    }
}
if ($_POST['result'] == 'user_ip_history') {
	getDBConnection();
	$userid = $_POST['user'];
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "token", "user", "status"];
	$columnMappings = array(
		'ip' => lang($messages, 'user', 'content', 'table', 'ip_history', 'country'), 
		'country' => lang($messages, 'user', 'content', 'table', 'ip_history', 'ip'), 
		'since' => lang($messages, 'user', 'content', 'table', 'ip_history', 'since')
	);
	$columnDisplay = array(
		'ip' => '<img src="https://flagcdn.com/w160/:country:.png" class="rounded-circle border shadow" alt="AR" style="width: 32px; height: 32px;"> :country:',
		'country' => ':ip:',
	);
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$buttons = '';
	
	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'ip_history\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 
			'column_start' => '<tr class="user">', 
			'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 
			'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>Actions</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => false ],
		'type' => [ 'database' => 'ip_history' ],
	);
	$other = array();
	$limiter = array('column' => 'user', 'result' => $userid, 'permission' => 'dbb.devbybit.com');

	echo createTable($dbb_history_ip, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

/* GROUPS TABLE */
if ($_POST['result'] == 'group') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "default", "color", "position", "since"];
	$columnMappings = array('name' => 'Group');
	$columnDisplay = array(
		'id' => ':id:',
		'username' => '<div class="media align-items-center"><a href="#" class="mr-3"><img src=":avatar:" style="width: 48px; height: 48px; border-radius: 10%;"></a> <div class="media-body"><h5 class="mb-0 text-sm"><b>:username:</b></h5><h6 class="text-muted">:udid:</h6></div></div>'
	);
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$btn_icon = '<i class="fa fa-gear"></i>';
	if (has('dbb.admin.group.*') OR has('dbb.admin.group')) $buttons = '<a href="' . URI . '/group/:id:" width="16" height="16" class="btn-a  mr-2" data-id="1" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="Overview!"><i class="fa fa-chart-simple"></i></a>';
	if (has('dbb.admin.group.*') OR has('dbb.admin.group.erase')) $buttons .= '<a href="#" width="16" height="16" class="btn-a remove_this_group mr-2" data-id=":id:" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="Erase"><i class="fa fa-eraser"></i></a>';
	
	if (has('dbb.admin.group.*') OR has('dbb.admin.group.move')) $mover = '<i class="fa fa-bars move p-2 d-inline-block ui-sortable-handle"></i>';
	
	$template = array(
		'header' => [
			'title' => '<div class="package-page mb-3" id="packages-card-body"><div class="categories"><div class="category" id="group_list">', 
			'column_start' => '', 
			'column_body' => '', 
			'column_end' => '<ul class="packages mb-0 collapse show ntp-packages" id="groups_list">' 
		],
		'body' => [ 
			'column_start' => '<li class="border-top-0" data-id=":id:">', 
			'column_body' => '<div class="row d-flex align-items-center">
								<a class="col-9 passive-link" style="text-decoration: none;" href="' . URI . '/group/:id:">' . $mover . '<div class="package-name d-inline-block ml-3"><h5 class="mb-0" style="font-size: 15px !important;"><i class="fa fa-circle-half-stroke" style="font-size: 15px !important; color: :color:;"></i> :name:</h5></div></a>
								<div class="col-3 text-right d-flex align-items-center justify-content-end">' . $buttons . '</div>
							</div>', 
			'column_end' => '</li>', 
			'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>',
			'enable' => true
		],
		'footer' => [ 'column_close' => '</ul>', 'title_end' => '</div></div></div>' ],
		'actions' => [ 'header_column' => '', 'body_column' => ':action_btn:', 'enable' => false ],
		'type' => [ 'database' => 'group' ],
	);
	
	echo createTable($dbb_group, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}
if ($_POST['result'] == 'group_permission') {
	getDBConnection();
	$group = $_POST['data_id'];
	
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "group", "since"];
	$columnMappings = array();
	$columnDisplay = array();
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	if (has('dbb.admin.group.*') OR has('dbb.admin.group.permission.edit')) $buttons = '<a href="#" width="16" height="16" class="btn-a start-edit-perms mr-2" data-group=":group:" data-id=":id:" data-perm=":permission:" data-type="0" style="text-decoration: none;"><i class="fa-regular fa-pen-to-square"></i></a>';
	if (has('dbb.admin.group.*') OR has('dbb.admin.group.permission.erase')) $buttons .= '<a href="#" width="16" height="16" data-perm=":permission:" class="btn-a start-erase-perms mr-2" data-id=":id:" style="text-decoration: none;"><i class="fa-regular fa-circle-xmark"></i></a>';
	
	$template = array(
		'header' => [
			'title' => '<div class="package-page mb-3" id="packages-card-body"><div class="categories"><div class="category" id="permission_group">', 
			'column_start' => '', 
			'column_body' => '', 
			'column_end' => '<ul class="packages mb-0 collapse show ntp-packages permission_list_group" id="permission_list_group">' 
		],
		'body' => [ 
			'column_start' => '<li class="border-top-0" data-id=":id:">', 
			'column_body' => '<div class="row d-flex align-items-center"><div class="col-9 passive-link package-name d-inline-block label-for-edit ml-3" data-label=":id:"><h6 class="mb-0">:permission:</h6></div><div class="col-3 text-right d-flex align-items-center justify-content-end">' . $buttons . '</div></div>', 
			'column_end' => '</li>', 
			'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>',
			'enable' => true
		],
		'footer' => [ 'column_close' => '</ul>', 'title_end' => '</div></div></div>' ],
		'actions' => [ 'header_column' => '', 'body_column' => ':action_btn:', 'enable' => false ],
		'type' => [ 'database' => 'group_permission' ],
	);
	$remplacer = array();
	$exploder = array();
	$other = array();
	$view_type = array();
	$limiter = array('column' => 'group', 'result' => $group, 'permission' => 'dbb.devbybit.com');
	
	echo createTable($dbb_group_permission, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter, '', $view_type);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}
if ($_POST['result'] == 'group_users') {
	getDBConnection();
	$group = $_POST['data_id'];
	
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "group", "since"];
	$columnMappings = array();
	$columnDisplay = array();
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	if (has('dbb.admin.group.*') OR has('dbb.admin.group.user.erase')) $buttons .= '<a href="#" width="16" height="16" class="btn-a erase-user-group mr-2" data-id=":id:" style="text-decoration: none;"><i class="fa-regular fa-circle-xmark"></i></a>';
	
	$template = array(
		'header' => [
			'title' => '<div class="package-page mb-3" id="packages-card-body"><div class="categories"><div class="category" id="users_group">', 
			'column_start' => '', 
			'column_body' => '', 
			'column_end' => '<ul class="packages mb-0 collapse show ntp-packages users_list_group" id="users_list_group">' 
		],
		'body' => [ 
			'column_start' => '<li class="border-top-0" data-id=":id:">', 
			'column_body' => '<div class="row d-flex align-items-center"><div class="col-9 passive-link package-name d-inline-block ml-3">
			<h6 class="mb-0">:column_name:</h6></div>
			<div class="col-3 text-right d-flex align-items-center justify-content-end">' . $buttons . '</div></div>', 
			'column_end' => '</li>', 
			'without_result' => '<td scope="col" colspan="12" class="font-13">' . lang($messages, 'error', 'not_results_on_db') . '</td>',
			'enable' => false
		],
		'footer' => [ 'column_close' => '</ul>', 'title_end' => '</div></div></div>' ],
		'actions' => [ 'header_column' => '', 'body_column' => ':action_btn:', 'enable' => false ],
		'type' => [ 'database' => 'group_user' ],
	);
	$remplacer = array();
	$exploder = array();
	$other = array(
		'user' => [
			'table' => $dbb_user, 
			'explode' => false, 
			'type' => 'id', 
			'id' => ':user:',
			'result' => '
			<a href="' . URI . '/user/:id:" class="d-flex justify-content-left align-items-center lh-1 text-reset p-0" style="text-decoration: none;">
					<img src=":avatar:" style="border-radius: 5px; width: 40px;" />
					<div class="d-none d-xl-block ps-2">
						<div>:username:</div>
						<div class="mt-1 small text-muted" style=""></div>
					</div>
				</a>',
			'unknown' => lang($messages, 'filters', 'unknown')
		],
	);
	$view_type = array();
	$limiter = array('column' => 'group', 'result' => $group, 'permission' => 'dbb.devbybit.com');
	
	echo createTable($dbb_group_user, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other, $limiter, '', $view_type);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

/* CODE TABLE */
if ($_POST['result'] == 'code') {
	getDBConnection();
	if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) { echo lang($messages, 'session', 'expire'); return; } }
	try {
	$search = $_POST['search'];
	$total = $_POST['total'];
	$page = $_POST['pag'];
	$where = $_POST['options'];
	$hiddenColumns = ["id", "addons"];
	$columnMappings = array(
		'type' => lang($messages, 'code', 'content', 'table', 'type'), 
		'code' => lang($messages, 'code', 'content', 'table', 'code'), 
		'status' => lang($messages, 'code', 'content', 'table', 'status', 'column'), 
		'use' => lang($messages, 'code', 'content', 'table', 'used_by'), 
		'since' => lang($messages, 'code', 'content', 'table', 'since')
	);
	$columnDisplay = array(
		'id' => ':id:',
		'username' => '<div class="media align-items-center"><a href="' . URI . '/code/:id:" class="mr-3"><img src=":avatar:" style="width: 48px; height: 48px; border-radius: 10%;"></a> <div class="media-body"><h5 class="mb-0 text-sm"><b>:username:</b></h5><h6 class="text-muted">:udid:</h6></div></div>',
		
	);
	$listempty = lang($messages, 'filters', 'unknown');
	$sinceCount = ['since' => 'since'];
	
	$exploder = array();
	$remplacer = array(
		'status' => [
			'1' => '<i class="text-success fa-solid fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'code', 'content', 'table', 'status', 'used') . '"></i>', 
			'0' => '<i class="text-danger fa-solid fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'code', 'content', 'table', 'status', 'canceled') . '"></i>',
			'2' => '<i class="text-warning fa-regular fa-circle" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'code', 'content', 'table', 'status', 'pending') . '"></i>'
		], 
	);
	
	$btn_icon = '<i class="fa fa-gear"></i>';
	$buttons = '<a href="' . URI . '/code/:id:" width="16" height="16" class="btn-a rounded-circle border mr-2" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'code', 'content', 'table', 'buttons', 'overview', 'tooltip') . '">' . lang($messages, 'code', 'content', 'table', 'buttons', 'overview', 'text') . '</a>';
	if (has('dbb.admin.code.*') OR has('dbb.admin.code.erase')) $buttons .= '<a href="#" width="16" height="16" class="btn-a rounded-circle border mr-2 erase" data-id=":id:" data-type="code" style="border-radius: 50%; text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="' . lang($messages, 'code', 'content', 'table', 'buttons', 'erase', 'tooltip') . '">' . lang($messages, 'code', 'content', 'table', 'buttons', 'erase', 'text') . '</a>';
	
	$template = array(
		'header' => ['title' => '<table class="table table-hover mb-3"><thead class="table-header">', 'column_start' => '<tr>', 'column_body' => '<th class="font-14" onclick="updateOption(event, \'code\', \':column:\');" style="cursor: pointer;" data-id=":column:">:column_name: :order_by_icon:</th>', 'column_end' => '</tr></thead><tbody>' ],
		'body' => [ 'column_start' => '<tr class="code">', 'column_body' => '<td scope="col" class="font-13">:column_name:</td>', 'column_end' => '</tr>', 'without_result' => '<td scope="col" colspan="12" class="font-13"><h5>' . lang($messages, 'code', 'content', 'table', 'no_results') . '</h5></td>' ],
		'footer' => [ 'column_close' => '</tbody>', 'title_end' => '</table>' ],
		'actions' => [ 'header_column' => '<th>' . lang($messages, 'code', 'content', 'table', 'actions') . '</th>', 'body_column' => '<td>:action_btn:</td>', 'enable' => true ],
		'type' => [ 'database' => 'code' ],
	);
	
	$other = array(
		'use' => [
			'table' => $dbb_user, 
			'explode' => false, 
			'type' => 'id', 
			'id' => ':use:',
			'result' => ':username:',
			'unknown' => lang($messages, 'filters', 'unknown')
		],
	);
	
	echo createTable($dbb_code, '<span align="right">' . lang($messages, 'filters', 'showing') . '</span>', $template, $search, $page, $where, $total, $hiddenColumns, $columnMappings, $listempty, $sinceCount, $columnDisplay, $buttons, $exploder, $remplacer, $other);
	closeDBConnection();
			
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
}

/* SELECT GROUP TO USER LIST */
if ($_POST['result'] == 'group_select_user') {
	getDBConnection();
	$user = $_POST['iduser'];
	
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	
	if (empty($user)) {
		echo json_encode(array('type' => 'error', 'title' => 'Ohh, there are problems!', 'subtitle' => 'Problems occurred when trying to view list of groups. Try again!'));
		return;
	}
	
	try {
		$userSQL = $connx->prepare("SELECT * FROM `$dbb_user` WHERE `id` = ?");
		$userSQL->execute([$user]);
		
		if ($userSQL->RowCount() == 0) {
			echo '<h4><i class="text-warning fa-regular fa-circle-xmark"></i> The user does not exist in the database.</h4>';
			closeDBConnection();
			return;
		}
		
		$groupSQL = $connx->prepare("SELECT * FROM `$dbb_group` ORDER BY position DESC");
		$groupSQL->execute();
		if ($groupSQL->RowCount() > 0) {
		while ($group = $groupSQL->fetch(PDO::FETCH_ASSOC)) {
			$groupUserSQL = $connx->prepare("SELECT * FROM `$dbb_group_user` WHERE `group` = ? AND `user` = ?");
			$groupUserSQL->execute([$group['id'], $user]);
			$groupUser = $groupUserSQL->fetch(PDO::FETCH_ASSOC);
			
			if (!$group['default']) {
				$user_group = ($group['id'] == $groupUser['group']) ? 'checked' : '';
				echo '<li class="border-top-0" data-id="' . $group['id'] . '" data-user="' . $user . '">
					<div class="row d-flex align-items-center">
						<a class="col-9 passive-link" style="text-decoration: none;" href="' . URI . '/group/' . $group['id'] . '">
						<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color:' . $group['color'] . ';"></i> ' . $group['name'] . '</h6></div></a>
						<div class="col-3 text-right d-flex align-items-center justify-content-end">
							<div class="checkbox-wrapper-64">
								<label class="switch"><input type="checkbox" class="group-checkbox" data-id="' . $group['id'] . '" data-user="' . $user . '" ' . $user_group . '><span class="slider"></span></label>
							</div>
						</div>
					</div>
				</li>';
			} else {
				echo '<li class="border-top-0" data-id="' . $group['id'] . '">
					<div class="row d-flex align-items-center">
						<a class="col-9 passive-link" style="text-decoration: none;" href="' . URI . '/group/' . $group['id'] . '">
						<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color: ' . $group['color'] . ';"></i> ' . $group['name'] . '</h6></div></a>
						<div class="col-3 text-right d-flex align-items-center justify-content-end"><i class="text-success fa-regular fa-circle-check" data-toggle="tooltip" data-placement="bottom" title="This group is default for all."></i></div>
					</div>
				</li>';
			}
			
		}
		} else {
			echo '<h4><i class="text-warning fa fa-warning"></i> No groups have been found.</h4>';
			closeDBConnection();
			return;
		}
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
	
}

/* USER PROFILE OVERVIEW */
if ($_POST['result'] == 'user_groups_list') {
	getDBConnection();
	$user = $_POST['iduser'];
	
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	
	if (empty($user)) {
		echo json_encode(array('type' => 'error', 'title' => 'Ohh, there are problems!', 'subtitle' => 'Problems occurred when trying to view list of groups. Try again!'));
		return;
	}
	
	try {
		$userSQL = $connx->prepare("SELECT * FROM `$dbb_user` WHERE `id` = ?");
		$userSQL->execute([$user]);
		
		if ($userSQL->RowCount() == 0) {
			echo '<h4><i class="text-warning fa-regular fa-circle-xmark"></i> The user does not exist in the database.</h4>';
			closeDBConnection();
			return;
		}
		
		$groupSQL = $connx->prepare("SELECT * FROM `$dbb_group` ORDER BY position DESC");
		$groupSQL->execute();
		if ($groupSQL->RowCount() > 0) {
		while ($group = $groupSQL->fetch(PDO::FETCH_ASSOC)) {
			$groupUserSQL = $connx->prepare("SELECT * FROM `$dbb_group_user` WHERE `group` = ? AND `user` = ?");
			$groupUserSQL->execute([$group['id'], $user]);
			$groupUser = $groupUserSQL->fetch(PDO::FETCH_ASSOC);
			
			if (!$group['default']) {
				if ($group['id'] == $groupUser['group']) {
				echo '<li class="border-top-0" data-id="' . $group['id'] . '" data-user="' . $user . '">
					<div class="row d-flex align-items-center">
						<a class="col-9 passive-link" style="text-decoration: none;" href="' . URI . '/group/' . $group['id'] . '">
						<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color:' . $group['color'] . ';"></i> ' . $group['name'] . '</h6></div></a>
						<div class="col-3 text-right d-flex align-items-center justify-content-end"></div>
					</div>
				</li>';
				}
			} else {
				echo '<li class="border-top-0" data-id="' . $group['id'] . '">
					<div class="row d-flex align-items-center">
						<a class="col-9 passive-link" style="text-decoration: none;" href="' . URI . '/group/' . $group['id'] . '">
						<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color: ' . $group['color'] . ';"></i> ' . $group['name'] . '</h6></div></a>
						<div class="col-3 text-right d-flex align-items-center justify-content-end"><i class="text-success fa-regular fa-circle-check" data-toggle="tooltip" data-placement="bottom" title="This group is default for all."></i></div>
					</div>
				</li>';
			}
			
		}
		} else {
			echo '<h4><i class="text-warning fa fa-warning"></i> No groups have been found.</h4>';
			closeDBConnection();
			return;
		}
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
	
}

/* SELECT GROUP TO USER LIST */
if ($_POST['result'] == 'select_client_license') {
	getDBConnection();
	
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	
	try {
		$userSQL = $connx->prepare("SELECT * FROM `$dbb_user` ORDER BY since DESC");
		$userSQL->execute();
		if ($userSQL->RowCount() > 0) {
			while ($user = $userSQL->fetch(PDO::FETCH_ASSOC)) {
				echo '<button type="button" class="chap" data-client="' . $user['udid'] . '"><img src="' . $user['avatar'] . '" class="chap-img">' . $user['username'] . '</button>';
			}
		} else {
			echo '<h4><i class="text-warning fa fa-warning"></i> No users have been found.</h4>';
			closeDBConnection();
			return;
		}
		closeDBConnection();
		
    } catch (Exception $e) {
		closeDBConnection();
		return;
    }
	
}
if ($_POST['result'] == 'sub_search_client_add') {
	getDBConnection();
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	try {
	$userSQL = $connx->prepare("SELECT * FROM `$dbb_user`");
	$userSQL->execute();

	$userData = [];

	while ($user = $userSQL->fetch(PDO::FETCH_ASSOC)) {
		$userListData = ['name' => $user['username'], 'id' => $user['id'], 'avatar' => $user['avatar']];
		$userData[] = $userListData;
	}

	$query = isset($_POST['query']) ? $_POST['query'] : '';

	$filteredResults = array_filter($userData, function($item) use ($query) {
		$nameMatch = stripos($item['name'], $query) !== false;
		$idMatch = stripos($item['id'], $query) !== false;
		$avatarMatch = stripos($item['avatar'], $query) !== false;
		
		return $nameMatch || $idMatch || $avatarMatch;
	});

    header('Content-Type: application/json');
    echo json_encode($filteredResults, JSON_FORCE_OBJECT);
	} catch (Exception $e) {
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode(array('error' => $e->getMessage()));
	}
	closeDBConnection();
}
if ($_POST['result'] == 'sub_search_client') {
	getDBConnection();
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	try {
	$userSQL = $connx->prepare("SELECT * FROM `$dbb_user`");
	$userSQL->execute();

	$userData = [];

	while ($user = $userSQL->fetch(PDO::FETCH_ASSOC)) {
		$userListData = ['name' => $user['username'], 'udid' => $user['udid']];
		$userData[] = $userListData;
	}

	$query = isset($_POST['query']) ? $_POST['query'] : '';

	$filteredResults = array_filter($userData, function($item) use ($query) {
		$nameMatch = stripos($item['name'], $query) !== false;
		$udidMatch = stripos($item['udid'], $query) !== false;
		
		return $nameMatch || $udidMatch;
	});

    header('Content-Type: application/json');
    echo json_encode($filteredResults, JSON_FORCE_OBJECT);
	} catch (Exception $e) {
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode(array('error' => $e->getMessage()));
	}
	closeDBConnection();
}
if ($_POST['result'] == 'sub_search_product') {
	getDBConnection();
	if (!sessions($_COOKIE['dbb_token']) AND TOKEN_STATUS) {
		echo json_encode(array('type' => 'error', 'title' => 'Session expired', 'subtitle' => 'Your session has expired. Please start again.'));
		return;
	}
	try {
	$productSQL = $connx->prepare("SELECT * FROM `$dbb_product`");
	$productSQL->execute();

	$productData = [];

	while ($product = $productSQL->fetch(PDO::FETCH_ASSOC)) {
		$productListData = ['name' => $product['name'], 'id' => $product['id_name']];
		$productData[] = $productListData;
	}

	$query = isset($_POST['query']) ? $_POST['query'] : '';

	$filteredResults = array_filter($productData, function($item) use ($query) {
		$nameMatch = stripos($item['name'], $query) !== false;
		$udidMatch = stripos($item['id'], $query) !== false;
		
		return $nameMatch || $udidMatch;
	});

    header('Content-Type: application/json');
    echo json_encode($filteredResults, JSON_FORCE_OBJECT);
	} catch (Exception $e) {
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode(array('error' => $e->getMessage()));
	}
	closeDBConnection();
			
}
?>