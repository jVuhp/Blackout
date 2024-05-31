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
$pagename = 'download';
$pageicon = 'download';
$position = '8';
$pageview = '1';
$permission = 'dbb.download';

if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
?>
	
<div class="row d-flex align-items-center mb-3">
	<div class="col-md-8">
		<h5 class="mb-0"><b class="text-primary"> <i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
		<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
	</div>
	<div class="col-md-4" align="right">
	</div>
</div>
<p></p>
<section class="card mb-3 fadeIn">
	<div class="card-body" id="download">
		<div class="row d-flex align-items-center mb-3">
			<div class="col-md-8">
				<input type="text" class="form-control w-50" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>" id="search">
				<input type="hidden" value="download" id="tabPage">
				<input type="hidden" value="1" id="paginationID">
				<input type="hidden" value="<?php echo ($_COOKIE['column_download_selected']) ? $_COOKIE['column_download_selected'] : 'id#DESC'; ?>" id="option">
					<input type="hidden" value="<?php echo ($_COOKIE['view_list_type']) ? $_COOKIE['view_list_type'] : 'user'; ?>" id="view_list_type">
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

<div class="mb-3 fadeIn package-page mb-3" id="packages-card-body">
	<div class="categories">
		<div class="category" id="download">
			<ul class="packages mb-0 collapse show ntp-packages" id="download_list">
				
			</ul>
		</div>
	</div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'download';
	downloadCall();
	downloadItemsCall();
});
</script>