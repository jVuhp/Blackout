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
$pagename = 'product';
$pageicon = 'product';
$position = '2';
$pageview = '1';
$permission = '';
if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }

if (!$page[1]) {
?>
	
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"> <i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, 'product', 'content', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<?php if (has('dbb.admin.product.create')) { ?>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>/create" class="change-page btn-a"><?php echo lang($messages, 'product', 'content', 'create', 'buttons', 'ref'); ?></a>
		<?php } ?>
	</div>
</div>
<p></p>
<section class="card fadeIn">
	<div class="card-body" id="product">
		<div class="row d-flex align-items-center mb-3">
			<div class="col-md-8">
				<input type="text" class="form-control w-50" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>" id="search">
				<input type="hidden" value="product" id="tabPage">
				<input type="hidden" value="1" id="paginationID">
				<input type="hidden" value="<?php echo ($_COOKIE['column_product_selected']) ? $_COOKIE['column_product_selected'] : 'id#DESC'; ?>" id="option">
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
	window.activeTab = 'product';
	productCall();
});
</script>
<?php 

} else if ($page[1] == 'create') {
if (!has('dbb.admin.product.create')) {
	hasNo();
}

setcookie('product_actions', '{"file_download": [],"license": [],"group": []}', time() + 3600*24*30, '/');

$json_data = '{"file_download": [],"license": [],"group": []}';
$datas = json_decode($json_data, true);
$file_download_count = count($datas['file_download']);
$license_count = count($datas['license']);
$group_count = count($datas['group']);
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, 'product', 'content', 'create', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, 'product', 'content', 'create', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="<?php echo URI . '/' . $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, 'product', 'content', 'create', 'buttons', 'back'); ?></a>
	</div>
</div>
	<section class="card fadeIn mb-3">
		<form id="productCreate" method="POST" class="card-body product_create">
			<input type="hidden" value="create_product" name="result">
		
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'id_name', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'id_name', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'id_name', 'placeholder'); ?>" id="id_name" name="id_name">
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'name', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'name', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'name', 'placeholder'); ?>" id="name" name="name">
					</div>
				</div>
			</div>
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-<?php echo (TEBEX_PAYMENT) ? '4' : '6'; ?> col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'price', 'label'); ?> <i class="text-danger">*</i></span> 
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'price', 'placeholder'); ?>" id="price" name="price">
					</div>
					<div class="col-md-<?php echo (TEBEX_PAYMENT) ? '4' : '6'; ?> col-sm-12 mb-3">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'version', 'label'); ?> <i class="text-danger">*</i></span> 
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'version', 'placeholder'); ?>" id="version" name="version">
					</div>
					<?php if (TEBEX_PAYMENT) { ?>
					<div class="col-md-4 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><a href="https://creator.tebex.io/packages" target="_BLANK"><?php echo lang($messages, 'product', 'content', 'create', 'form', 'tebex_product', 'label'); ?></a> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'tebex_product', 'tooltip'); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'tebex_product', 'placeholder'); ?>" id="tebex_product" name="tebex_product">
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="mb-3">
				<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'description', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'description', 'tooltip'); ?>"></i> 
					</span>
				</label>
				<textarea type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'description', 'placeholder'); ?>" id="description" name="description"></textarea>
			</div>
			<div class="mb-3">
				<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'icon', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'icon', 'tooltip'); ?>"></i> 
					</span>
				</label>
				<input type="text" class="form-control" placeholder="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'icon', 'placeholder'); ?>" id="icon" name="icon">
			</div>
			<?php if (TEBEX_PAYMENT) { ?>
			<div class="mb-3">
				<label for="actions" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question mr-5" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'tooltip'); ?>"></i> 
					</span>
				</label>
				<div class="card mb-2">
					<div class="card-header">
						<button type="button" class="btn-a active mr-5 file_tab"><?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'file_download', 'button'); ?></button>
						<button type="button" class="btn-a mr-5 license_tab"><?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'license_key', 'button'); ?></button>
						<button type="button" class="btn-a mr-5 group_tab"><?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'group', 'button'); ?></button>
					</div>
					<div class="card-body file_tabview">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-download"></i> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'file_download', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantFiles">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<input type="file" id="file_upload" style="display: none;" onchange="fileSelected(this);">
						<div class="caa add_more_files"><i class="fa fa-plus" style="margin-right: 7px;"></i> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'file_download', 'new_file'); ?></div>
						<div class="package-page mb-3" id="file_uploaded_list">
							<div class="categories">
								<div class="category">
									<div class="header">
									  <div class="row d-flex align-items-center">
										<a class="col-7 passive-link" href="#" style="1">
											<div class="category-name d-inline-block ml-3"><h6 class="mb-0"> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'file_download', 'header'); ?></h6></div>
										</a>
									  </div>
									</div>
									<ul class="packages mb-0 collapse show ntp-packages" id="file_uploaded"></ul>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body license_tabview" hidden="hidden">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-key"></i> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'license_key', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantKeys">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<div class="caa add_more_license"><i class="fa fa-plus" style="margin-right: 7px;"></i> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'license_key', 'new_keys'); ?></div>
						<div class="article_list"></div>
					</div>
					<div class="card-body group_tabview" hidden="hidden">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-layer-group"></i> <?php echo lang($messages, 'product', 'content', 'create', 'form', 'actions', 'group', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantChecked">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<div class="package-page" id="packages-card-body">
							<div class="categories">
								<div class="category" id="product_group">
									<ul class="packages mb-0 collapse show ntp-packages product_group_list" id="product_group_list">
										<?php 
										$groupSQL = $connx->prepare("SELECT * FROM `$dbb_group` ORDER BY position DESC");
										$groupSQL->execute();
										if ($groupSQL->RowCount() > 0) {
										while ($group = $groupSQL->fetch(PDO::FETCH_ASSOC)) {
											$group_checked = (isset($datas['group']) && is_array($datas['group']) && in_array($group['id'], array_column($datas['group'], 'id'))) ? 'checked' : '';
										?>
										<li class="border-top-0" data-id="<?php echo $group['id']; ?>">
											<div class="row d-flex align-items-center">
												<a class="col-9 passive-link" style="text-decoration: none;" href="#">
												<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color:<?php echo $group['color']; ?>;"></i> <?php echo $group['name']; ?></h6></div></a>
												<div class="col-3 text-right d-flex align-items-center justify-content-end">
													<div class="checkbox-wrapper-64">
														<label class="switch"><input type="checkbox" class="group-checkbox" data-id="<?php echo $group['id']; ?>" <?php echo $group_checked; ?>><span class="slider"></span></label>
													</div>
												</div>
											</div>
										</li>
										<?php }
										} else echo '<b class="text-danger">' . lang($messages, $pagename, 'error', 'not_group_on_db') . '</b>'; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<button type="submit" class="btn-a"><?php echo lang($messages, 'product', 'content', 'create', 'buttons', 'create'); ?></button>
		</form>
	</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	countActionsArray();
});
</script>
<?php

} else { 
	if ($page[2] == 'edit') {
		if (!has('dbb.admin.product.edit')) {
			hasNo();
		}

if (hasExist($dbb_product, 'id', $page[1])) {
	$json_data = hasDocs($dbb_product_actions, 'product', $page[1], 'data');
	$datas = json_decode($json_data, true);
	if (!empty($json_data)) {
		$file_download_count = count($datas['file_download']);
		$license_count = count($datas['license']);
		$group_count = count($datas['group']);
	} else {
		$file_download_count = 0;
		$license_count = 0;
		$group_count = 0;
	}
?>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'edit_title'); ?></b></h5>
		<h1><b><?php echo hasDocs($dbb_product, 'id', $page[1], 'name'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="<?php echo URI . '/' . $page[0]; ?>" class="change-page btn-a"><i class="fa fa-chevron-left"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'buttons', 'back'); ?></a>
	</div>
</div>
	<section class="card fadeIn mb-3">
		<form id="productEdit" method="POST" class="card-body product_create">
			<input type="hidden" value="product_edit" name="result">
			<input type="hidden" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'id'); ?>" name="product_id">
		
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'id_name', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="
								<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'id_name', 'tooltip', ''); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'id_name'); ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'id_name', 'placeholder', ''); ?>" id="id_name" name="id_name">
					</div>
					<div class="col-md-6 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'name', 'label'); ?> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'name', 'tooltip', ''); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'name'); ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'name', 'placeholder', ''); ?>" id="name" name="name">
					</div>
				</div>
			</div>
			<div class="mb-3">
				<div class="row d-flex align-items-center">
					<div class="col-md-<?php echo (TEBEX_PAYMENT) ? '4' : '6'; ?> col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'price', 'label'); ?> <i class="text-danger">*</i></span> 
						</label>
						<input type="text" class="form-control" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'price'); ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'price', 'placeholder', ''); ?>" id="price" name="price">
					</div>
					<div class="col-md-<?php echo (TEBEX_PAYMENT) ? '4' : '6'; ?> col-sm-12 mb-3">
						<label for="client" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'version', 'label'); ?> <i class="text-danger">*</i></span> 
						</label>
						<input type="text" class="form-control" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'version'); ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'version', 'placeholder', ''); ?>" id="version" name="version">
					</div>
					<?php if (TEBEX_PAYMENT) { ?>
					<div class="col-md-4 col-sm-12 mb-3">
						<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
							<span><a href="https://creator.tebex.io/packages" target="_BLANK"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'tebex_product', 'label'); ?></a> <i class="text-danger">*</i></span> 
							<span>
								<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'tebex_product', 'tooltip', ''); ?>"></i> 
							</span>
						</label>
						<input type="text" class="form-control" value="<?php echo hasDocs($dbb_product, 'id', $page[1], 'tebex'); ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'tebex_product', 'placeholder', ''); ?>" id="tebex_product" name="tebex_product">
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="mb-3">
				<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'description', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'description', 'tooltip', ''); ?>"></i> 
					</span>
				</label>
				<textarea type="text" class="form-control" placeholder="Product description" id="description" name="description"><?php echo hasDocs($dbb_product, 'id', $page[1], 'description'); ?></textarea>
			</div>
			<div class="mb-3">
				<label for="key" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'icon', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'icon', 'tooltip', ''); ?>"></i> 
					</span>
				</label>
				<input type="text" class="form-control" value="<?php echo (hasDocs($dbb_product, 'id', $page[1], 'icon_type')) ? hasDocs($dbb_product, 'id', $page[1], 'icon') : ''; ?>" placeholder="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'icon', 'placeholder', ''); ?>" id="icon" name="icon">
			</div>
			<?php if (TEBEX_PAYMENT) { ?>
			<div class="mb-3">
				<label for="actions" class="d-flex justify-content-between align-items-lg-center mb-2">
					<span><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'label'); ?></span> 
					<span>
						<i class="text-primary fa-regular fa-circle-question mr-5" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'tooltip', ''); ?>"></i> 
					</span>
				</label>
				<div class="card mb-2">
					<div class="card-header">
						<button type="button" class="btn-a active mr-5 file_tab"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'file_download', 'button'); ?></button>
						<button type="button" class="btn-a mr-5 license_tab"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'license_key', 'button'); ?></button>
						<button type="button" class="btn-a mr-5 group_tab"><?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'group', 'button'); ?></button>
					</div>
					<div class="card-body file_tabview">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-download"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'file_download', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantFiles">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<input type="file" id="file_upload" style="display: none;" onchange="fileSelected(this);">
						<div class="caa add_more_files"><i class="fa fa-plus" style="margin-right: 7px;"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'file_download', 'new_file'); ?></div>
						<div class="package-page mb-3" id="file_uploaded_list">
							<div class="categories">
								<div class="category">
									<div class="header">
									  <div class="row d-flex align-items-center">
										<a class="col-7 passive-link" href="#" style="1">
											<div class="category-name d-inline-block ml-3"><h6 class="mb-0"> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'file_download', 'header'); ?></h6></div>
										</a>
									  </div>
									</div>
									<ul class="packages mb-0 collapse show ntp-packages" id="file_uploaded"></ul>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body license_tabview" hidden="hidden">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-key"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'license_key', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantKeys">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<div class="caa add_more_license"><i class="fa fa-plus" style="margin-right: 7px;"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'license_key', 'new_keys'); ?></div>
						<div class="article_list"></div>
					</div>
					<div class="card-body group_tabview" hidden="hidden">
						<div class="d-flex justify-content-between align-items-lg-center mb-2">
							<h5><i class="fa fa-layer-group"></i> <?php echo lang($messages, $pagename, 'content', 'create', 'form', 'actions', 'group', 'title'); ?></h5>
							<h5 class="text-muted"><span id="quantChecked">0</span><?php echo ($addons_bsd) ? '' : '/1'; ?></h5>
						</div>
						<div class="package-page" id="packages-card-body">
							<div class="categories">
								<div class="category" id="product_group">
									<ul class="packages mb-0 collapse show ntp-packages product_group_list" id="product_group_list">
										<?php 
										$groupSQL = $connx->prepare("SELECT * FROM `$dbb_group` ORDER BY position DESC");
										$groupSQL->execute();
										if ($groupSQL->RowCount() > 0) {
										while ($group = $groupSQL->fetch(PDO::FETCH_ASSOC)) {
											$group_checked = (isset($datas['group']) && is_array($datas['group']) && in_array($group['id'], array_column($datas['group'], 'id'))) ? 'checked' : '';
										?>
										<li class="border-top-0" data-id="<?php echo $group['id']; ?>">
											<div class="row d-flex align-items-center">
												<a class="col-9 passive-link" style="text-decoration: none;" href="#">
												<div class="package-name d-inline-block ml-3"><h6 class="mb-0"><i class="fa fa-circle-half-stroke" style="color:<?php echo $group['color']; ?>;"></i> <?php echo $group['name']; ?></h6></div></a>
												<div class="col-3 text-right d-flex align-items-center justify-content-end">
													<div class="checkbox-wrapper-64">
														<label class="switch"><input type="checkbox" class="group-checkbox" data-id="<?php echo $group['id']; ?>" <?php echo $group_checked; ?>><span class="slider"></span></label>
													</div>
												</div>
											</div>
										</li>
										<?php }
										} else echo '<b class="text-danger">' . lang($messages, $pagename, 'error', 'not_group_on_db') . '</b>'; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<button type="submit" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'buttons', 'save', '', ''); ?></button>
		</form>
	</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	updateData('<?php echo $json_data; ?>');
	countActionsArray();
});
</script>
<?php
} else {
	echo $page_not_found;
}
	} else {
		$icon = hasDocs($dbb_product, 'id', $page[1], 'icon');
		$icon_bg = hasDocs($dbb_product, 'id', $page[1], 'icon_bg');
		if (hasDocs($dbb_product, 'id', $page[1], 'icon_type')) {
			$icon_type = '<img src="' . $icon . '" class="' . $icon_bg . '" width="96px" height="96px" alt="DevByBit" style="padding: 3px; border-radius: 5px;">';
		} else {
			$icon_type = '<h5 class="' . $icon_bg . '" style="width: 96px !important; height: 96px !important; padding: 3px; border-radius: 5px;"><b style="font-size: 32px;">' . $icon . '</b></h5>';
		}
		$json_data = hasDocs($dbb_product_actions, 'product', $page[1], 'data');
		$datas = json_decode($json_data, true);
		
		if (!empty($json_data)) {
			$file_download_count = count($datas['file_download']);
			$license_count = count($datas['license']);
			$group_count = count($datas['group']);
		} else {
			$file_download_count = 0;
			$license_count = 0;
			$group_count = 0;
		}
		$var1 = array("{product:name}", "{product:count:files}", "{product:count:keys}", "{product:count:group}");
		$var2 = array(hasDocs($dbb_product, 'id', $page[1], 'name'), $file_download_count, $license_count, $group_count);
		$var3 = str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'title'));
		
		$productId = $page[1];
		$docsSQL = $connx->prepare("SELECT * FROM `$dbb_basket_payment` WHERE `product` = ?;");
		$docsSQL->execute([$productId]);
		$price_end = 0;
		while ($product = $docsSQL->fetch(PDO::FETCH_ASSOC)) {
			$totalPrice = $product['p_price'] * $product['quantity'];
			$price_end += $totalPrice;
		}
		$product_name = hasDocs($dbb_product, 'id', $page[1], 'id_name');
		$keysSQL = $connx->prepare("SELECT COUNT(id) AS total FROM `$dbb_license` WHERE `product` = ?;");
		$keysSQL->execute([$product_name]);
		$keys = $keysSQL->fetch(PDO::FETCH_ASSOC);
		
		$pr_version = (hasExist($dbb_product_update, 'product', $page[1])) ? hasDocs($dbb_product_update, 'product', $page[1], 'version') : hasDocs($dbb_product, 'id', $page[1], 'version');
		
?>


<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo $var3; ?></b></h5>
		<h1><b><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'subtitle')); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'create', 'buttons', 'back', '', ''); ?></a>
		<?php if (has('dbb.admin.product.update')) { ?>
			<a href="#" class="btn-a-primary create_update" data-id="<?php echo $page[1]; ?>"><?php echo lang($messages, $pagename, 'content', 'create', 'buttons', 'update', '', ''); ?></a>
			<a href="#" class="btn-a-danger cancel_update" hidden="hidden"><?php echo lang($messages, $pagename, 'content', 'create', 'buttons', 'cancel', '', ''); ?></a>
		<?php } ?>
	</div>
</div>
<div class="row fadeIn">
	<div class="col-lg-6 col-md-12 col-sm-12 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'keys', 'icon', ''); ?></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'keys', 'text', ''); ?></h4>
						<h6 class="text-muted"><?php echo number_format($keys['total'],0,'.','.'); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'profits', 'icon', ''); ?></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'profits', 'text', ''); ?> <i class="text-primary fa-regular fa-circle-question" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'overview', 'card', 'profits', 'tooltip', ''); ?>"></i></h4>
						<h6 class="text-muted">$<?php echo number_format($price_end,2,'.','.'); ?> USD</h6>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="card fadeIn mb-2">
	<div class="card-body">
		<div class="media align-items-center">
			<?php echo $icon_type; ?>
			<div class="media-body">
				<h2 class="mb-0 text-sm">
					<b><?php echo hasDocs($dbb_product, 'id', $page[1], 'name'); ?></b> 
					<span class="text-muted" style="font-size: 18px;">v<?php echo $pr_version; ?></span> 
				</h2>
				<p class="text-muted">
					<?php echo hasDocs($dbb_product, 'id', $page[1], 'description'); ?>
				</p>
			</div>
        </div>
	</div>
</div>
<?php if (TEBEX_PAYMENT) { ?>
<div class="row fadeIn">
	<div class="col-lg-4 col-md-12 col-sm-12 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;">
					<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'files', 'icon')); ?></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'files', 'title')); ?></h4>
						<h6 class="text-muted"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'files', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;">
					<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'keys', 'icon')); ?></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'keys', 'title')); ?></h4>
						<h6 class="text-muted"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'keys', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;">
						<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'group', 'icon')); ?>
					</h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'group', 'title')); ?></h4>
						<h6 class="text-muted"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'card', 'actions', 'group', 'subtitle')); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php } ?>
<hr>

<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h1><b><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'updates', 'title')); ?></b></h1>
	</div>
</div>

<div class="card fadeIn mb-2">
	<form id="create_update" class="form_update" hidden="hidden">
		<div id="loaders" class="loader" style="display: none;">
            <div class="spinner">
                <i class="fa fa-circle-notch fa-spin"></i>
            </div>
        </div>
		<div class="card-body">
			<h4><?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'title', '', ''); ?></h4>
			<div class="mb-3">
				<label for="new_version_number"><?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'new_version', 'label', ''); ?> <i class="text-danger">*</i></label>
				<input type="text" class="form-control" placeholder="<?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'new_version', 'placeholder', ''); ?>" id="new_version_number" name="new_version_number">
				<input type="hidden" class="form-control" value="update_product" name="result">
				<input type="hidden" class="form-control" value="<?php echo $page[1]; ?>" name="product">
			</div>
			<div class="mb-3">
				<label for="new_content"><?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'new_content', '', ''); ?> <i class="text-danger">*</i></label>
				<input type="file" class="form-control" id="new_content" name="new_content">
			</div>
			<div class="mb-3">
				<label for="new_title"><?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'new_title', '', ''); ?></label>
				<input type="text" class="form-control" id="new_title" name="new_title">
			</div>
			<div class="mb-3">
				<label for="new_message"><?php echo lang($messages, $pagename, 'content', 'updates', 'form', 'new_message', '', ''); ?></label>
				<textarea class="form-control" id="new_message" name="new_message"></textarea>
				<textarea hidden class="form-control" id="new_message_hidden" name="new_message_hidden"></textarea>
			</div>
		</div>
		<hr>
	</form>
	<?php
    $updateSQL = $connx->prepare("SELECT * FROM `$dbb_product_update` WHERE `product` = ? ORDER BY since DESC;");
    $updateSQL->execute([$page[1]]);
	if ($updateSQL->RowCount() > 0) {
		while ($updates = $updateSQL->fetch(PDO::FETCH_ASSOC)) {
		$downloadSQL = $connx->prepare("SELECT COUNT(id) AS count FROM `$dbb_download` WHERE `file` = ?;");
		$downloadSQL->execute([$updates['file']]);
		$download = $downloadSQL->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="card-body" id="<?php echo $updates['id']; ?>">
		<div class="d-flex justify-content-between align-items-lg-center py-2 flex-column flex-lg-row">
			<h4><span class="p-2 bg-dark shadow rounded text-success"> <?php echo lang($messages, $pagename, 'content', 'updates', 'card', 'version', '', ''); ?> <?php echo $updates['version']; ?></span> <?php echo $updates['title']; ?></h4>
			<h6 class="text-right"><b style="margin-right: 10px;"><i class="text-danger fa fa-download"></i> <?php echo $download['total']; ?></b> <span><i class="fa fa-calendar"></i> <?php echo countSince($updates['since']); ?></span></h6>
		</div>
		<?php echo $updates['description']; ?>
		<div class="d-flex justify-content-between align-items-lg-center">
			<h6></h6>
			
			<h6 class="text-right">
			<?php if (has('dbb.admin.product.update.edit')) { ?>
			<a href="#" class="btn-a-primary"><?php echo lang($messages, $pagename, 'content', 'updates', 'card', 'buttons', 'edit', ''); ?></a> 
			<?php } if (has('dbb.admin.product.update.erase')) { ?>
			<a href="#" class="btn-a-danger"><?php echo lang($messages, $pagename, 'content', 'updates', 'card', 'buttons', 'erase', ''); ?></a>
			<?php } ?>
			</h6>
		</div>
	</div>
	<hr>
	
	<?php
		}
	} else { ?>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-lg-center py-2 flex-column flex-lg-row">
			<h4><span class="p-2 bg-dark shadow rounded text-success"> <?php echo lang($messages, $pagename, 'content', 'updates', 'card', 'version', '', ''); ?> <?php echo hasDocs($dbb_product, 'id', $page[1], 'version'); ?></span></h4>
			<h6 class="text-right"><i class="fa fa-calendar"></i> <?php echo countSince(hasDocs($dbb_product, 'id', $page[1], 'since')); ?></h6>
		</div>
		<?php echo lang($messages, $pagename, 'content', 'updates', 'card', 'initial_released', '', ''); ?>
	</div>
	<?php 
	} ?>
</div>
<?php
	}
}

?>