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
$pagename = 'license';
$pageicon = 'license';
$position = '3';
$pageview = '1';
$permission = 'dbb.license';
$auth = '0';
if (!has('dbb.license')) hasNo();
if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
if (!$page[1]) {
?>
	
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<?php if (has('dbb.admin.license.create') OR has('dbb.admin.license.*')) { ?>
			<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/create" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a>
		<?php } ?>
		<a href="#" class="btn-a reclaim-code"><?php echo lang($messages, $pagename, 'content', 'buttons', 'redeem'); ?></a>
	</div>
</div>

<div class="row d-flex align-items-start mb-2 fadeIn">
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-code-pull-request"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'card', 'request'); ?></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountRequest('dbb_logs', 'request', $_SESSION['dbb_user']['id']),0,",","."); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'card', 'keys'); ?></h4>
						<h6 class="text-muted"><?php echo number_format(hasCount('dbb_license', 'client', userDev('udid', $_SESSION['dbb_user']['id'])),0,",","."); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-toggle-on"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'card', 'keys_on'); ?></h4>
						<h6 class="text-muted"><span id="keys_on">0</span></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-toggle-off"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'card', 'keys_off'); ?></h4>
						<h6 class="text-muted"><span id="keys_off">0</span></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

	<section class="card fadeIn">
		<div class="card-body" id="license">
			<div class="row d-flex align-items-center mb-3">
				<div class="col-md-8">
					<input type="text" class="form-control w-50" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>" id="search">
					<input type="hidden" value="license" id="tabPage">
					<input type="hidden" value="1" id="paginationID">
					<input type="hidden" value="<?php echo ($_COOKIE['column_license_selected']) ? $_COOKIE['column_license_selected'] : 'id#DESC'; ?>" id="option">
					<?php if (has('dbb.admin.license.other')) { ?>
					<input type="hidden" value="<?php echo ($_COOKIE['view_list_type']) ? $_COOKIE['view_list_type'] : 'user'; ?>" id="view_list_type">
					<?php } ?>
				</div>
				<div class="col-md-4 d-none d-md-inline" align="right">
					<select class="form-control w-20" id="total">
						<option value="10" selected>10</option>
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

<div class="modal fade" id="reclaimCodeGiftAddons" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
			<h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><?php echo lang($messages, $pagename, 'content', 'redeem', 'header', ''); ?></h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="reclaim_addons_for_license" class="modal-body modal-dialog-scrollable">
			<input type="hidden" name="license_id" id="license_id">
			<div class="mb-3">
				<input type="text" class="form-control" name="code_gift" id="code_gift" placeholder="<?php echo lang($messages, $pagename, 'content', 'redeem', 'placeholder', ''); ?>">
			</div>
			<button class="btn btn-success" id="place_claim"><?php echo lang($messages, $pagename, 'content', 'redeem', 'button', ''); ?></button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reclaimCodeGift" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
			<h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><?php echo lang($messages, $pagename, 'content', 'redeem', 'header', ''); ?></h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-dialog-scrollable" id="reclaim_my_gift_license">
			<div class="mb-3">
				<input type="text" class="form-control" name="gift" id="gift" placeholder="<?php echo lang($messages, $pagename, 'content', 'redeem', 'placeholder', ''); ?>">
			</div>
			<button class="btn btn-success" id="place_claim_license"><?php echo lang($messages, $pagename, 'content', 'redeem', 'button', ''); ?></button>
        </div>
    </div>
  </div>
</div>
<script>
var startTime = performance.now();
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'license';
	licenseCall();
	statusLicense('keys_on', '1');
	statusLicense('keys_off', '0');
});
</script>
<?php } else if ($page[1] == 'create') { 

if (!has('dbb.admin.license.create')) {
	hasNo();
}

?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	verifyExistKey();
});
</script>
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'title', ''); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'create', 'subtitle', ''); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="#" class="btn-a-success create_license_btn"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create', ''); ?></a>
	</div>
</div>

<div class="card fadeIn mb-3 key_exist_alert" hidden>
	<div class="card-body">
		<h3><?php echo lang($messages, $pagename, 'content', 'create', 'already_exists', 'title'); ?></h3>
		<p class="text-muted"><?php echo lang($messages, $pagename, 'content', 'create', 'already_exists', 'subtitle'); ?></p>
	</div>
</div>

	<section class="card fadeIn">
		<form class="card-body" id="create_license_key" method="POST" autocomplete="off">
			<input type="hidden" value="create_license" id="result" name="result">

			<div class="mb-3">
			
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3 search-container">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" onclick="selectClient(this);" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control w-100" id="client" name="client" autocomplete="key_client" value="<?php echo (!empty($page[2])) ? $page[2] : ''; ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'placeholder'); ?>">
						<ul id="clientResults" class="search-results"></ul>
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-copy" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'copy'); ?>" onclick="copyOther('key');"></i> 
								<i class="text-danger fa fa-arrows-rotate" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'refresh'); ?>" onclick="generateNewKey('key'); verifyExistKey();"></i>
								<i class="text-warning fa fa-gear" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'config'); ?>" data-bs-toggle="modal" data-bs-target="#generatorKeyConfig"></i>
							</span>
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'placeholder'); ?>" value="<?php echo randomCodes(5) . '-' . randomCodes(5) . '-' . randomCodes(5) . '-' . randomCodes(5) . '-' . randomCodes(5);?>" id="key" name="key">
					</div>
				</div>
			</div>

			<div class="mb-3 search-container">
				<label for="product" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'label'); ?> <i class="text-danger">*</i></span> 
					<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'tooltip'); ?>"></i> 
				</label>
				<input type="text" class="form-control w-100" id="product" name="product" autocomplete="software_product" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'placeholder'); ?>">
				<ul id="productResults" class="search-results"></ul>
			</div>
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="ips" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'label'); ?></span> 
							<span>
								<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="number" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'placeholder'); ?>" value="5" id="ips" name="ips">
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="expire" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'label'); ?> <a href="#" class="expire_time_text"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a></span> 
							<div role="group">
								<a href="#" width="16" height="16" class="" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="text-warning fa fa-gear"></i>
								</a>
								<div class="dropdown-menu">
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Seconds', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Minutes', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Hours', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Days', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Months', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'months'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'months'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Years', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'years'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'years'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Never', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'never'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'never'); ?></a>
								</div>
							</div>
						</label>
						<div class="input-group">
							<button type="button" style="border-radius: 3px 0px 0px 3px;"><i class="fa fa-calendar"></i></button>
							<input type="hidden" value="Days" id="expire_time" name="expire_time">
							<input type="number" class="form-control" value="1" autocomplete="expiration" style="border-radius: 0px 3px 3px 0px !important;" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'placeholder'); ?>" id="expire" name="expire">
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="mb-3">
				<label for="reason" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'label'); ?></span> 
					<span>
						<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'tooltip'); ?>"></i> 
					</span>
				</label>
				<textarea id="reason" name="reason" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'placeholder'); ?>" rows="2"></textarea>
			</div>
			
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-8">
						<label for="addons" class="mb-2"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'custom_addons', 'label'); ?></label>
					</div>
					<div class="col-md-4" align="right"><span id="quantAddons">0</span> <?php echo ($addons_bsd) ? '' : '/5'; ?></div>
				</div>
				<section class="custom-addons"></section>
				<div class="custom-addons-add"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'custom_addons', 'button'); ?></div>
			</div>
			<div class="mb-3">
				<label for="addons" class="mb-2"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'label'); ?></label>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="bound" name="bound" type="checkbox" value="1" checked />
					<label class="cbx" for="bound"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'bound', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'bound', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="ip_log" name="ip_log" type="checkbox" value="1" checked />
					<label class="cbx" for="ip_log"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'ip_log', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="logs" name="logs" type="checkbox" value="1" checked />
					<label class="cbx" for="logs"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'logs', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'logs', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="delete_ips" name="delete_ips" type="checkbox" value="1" />
					<label class="cbx" for="delete_ips"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'delete_ips', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'delete_ips', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="limit" name="limit" type="checkbox" value="1" />
					<label class="cbx" for="limit"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'limit', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'limit', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="product_verify" name="product_verify" type="checkbox" value="1" />
					<label class="cbx" for="product_verify"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'product_verify', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'product_verify', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="require_version" name="require_version" type="checkbox" value="1" />
					<label class="cbx" for="require_version"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'require_version', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'require_version', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="expire_erase" name="expire_erase" type="checkbox" value="1" />
					<label class="cbx" for="expire_erase"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'expire_erase', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="admit_clone" name="admit_clone" type="checkbox" value="1" checked />
					<label class="cbx" for="admit_clone"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'admit_clone', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="send_discord" name="send_discord" type="checkbox" value="1" />
					<label class="cbx" for="send_discord"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'send_discord', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'send_discord', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="send_webhook" name="send_webhook" type="checkbox" value="1" checked />
					<label class="cbx" for="send_webhook"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'send_webhook', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'send_webhook', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
			</div>
			
		</form>
	</section>

<div class="modal fade" id="generatorKeyConfig" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header"><h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'title'); ?></h1><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <div class="modal-body modal-dialog-scrollable">
			<div class="mb-3">
				<label for="license_digits"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'key_digits'); ?></label>
				<input type="text" class="form-control" placeholder="" value="<?php echo ($_COOKIE['license_digits']) ? $_COOKIE['license_digits'] : 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789'; ?>" name="license_digits" id="license_digits">
			</div>
			<div class="mb-3">
				<label for="license_separator_count"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'quant_of_separator'); ?></label>
				<input type="number" class="form-control" placeholder="" name="license_separator_count" id="license_separator_count" value="<?php echo ($_COOKIE['license_separator_count']) ? $_COOKIE['license_separator_count'] : '4'; ?>">
			</div>
			<div class="mb-3">
				<label for="license_separator"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'separator_digit'); ?></label>
				<input type="text" class="form-control" placeholder="" name="license_separator" id="license_separator" value="<?php echo ($_COOKIE['license_separator']) ? $_COOKIE['license_separator'] : '-'; ?>">
			</div>
			<div class="mb-3">
				<label for="license_quantity"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'qodps'); ?></label>
				<input type="number" class="form-control" placeholder="" name="license_quantity" id="license_quantity" value="<?php echo ($_COOKIE['license_quantity']) ? $_COOKIE['license_quantity'] : '5'; ?>">
			</div>
			<div class="mb-3">
				<label for="examplekey"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'example'); ?></label>
				<input type="text" class="form-control" placeholder="" name="examplekey" id="examplekey" value="">
			</div>
			
			<button type="button" onclick="generateNewKey('examplekey');" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'buttons', 'generate'); ?></button>
			<button type="button" onclick="saveDraftKeyConf();" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'buttons', 'save'); ?></button>
		</div>
    </div>
  </div>
</div>
<?php 
	} else if ($page[1] == 'testing') {
			
	} else { 

	if ($page[2] == 'edit') {
		
		if (!has('dbb.admin.license.edit')) {
			hasNo();
		}
		$docsSQL = $connx->prepare("SELECT * FROM `$dbb_license` WHERE `id` = ?;");
		$docsSQL->execute([$page[1]]);
		$docs = $docsSQL->fetch(PDO::FETCH_ASSOC);
		if ($docsSQL->RowCount() > 0) {
			
			$addons = explode('#', $docs['addons']);
		
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'title', ''); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'create', 'subtitle', ''); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="#" class="btn-a-success create_license_btn"><?php echo lang($messages, $pagename, 'content', 'buttons', 'save', ''); ?></a>
	</div>
</div>
	<section class="card fadeIn">
		<form class="card-body" id="create_license_key" method="POST" autocomplete="off">
			<input type="hidden" value="create_license" id="result" name="result">

			<div class="mb-3">
			
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3 search-container">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" onclick="selectClient(this);" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control w-100" id="client" name="client" autocomplete="key_client" value="<?php echo $docs['client']; ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'client', 'placeholder'); ?>">
						<ul id="clientResults" class="search-results"></ul>
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-copy" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'copy'); ?>" onclick="copyOther('key');"></i> 
								<i class="text-danger fa fa-arrows-rotate" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'refresh'); ?>" onclick="generateNewKey('key'); verifyExistKey();"></i>
								<i class="text-warning fa fa-gear" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'tooltip', 'config'); ?>" data-bs-toggle="modal" data-bs-target="#generatorKeyConfig"></i>
							</span>
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key', 'placeholder'); ?>" value="<?php echo $docs['key']; ?>" id="key" name="key">
					</div>
				</div>
			</div>

			<div class="mb-3 search-container">
				<label for="product" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'label'); ?> <i class="text-danger">*</i></span> 
					<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'tooltip'); ?>"></i> 
				</label>
				<input type="text" class="form-control w-100" id="product" name="product" value="<?php echo $docs['product']; ?>" autocomplete="software_product" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'product', 'placeholder'); ?>">
				<ul id="productResults" class="search-results"></ul>
			</div>
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="ips" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'label'); ?></span> 
							<span>
								<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="number" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'ip_cap', 'placeholder'); ?>" value="<?php echo $addons[0]; ?>" id="ips" name="ips">
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="expire" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'label'); ?> <a href="#" class="expire_time_text"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a></span> 
							<div role="group">
								<a href="#" width="16" height="16" class="" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="text-warning fa fa-gear"></i>
								</a>
								<div class="dropdown-menu">
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Seconds', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'seconds'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Minutes', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'minutes'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Hours', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'hours'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Days', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'days'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Months', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'months'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'months'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Years', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'years'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'years'); ?></a>
									<a href="#" class="dropdown-item" onclick="changeExpireTime('Never', '<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'never'); ?>');"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'type', 'never'); ?></a>
								</div>
							</div>
						</label>
						<div class="input-group">
							<button type="button" style="border-radius: 3px 0px 0px 3px;"><i class="fa fa-calendar"></i></button>
							<input type="hidden" value="Days" id="expire_time" name="expire_time">
							<input type="number" class="form-control" value="" autocomplete="expiration" style="border-radius: 0px 3px 3px 0px !important;" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'expiration', 'placeholder'); ?>" id="expire" name="expire">
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="mb-3">
				<label for="reason" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'label'); ?></span> 
					<span>
						<i class="text-primary fa fa-question-circle" style="margin-right: 5px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'tooltip'); ?>"></i> 
					</span>
				</label>
				<textarea id="reason" name="reason" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'reason', 'placeholder'); ?>" rows="2"><?php echo $docs['reason']; ?></textarea>
			</div>
			
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-8">
						<label for="addons" class="mb-2"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'custom_addons', 'label'); ?></label>
					</div>
					<div class="col-md-4" align="right"><span id="quantAddons">0</span> <?php echo ($addons_bsd) ? '' : '/5'; ?></div>
				</div>
				<section class="custom-addons"></section>
				<div class="custom-addons-add"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'custom_addons', 'button'); ?></div>
			</div>
			<div class="mb-3">
				<label for="addons" class="mb-2"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'label'); ?></label>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="bound" name="bound" type="checkbox" value="1" <?php echo ($addons[1]) ? 'checked' : ''; ?> />
					<label class="cbx" for="bound"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'bound', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'bound', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="ip_log" name="ip_log" type="checkbox" value="1" <?php echo ($addons[2]) ? 'checked' : ''; ?> />
					<label class="cbx" for="ip_log"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'ip_log', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="logs" name="logs" type="checkbox" value="1" <?php echo ($addons[3]) ? 'checked' : ''; ?> />
					<label class="cbx" for="logs"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'logs', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'logs', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="delete_ips" name="delete_ips" type="checkbox" value="1" <?php echo ($addons[4]) ? 'checked' : ''; ?> />
					<label class="cbx" for="delete_ips"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'delete_ips', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'delete_ips', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="limit" name="limit" type="checkbox" value="1" <?php echo ($addons[5]) ? 'checked' : ''; ?> />
					<label class="cbx" for="limit"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'limit', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'limit', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="product_verify" name="product_verify" type="checkbox" value="1" <?php echo ($addons[6]) ? 'checked' : ''; ?> />
					<label class="cbx" for="product_verify"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'product_verify', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'product_verify', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="require_version" name="require_version" type="checkbox" value="1" <?php echo ($addons[7]) ? 'checked' : ''; ?> />
					<label class="cbx" for="require_version"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'require_version', 'text'); ?> 
					<i class="text-primary fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'require_version', 'tooltip'); ?>"></i></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="admit_clone" name="admit_clone" type="checkbox" value="1" <?php echo ($addons[9]) ? 'checked' : ''; ?> />
					<label class="cbx" for="admit_clone"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'addons', 'admit_clone', 'text'); ?></span></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
			</div>
			
		</form>
	</section>

<div class="modal fade" id="generatorKeyConfig" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header"><h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'title'); ?></h1><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
        <div class="modal-body modal-dialog-scrollable">
			<div class="mb-3">
				<label for="license_digits"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'key_digits'); ?></label>
				<input type="text" class="form-control" placeholder="" value="<?php echo ($_COOKIE['license_digits']) ? $_COOKIE['license_digits'] : 'ASDFGHJKLQWERTYUIOPZXCVBNM0123456789'; ?>" name="license_digits" id="license_digits">
			</div>
			<div class="mb-3">
				<label for="license_separator_count"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'quant_of_separator'); ?></label>
				<input type="number" class="form-control" placeholder="" name="license_separator_count" id="license_separator_count" value="<?php echo ($_COOKIE['license_separator_count']) ? $_COOKIE['license_separator_count'] : '4'; ?>">
			</div>
			<div class="mb-3">
				<label for="license_separator"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'separator_digit'); ?></label>
				<input type="text" class="form-control" placeholder="" name="license_separator" id="license_separator" value="<?php echo ($_COOKIE['license_separator']) ? $_COOKIE['license_separator'] : '-'; ?>">
			</div>
			<div class="mb-3">
				<label for="license_quantity"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'qodps'); ?></label>
				<input type="number" class="form-control" placeholder="" name="license_quantity" id="license_quantity" value="<?php echo ($_COOKIE['license_quantity']) ? $_COOKIE['license_quantity'] : '5'; ?>">
			</div>
			<div class="mb-3">
				<label for="examplekey"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'example'); ?></label>
				<input type="text" class="form-control" placeholder="" name="examplekey" id="examplekey" value="">
			</div>
			
			<button type="button" onclick="generateNewKey('examplekey');" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'buttons', 'generate'); ?></button>
			<button type="button" onclick="saveDraftKeyConf();" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'key_config', 'buttons', 'save'); ?></button>
		</div>
    </div>
  </div>
</div>
<?php

		} else {
			echo $page_not_found;
		}
	} else {
		
    $docsSQL = $connx->prepare("SELECT * FROM `$dbb_license` WHERE `id` = ?;");
    $docsSQL->execute([$page[1]]);
    $docs = $docsSQL->fetch(PDO::FETCH_ASSOC);
	if ($docs['expire'] == '-1') $expiration = 'Never'; else $expiration = counttimedown($docs['expire'], 'Expired');
	if ($docs['status']) $status = 'Active'; else $status = 'Inactive';
	$custom_addons = $docs['custom_addons'];
	$addons = explode('#', $docs['addons']);
	$addons_array = explode('#', $custom_addons);
	if ($custom_addons == NULL) $addons_array = 0; else $addons_array = count($addons_array);
	$ips = explode('#', $docs['ip']);
	$activity = explode('#', $docs['activity']);
	if ($docs['ip'] == NULL) $counts = 0; else $counts = count($ips);
	$var_key_1 = array('{license:id}', '{license:key}', '{license:date}', '{license:expire}', '{license:product}', '{license:status}', '{license:quant:custom_addons}', '{license:ips}', '{license:ipsmax}');
	$var_key_2 = array($docs['id'], $docs['key'], countSince($docs['since']), $expiration, $docs['product'], $status, $addons_array, $counts, $addons[0]);
	
    $productSQL = $connx->prepare("SELECT * FROM `$dbb_product` WHERE `id_name` = ?;");
    $productSQL->execute([$docs['product']]);
    $product = $productSQL->fetch(PDO::FETCH_ASSOC);
	
    $pupdateSQL = $connx->prepare("SELECT * FROM `$dbb_product_update` WHERE `product` = ? ORDER BY id DESC;");
    $pupdateSQL->execute([$product['id']]);
    $pupdate = $pupdateSQL->fetch(PDO::FETCH_ASSOC);
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'title')); ?></b></h5>
		<h1><b><?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'subtitle')); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<?php if (has('dbb.admin.license.edit')) { ?>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/<?php echo $page[1]; ?>/edit" width="16" height="16" class="change-page btn-a" style="text-decoration: none;"><?php echo lang($messages, $pagename, 'content', 'buttons', 'edit', '', '', ''); ?></a>
		<?php } ?>
		<?php if ($productSQL->RowCount() > 0 AND $pupdateSQL->RowCount() > 0) { ?>
		<a href="#" class="btn-a-suave download_files" data-file="<?php echo $pupdate['file']; ?>" data-secret="<?php echo $pupdate['file']; ?>">
			<?php echo lang($messages, $pagename, 'content', 'buttons', 'download'); ?> v<?php echo $pupdate['version']; ?>
		</a>
		<?php } ?>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back', '', '', ''); ?></a>
	</div>
</div>


<div class="row fadeIn">
	<div class="col-lg-12 col-md-12 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'key', 'title')); ?></h4>
						<h6 class="mt-0 text-muted"><?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'key', 'subtitle')); ?> <button class="btn-a-suave" onclick="copyText('<?php echo $docs['key']; ?>');"><i class="fa fa-copy"></i></button></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<img src="<?php echo hasDocs($dbb_user, 'udid', $docs['client'], 'avatar'); ?>" style="width: 48px; border-radius: 3px;" alt="DevByBit">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo hasDocs($dbb_user, 'udid', $docs['client'], 'username'); ?></h4>
						<h6 class="text-muted"><?php echo rank('name', hasDocs($dbb_user, 'udid', $docs['client'], 'id')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-calendar"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'created_at', 'title'); ?></h4>
						<h6 class="text-muted"><?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'created_at', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-calendar-xmark"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'expire', 'title'); ?></h4>
						<h6 class="text-muted"><?php 
						echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'expire', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-box-archive"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'product', 'title'); ?></h4>
						<h6 class="text-muted"><?php 
						echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'product', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-square-poll-vertical"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'status', 'title'); ?></h4>
						<h6 class="text-muted"><?php 
						echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'status', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12 mb-2">
		<div class="card fadeIn">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="fa fa-puzzle-piece"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'custom_addons', 'title'); ?></h4>
						<h6 class="text-muted"><?php 
						echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'card', 'custom_addons', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="card fadeIn mb-2"><div class="card-body"><div id="request-chart"></div></div></section>

<div class="card fadeIn mb-2">
	<div class="card-body group_tabview">
		<div class="d-flex justify-content-between align-items-lg-center mb-2">
			<h5>
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 8l0 4l2 2" /><path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg>
			<?php echo lang($messages, $pagename, 'content', 'overview', 'ip_history', 'title', '', ''); ?></h5>
			<h5 class="text-muted">
				<?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'ip_history', 'counter', '')); ?>
				<button class="btn-a-suave"><i class="fa fa-rotate"></i> <?php echo str_replace($var_key_1, $var_key_2, lang($messages, $pagename, 'content', 'overview', 'ip_history', 'button', '')); ?></button>
			</h5>
		</div>
		<div class="package-page" id="packages-card-body">
			<div class="categories">
				<div class="category" id="product_group">
					<ul class="packages mb-0 collapse show ntp-packages product_group_list" id="product_group_list">
						<?php 
						for ($i = 0; $i < $counts; $i++) {
							?>
							<li class="border-top-0">
								<div class="row d-flex align-items-center">
									<a class="col-9 passive-link" style="text-decoration: none;" href="#">
										<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><?php echo $ips[$i]; ?></h6></div>
									</a>
									<div class="col-3 text-right d-flex align-items-center justify-content-end"><?php echo $activity[$i]; ?></div>
								</div>
							</li>
							<?php 
						}
						if ($count == 0) {
							echo '<li class="border-top-0">
									<div class="row d-flex align-items-center">
										<div class="col-9 passive-link" style="text-decoration: none;">
											<div class="package-name d-inline-block ml-3"><h6 class="mb-0">' . lang($messages, 'error', 'not_results_on_db') . '</h6></div>
										</div>
										<div class="col-3 text-right d-flex align-items-center justify-content-end">...</div>
									</div>
								</li>';
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
    function updateChart() {
        $.ajax({
            type: "POST",
            url: site_domain + "/execute/action.php",
            data: { result: 'chart_license_admin_per_key', chartValue: '<?php echo $page[1]; ?>' },
            dataType: "json",
            success: function(response) {
				var newData = [
					{ name: 'Denied', data: Object.values(response.deniedData) },
					{ name: 'Accepted', data: Object.values(response.acceptedData) }
				];
				chart.updateSeries(newData);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }

    var options = {
        colors: ['#c33737', '#8fff69'],
        series: [{
            name: 'Denied',
            data: []
        }, {
            name: 'Accepted',
            data: []
        }],
        chart: {
            background: 'transparent',
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: [
				'<?php echo lang($messages, 'months', 'low', 'jan'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'feb'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'mar'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'apr'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'may'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'jul'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'jun'); ?>',
				'<?php echo lang($messages, 'months', 'low', 'aug'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'sep'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'oct'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'nov'); ?>', 
				'<?php echo lang($messages, 'months', 'low', 'dec'); ?>'
			],
        },
        yaxis: {
            title: {
                text: 'Requests'
            }
        },
        fill: {
            opacity: 0.6
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " request";
                }
            }
        },
        theme: {
            mode: document.documentElement.getAttribute('data-bs-theme')
        }
    };

    var chart = new ApexCharts(document.querySelector("#request-chart"), options);
    chart.render();

    updateChart();

    setInterval(updateChart, 60000);
});
</script>
<?php }
} ?>

