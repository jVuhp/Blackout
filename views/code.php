<?php
/*
===========================================================================

	Powered by: DevByBit
	Site: devbybit.com
	Date: 2/18/2024 22:31 PM
	Author: Vuhp
	Documentation: docs.devbybit.com

===========================================================================
*/
$pagename = 'code';
$pageicon = 'code';
$position = '5';
$pageview = '1';
$permission = 'dbb.admin.code';

if (!has('dbb.admin.code')) {
	hasNo();
}

if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
if (!$page[1]) {
?>
	
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right" role="group">
			<?php if (has('dbb.admin.code.create')) { ?>
			<a href="#" width="16" height="16" class="btn-a" data-bs-toggle="dropdown" aria-expanded="false"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a>
			<div class="dropdown-menu">
				<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/create/license" class="dropdown-item change-page"><?php echo lang($messages, $pagename, 'content', 'buttons', 'license'); ?></a>
				<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/create/addons" class="dropdown-item change-page"><?php echo lang($messages, $pagename, 'content', 'buttons', 'addons'); ?></a>
				<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/create/request" class="dropdown-item change-page"><?php echo lang($messages, $pagename, 'content', 'buttons', 'request'); ?></a>
			</div>
			<?php } ?>
	</div>
</div>
<p></p>
<section class="card fadeIn">
	<div class="card-body" id="group">
		<div class="row d-flex align-items-center mb-3">
			<div class="col-md-8">
				<input type="text" class="form-control w-50" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>" id="search">
				<input type="hidden" value="group" id="tabPage">
				<input type="hidden" value="1" id="paginationID">
				<input type="hidden" value="<?php echo ($_COOKIE['column_code_selected']) ? $_COOKIE['column_code_selected'] : 'id#DESC'; ?>" id="option">
			</div>
			<div class="col-md-4 d-none d-md-inline" align="right">
				<select class="form-control w-20" id="total">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
				</select>
			</div>
		</div>
		<div class="table-responsive table-container mb-3" id="load_index_result"></div>
	</div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'code';
	codeCall();
});
</script>
<?php 
} else if ($page[1] == 'create') {

	if ($page[2] == 'license') {
		if (!has('dbb.admin.code.create')) {
			hasNo();
		}
?>
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'license', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'create', 'license', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="#" class="change-page btn-a createLicenseGift"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
	</div>
</div>

	<section class="card fadeIn">
		<form class="card-body" id="createLicense">
			<input type="hidden" value="create_license_gift" name="result">
			<div class="mb-3">
				<label for="code" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span>Code <i class="text-danger">*</i></span> 
					<span>
						<i class="text-primary fa-regular fa-copy" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="Copy Code" onclick="copyOther('code');"></i> 
						<i class="text-danger fa fa-arrows-rotate" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="Regenerate the code" onclick="generateNewKey('code');"></i>
					</span>
				</label>
				<input type="text" class="form-control" placeholder="XXXXX-XXXXX-XXXXX-XXXXX" value="<?php echo randomCode(32, 'QWERTYUIOPASDFGHJKLZXCVBNM.#0123456789qwertyuiopasdfghjklzxcvbnm-_');?>" id="code" name="code">
			</div>

			<div class="mb-3 search-container">
				<label for="product" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'product', 'label'); ?> <i class="text-danger">*</i></span> 
					<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'product', 'tooltip'); ?>"></i> 
				</label>
				<input type="text" class="form-control w-100" id="product" name="product" autocomplete="software_product" placeholder="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'product', 'placeholder'); ?>">
				<ul id="productResults" class="search-results"></ul>
			</div>
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="ips" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'ip_cap', 'label'); ?></span> 
							<span>
								<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'ip_cap', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="number" class="form-control" placeholder="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'ip_cap', 'placeholder'); ?>" value="5" id="ips" name="ips">
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="expire" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'label'); ?> <a href="#" class="expire_time_text"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a></span> 
							<div role="group">
								<a href="#" width="16" height="16" class="" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="text-warning fa fa-gear"></i>
								</a>
								<div class="dropdown-menu">
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Seconds', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Minutes', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Hours', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Days', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'days'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Months', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'months'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'months'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Years', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'years'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'years'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Never', '<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'never'); ?>');"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'type', 'never'); ?></a>
								</div>
							</div>
						</label>
						<div class="input-group">
							<button type="button" style="border-radius: 3px 0px 0px 3px;"><i class="fa fa-calendar"></i></button>
							<input type="hidden" value="Days" id="expire_time" name="expire_time">
							<input type="number" class="form-control" value="1" autocomplete="expiration" style="border-radius: 0px 3px 3px 0px !important;" placeholder="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'expiration', 'placeholder'); ?>" id="expire" name="expire">
						</div>
					</div>
				</div>
			</div>
			
			<div class="mb-3">
				<label for="addons" class="mb-2"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'label'); ?></label>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="bound" name="bound" type="checkbox" value="1" checked />
					<label class="cbx" for="bound"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'bound', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'bound', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="ip_log" name="ip_log" type="checkbox" value="1" checked />
					<label class="cbx" for="ip_log"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'ip_log', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="logs" name="logs" type="checkbox" value="1" checked />
					<label class="cbx" for="logs"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'logs', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'logs', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="delete_ips" name="delete_ips" type="checkbox" value="1" />
					<label class="cbx" for="delete_ips"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'delete_ips', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'delete_ips', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="limit" name="limit" type="checkbox" value="1" />
					<label class="cbx" for="limit"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'limit', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'limit', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="product_verify" name="product_verify" type="checkbox" value="1" />
					<label class="cbx" for="product_verify"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'product_verify', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'product_verify', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="require_version" name="require_version" type="checkbox" value="1" />
					<label class="cbx" for="require_version"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'require_version', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'require_version', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="expire_erase" name="expire_erase" type="checkbox" value="1" />
					<label class="cbx" for="expire_erase"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'expire_erase', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="admit_clone" name="admit_clone" type="checkbox" value="1" checked />
					<label class="cbx" for="admit_clone"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'admit_clone', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="send_discord" name="send_discord" type="checkbox" value="1" />
					<label class="cbx" for="send_discord"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'send_discord', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'send_discord', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="send_webhook" name="send_webhook" type="checkbox" value="1" checked />
					<label class="cbx" for="send_webhook"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'send_webhook', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'license', 'content', 'create', 'form', 'addons', 'send_webhook', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
			</div>
			
		</form>
	</section>

<?php
	} else if ($page[2] == 'addons') {
		if (!has('dbb.admin.code.create')) {
			hasNo();
		}
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="#" class="change-page btn-a createAddonsGifts"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
	</div>
</div>

<div class="card fadeIn mb-2">
	<form id="createAddonsGift" class="card-body">
		<input type="hidden" name="result" value="create_addons_gift">
		<div class="mb-3">
			<div class="row d-flex align-items-center">
				<div class="col-md-12 col-sm-12 mb-3">
					<label for="code" class="d-flex justify-content-between align-items-lg-center mb-2">
						<span><?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'label'); ?> <i class="text-danger">*</i></span> 
						<span>
							<i class="text-primary fa-regular fa-copy" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'tooltip', '1'); ?>" onclick="copyOther('code');"></i> 
							<i class="text-danger fa fa-arrows-rotate" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'tooltip', '2'); ?>" onclick="generateNewKey('code');"></i>
						</span>
					</label>
					<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'placeholder'); ?>" value="<?php echo randomCode(32, 'QWERTYUIOPASDFGHJKLZXCVBNM.#0123456789qwertyuiopasdfghjklzxcvbnm-_');?>" id="code" name="code">
				</div>
			</div>
		</div>
		<div class="mb-3">
			<div class="row d-flex align-items-center">
				<div class="col-md-8">
					<label for="addons" class="mb-2"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'custom_addons', 'label'); ?></label>
				</div>
				<div class="col-md-4" align="right"><span id="quantAddons">0</span> <?php echo ($addons_bsd) ? '' : '/5'; ?></div>
			</div>
			<section class="custom-addons"></section>
			<div class="custom-addons-add"><?php echo lang($messages, 'license', 'content', 'create', 'form', 'custom_addons', 'button'); ?></div>
		</div>
		<div class="icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg></span></div>
			<div class="icon-demo-message-text"><?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'note'); ?></div>
		</div>
	</form>
</div>

<?php
	} else if ($page[2] == 'request') {
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'request', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<?php if (API_SECURITY != 0) { ?><a href="#" class="change-page btn-a createRequestCode"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a><?php } ?>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
	</div>
</div>

<div class="row d-flex align-items-start mb-2 fadeIn">
<?php if (API_SECURITY == 0) { ?>
	<div class="col-12 mb-2">
		<div class="danger icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-battery-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 7h11a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-11a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" /><path d="M7 10l0 4" /></svg></span></div>
			<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'low_lvl', 'title'); ?></b> <br><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'low_lvl', 'subtitle'); ?> <a href="https://docs.devbybit.com/blackout-license-software/request" class="btn-a-suave" target="_BLANK"><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'low_lvl', 'click_here'); ?></a></div>
		</div>
	</div>
<?php } else { ?>
	<div class="col-12 mb-2">
		<div class="card">
			<form id="createRequest" class="card-body">
				<input type="hidden" name="result" value="create_request_code">
				<div class="mb-3">
					<div class="row d-flex align-items-center">
						<div class="col-md-12 col-sm-12 mb-3">
							<label for="code" class="d-flex justify-content-between align-items-lg-center mb-2">
								<span><?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'label'); ?> <i class="text-danger">*</i></span> 
								<span>
									<i class="text-primary fa-regular fa-copy" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'tooltip', '1'); ?>" onclick="copyOther('code');"></i> 
									<i class="text-danger fa fa-arrows-rotate" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'tooltip', '2'); ?>" onclick="generateNewKey('code');"></i>
								</span>
							</label>
							<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'addons', 'code', 'placeholder'); ?>" value="<?php echo randomCode(32, 'QWERTYUIOPASDFGHJKLZXCVBNM.#0123456789qwertyuiopasdfghjklzxcvbnm-_');?>" id="code" name="code">
						</div>
					</div>
				</div>
				<div class="mb-3">
					<div class="row d-flex align-items-center">
						<div class="col-md-8">
							<label for="addons" class="mb-2"><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'custom_addons', 'label'); ?></label>
						</div>
						<div class="col-md-4" align="right"><span id="quantAddons">0</span> <?php echo ($addons_bsd) ? '' : '/5'; ?></div>
					</div>
					<section class="custom-addons"></section>
					<div class="custom-addons-add"><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'custom_addons', 'button'); ?></div>
				</div>
				<p><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'level', 'note'); ?></p>
				<div class="icon-demo-message">
					<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-hexagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg></span></div>
					<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'level', 'information', 'title'); ?></b><br><?php echo lang($messages, $pagename, 'content', 'create', 'request', 'level', 'information', 'subtitle'); ?></div>
				</div>
			</form>
		</div>
	</div>
	
<?php } ?>
</div>
<?php
	} else {
		echo $page_not_found;
	}
} else {

if (strtolower(DB_TYPE) == 'mysql') {
    $sql_used_code = "SELECT * FROM `" . $dbb_code . "` WHERE `id` = ?;";
	$sql_list_code = [$page[1]];
} elseif (strtolower(DB_TYPE) == 'mongodb') {
    $sql_used_code = "SELECT * FROM `" . $dbb_code . "` WHERE `id` = ?;";
	$sql_list_code = [$page[1]];
} elseif (strtolower(DB_TYPE) == 'redis') {
    $sql_used_code = "SELECT * FROM `" . $dbb_code . "` WHERE `id` = ?;";
	$sql_list_code = [$page[1]];
}
	
$codes = database(DB_TYPE, $sql_used_code, $sql_list_code);
?>
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'overview', 'title'); ?></b></h5>
		<h1><b><?php echo str_replace('{code:id}', $page[1], lang($messages, $pagename, 'content', 'overview', 'subtitle')); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
	</div>
</div>

<div class="row d-flex align-items-start mb-2 fadeIn">
	<div class="col-12 mb-2">
		<div class="icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg></span></div>
			<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'code'); ?></b> <br><?php echo $codes['code']; ?> <button type="button" class="btn-a-suave" onclick="copyText('<?php echo $codes['code']; ?>');"><i class="ti ti-copy"></i></button></div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 mb-2">
		<div class="icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-article" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M7 8h10" /><path d="M7 12h10" /><path d="M7 16h10" /></svg></span></div>
			<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'type'); ?></b> <br><?php echo $codes['type']; ?></div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 mb-2">
		<div class="icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg></span></div>
			<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'used_by'); ?></b> <br><?php echo ($codes['use'] == NULL) ? lang($messages, 'filters', 'unknown') : userDev('username', $codes['use']); ?></div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 mb-2">
		<div class="icon-demo-message">
			<div class="icon-demo-message-icon"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-network" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9a6 6 0 1 0 12 0a6 6 0 0 0 -12 0" /><path d="M12 3c1.333 .333 2 2.333 2 6s-.667 5.667 -2 6" /><path d="M12 3c-1.333 .333 -2 2.333 -2 6s.667 5.667 2 6" /><path d="M6 9h12" /><path d="M3 20h7" /><path d="M14 20h7" /><path d="M10 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 15v3" /></svg></span></div>
			<div class="icon-demo-message-text"><b class="text-primary"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'status'); ?></b> <br><?php if ($codes['status'] == 1) { echo lang($messages, $pagename, 'content', 'status', 'active'); } else if ($codes['status'] == 0) { echo lang($messages, $pagename, 'content', 'status', 'canceled'); } else { echo lang($messages, $pagename, 'content', 'status', 'pending'); } ?></div>
		</div>
	</div>
	<div class="col-12 mb-2" align="center">
		<button class="btn-a-suave"><i class="ti ti-rotate-rectangle"></i> <?php echo lang($messages, $pagename, 'content', 'overview', 'buttons', 'refresh'); ?></button>
		<button class="btn-a-suave"><i class="ti ti-restore"></i> <?php echo lang($messages, $pagename, 'content', 'overview', 'buttons', 'reset'); ?></button>
	</div>
</div>

<?php } ?>

<div class="modal fade" id="generatorKeyConfig" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header"><h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><i class="text-primary fa fa-key"></i> Key Configuration</h1><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <div class="modal-body modal-dialog-scrollable">
			<div class="mb-3">
				<label for="license_digits">Key Digits:</label>
				<input type="text" class="form-control" placeholder="Digits for the key." value="QWERTYUIOPASDFGHJKLZXCVBNM.#0123456789qwertyuiopasdfghjklzxcvbnm-_" name="license_digits" id="license_digits">
			</div>
			<div class="mb-3">
				<label for="license_separator_count">Quant of Separators:</label>
				<input type="number" class="form-control" placeholder="Quantity of separators." name="license_separator_count" id="license_separator_count" value="0">
			</div>
			<div class="mb-3">
				<label for="license_separator">Separator Digit:</label>
				<input type="text" class="form-control" placeholder="Separator digit." name="license_separator" id="license_separator" value="">
			</div>
			<div class="mb-3">
				<label for="license_quantity">Quantity of Digits per separator:</label>
				<input type="number" class="form-control" placeholder="Quantity of Digits per separator." name="license_quantity" id="license_quantity" value="32">
			</div>
			<div class="mb-3">
				<label for="examplekey">Example:</label>
				<input type="text" class="form-control" placeholder="License key example." name="examplekey" id="examplekey" value="">
			</div>
			
			<button type="button" onclick="generateNewKey('examplekey');" class="btn-a"><i class="fa fa-arrows-rotate"></i> Generate Example</button>
			<button type="button" onclick="saveDraftKeyConf();" class="btn-a"><i class="fa fa-check"></i> Save Draft</button>
		</div>
    </div>
  </div>
</div>