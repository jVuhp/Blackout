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
$pagename = 'group';
$pageicon = 'group';
$position = '4';
$pageview = '1';
$permission = 'dbb.admin.group';

if (!has('dbb.admin.group')) {
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
		<div class="col-md-4" align="right">
			<?php if (has('dbb.admin.group.create')) { ?>
			<a href="#" id="generate_new_group" class="btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'create'); ?></a>
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
					<input type="hidden" value="position#DESC" id="option">
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
			<div class="package-page mb-3" id="new-groups-list" hidden>
				<div class="categories">
					<div class="category">
						<div class="header">
						  <div class="row d-flex align-items-center">
							<a class="col-7 passive-link" href="#" style="1">
							  <i class="fa fa-plus p-2 d-inline-block"></i><div class="category-name d-inline-block ml-3"><h6 class="mb-0"> <?php echo lang($messages, $pagename, 'content', 'new'); ?></h6></div>
							</a>
						  </div>
						</div>
						<ul class="packages mb-0 collapse show ntp-packages" id="groupss-list"></ul>
					</div>
				</div>
			</div>
			<div class="table-responsive table-container mb-3 packages" id="load_index_result"></div>
		</div>
	</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'group';
	groupCall();
	$('.packages').sortable({
		handle: '.move',
		placeholder: 'sortable-placeholder',
		forcePlaceholderSize: true,
		items: 'li', 
		onDrop: function ($item, container, _super, event) { console.log('Elemento de paquete soltado:' + container); },
		update: function (event, ui) {
			var totalItems = ui.item.parent().children().length;
			var reverseIndex = totalItems - ui.item.index();
			var dataId = ui.item.data('id');
			var result = 'move-group';
			$.post( site_domain + '/execute/action.php', { result : result, data_id : dataId, position : reverseIndex, total : totalItems }, function( response ) {});
		},
	});
});
</script>
<?php 
} else {
	$groupSQL = $connx->prepare("SELECT * FROM `$dbb_group` WHERE `id` = ?;");
	$groupSQL->execute([$page[1]]);
	if ($groupSQL->RowCount() > 0) {
	$group = $groupSQL->fetch(PDO::FETCH_ASSOC);
	$permissionCount = $connx->prepare("SELECT * FROM `$dbb_group_permission` WHERE `group` = ?;");
	$permissionCount->execute([$group['id']]);

	$userCount = $connx->prepare("SELECT * FROM `$dbb_group_user` WHERE `group` = ?;");
	$userCount->execute([$group['id']]);
	
	$var1 = array("{group:name}", "{group:color}");
	$var2 = array($group['name'], $group['color']);
?>

<div class="row d-flex align-items-center fadeIn mb-2">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'title')); ?></b></h5>
		<h1><b style="color: <?php echo $group['color']; ?>;"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'subtitle')); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<?php if (has('dbb.admin.group.edit')) { ?>
		<a href="#" width="16" height="16" class="btn-a mr-2" id="change_to_edit"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'buttons', 'edit')); ?></a>
		<?php } ?>
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'buttons', 'back')); ?></a>
	</div>
</div>
<?php if (has('dbb.admin.group.edit')) { ?>
<div class="card mb-2 fadeIn" id="edit_the_group" style="display: none;">
	<div class="card-body">
		<form id="modifiedGroup" method="POST">
			<input type="hidden" value="modified_group_info" name="result">
			<input type="hidden" value="<?php echo $group['id']; ?>" name="group_id">
			<div class="mb-3">
				<label for="group_name"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'edit', 'name', 'label')); ?></label>
				<input type="text" class="form-control form-control w-100" name="group_name" id="group_name" value="<?php echo $group['name']; ?>" placeholder="<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'edit', 'name', 'placeholder')); ?>">
			</div>
			<div class="mb-3">
				<label for="group_color"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'edit', 'color', 'label')); ?></label>
				<input type="color" class="form-control form-control-color w-100" name="group_color" id="group_color" value="<?php echo $group['color']; ?>" title="<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'edit', 'color', 'title')); ?>">
			</div>
			<div class="mb-3">
				<div class="checkbox-wrapper-4 mb-1">
					<input class="inp-cbx" id="group_default" name="group_default" type="checkbox" value="1" <?php echo ($group['default']) ? 'checked' : ''; ?> />
					<label class="cbx" for="group_default"><span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
					<span><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'edit', 'default')); ?></label>
					<svg class="inline-svg"><symbol id="check-4" viewbox="0 0 12 10"><polyline points="1.5 6 4.5 9 10.5 1"></polyline></symbol></svg>
				</div>
			</div>
			<div class="mb-3">
				<button type="submit" class="btn-a"><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'buttons', 'save')); ?></button>
			</div>
		</form>
	</div>
</div>
<?php } ?>
<div class="row-mb">
	<section class="card-deck">
		<div class="card mb-2 card-stats">
			<div class="card-body">
				<i class="card-stats-img mb-lg-3 fa fa-scroll font-50"></i>
				<h3 class="text-theme" id="permission_count_list" data-id="<?php echo number_format($permissionCount->RowCount(),0,'.',','); ?>"><?php echo number_format($permissionCount->RowCount(),0,'.',','); ?></h3>
			</div>
		</div>
		<div class="card mb-2 card-stats">
			<div class="card-body">
				<i class="card-stats-img mb-lg-3 fa fa-user-group font-50"></i>
				<h3 class="text-theme" id="users_count_list" data-id="<?php echo number_format($userCount->RowCount(),0,'.',','); ?>"><?php echo number_format($userCount->RowCount(),0,'.',','); ?></h3>
			</div>
		</div>
	</section>
</div>

<input type="hidden" value="<?php echo $group['id']; ?>" id="groupId">
<div class="card fadeIn mb-3">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="permissions-tabs" data-bs-toggle="tab" data-bs-target="#permissions-tab" type="button" role="tab" aria-controls="permissions-tab" aria-selected="true">
				<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'permissions', 'tab')); ?>
			</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="users" data-bs-toggle="tab" data-bs-target="#users-tab" type="button" role="tab" aria-controls="users-tab" aria-selected="false">
				<?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'users', 'tab')); ?>
			</button>
		</li>
	</ul>
	<div class="card-body">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="permissions-tab" role="tabpanel" aria-labelledby="permissions-tabs" tabindex="0">
				<div class="media align-items-center">
					<div class="media-body">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<h4 class="mb-3 text-sm"><i class="fa fa-scroll"></i> <b><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'permissions', 'title')); ?></b></h4>
							</div>
							<div class="col-md-6" align="right">
								<?php if (has('dbb.admin.group.permission.add')) { ?><a href="#" class="btn-a mb-3 text-sm start-add-perm"><i class="fa fa-plus"></i></a><?php } ?>
								<a href="#" class="btn-a mb-3 text-sm hidden_permission_list"><?php echo ($_COOKIE['hidden_permission_list']) ? '<i class="fa fa-chevron-up"></i>' : '<i class="fa fa-chevron-down"></i>'; ?></a>
							</div>
						</div>
						<div class="permission_in_list" <?php echo ($_COOKIE['hidden_permission_list']) ? 'style="display: none;"' : ''; ?>>
							<div class="mb-3">
								<input type="text" class="form-control" name="search" id="search" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>">
								<input type="hidden" value="group_permission" id="tabPage">
								<input type="hidden" value="1" id="paginationID">
								<input type="hidden" value="id#DESC" id="option">
								<select class="form-control w-20" id="total" hidden>
									<option value="10" selected>10</option>
								</select>
							</div>
							<div class="mb-3" id="load_permission_list"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="users-tab" role="tabpanel" aria-labelledby="users" tabindex="0">
				<div class="media align-items-center">
					<div class="media-body">
						<div class="row d-flex align-items-center">
							<div class="col-md-6">
								<h4 class="mb-3 text-sm"><i class="fa fa-user-group"></i> <b><?php echo str_replace($var1, $var2, lang($messages, $pagename, 'content', 'overview', 'users', 'title')); ?></b></h4>
							</div>
							<div class="col-md-6" align="right">
								<?php if (has('dbb.admin.group.*') OR has('dbb.admin.group.user.add')) { ?><a href="#" class="btn-a mb-3 text-sm start-add-user"><i class="fa fa-plus"></i></a><?php } ?>
								<a href="#" class="btn-a mb-3 text-sm hidden_user_list"><?php echo ($_COOKIE['hidden_user_list']) ? '<i class="fa fa-chevron-up"></i>' : '<i class="fa fa-chevron-down"></i>'; ?></a>
							</div>
						</div>
						<div class="users_in_list" <?php echo ($_COOKIE['hidden_user_list']) ? 'style="display: none;"' : ''; ?>>
							<div class="mb-3">
								<input type="text" class="form-control" name="searchs" id="searchs" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>">
								<input type="hidden" value="group_user" id="tabPages">
								<input type="hidden" value="1" id="paginationIDs">
								<input type="hidden" value="id#DESC" id="options">
								<select class="form-control w-20" id="totals" hidden>
									<option value="10" selected>10</option>
								</select>
							</div>
							<div class="mb-3" id="load_user_list"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'group_permission';
	groupPermissionCall();
	window.activeTab = 'group_user';
	groupUserCall();
});
</script>
<?php
	} else {
?>

<div class="row d-flex align-items-center fadeIn mb-2">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
		<h1><b style="color: red;"><?php echo lang($messages, 'filters', 'unknown'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
		<a href="<?php echo URI; ?>/<?php echo $page[0]; ?>" class="change-page btn-a"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
	</div>
</div>

<?php
	}
}

?>