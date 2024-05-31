<?php
/*
===========================================================================

	Powered by: DevByBit
	Site: devbybit.com
	Date: 2/21/2024 12:59 AM
	Author: Vuhp
	Documentation: docs.devbybit.com

===========================================================================
*/
$pagename = 'user';
$pageicon = 'user';
$position = '5';
$pageview = '1';
$permission = 'dbb.admin.user';

if (!has('dbb.admin.user')) {
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
		<div class="col-md-4" align="right"></div>
	</div>
	<p></p>
	<section class="card fadeIn">
		<div class="card-body" id="user">
			<div class="row d-flex align-items-center mb-3">
				<div class="col-md-8">
					<input type="text" class="form-control w-50" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>" id="search">
					<input type="hidden" value="user" id="tabPage">
					<input type="hidden" value="1" id="paginationID">
					<input type="hidden" value="<?php echo ($_COOKIE['column_user_selected']) ? $_COOKIE['column_user_selected'] : 'id#DESC'; ?>" id="option">
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
	window.activeTab = 'user';
	userCall();
});
</script>
<?php 
} else {

	if ($page[2] == 'edit') {
		if (!has('dbb.admin.user.edit')) {
			hasNo();
		}
?>
	<div class="row d-flex align-items-center mb-3">
		<div class="col-md-8">
			<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'edit', 'title'); ?></b></h5>
			<h1><b><?php echo str_replace('{user:name}', userDev('username', $page[1]), lang($messages, $pagename, 'edit', 'subtitle')); ?></b></h1>
		</div>
		<div class="col-md-4" align="right">
			<?php if (has('dbb.admin.user.edit')) { ?>
			<a href="#" id="save_edit_account" class="btn-a"><?php echo lang($messages, $pagename, 'edit', 'buttons', 'save'); ?></a>
			<?php } ?>
		</div>
	</div>
	<p></p>

<form id="edit_account" method="POST" class="row fadeIn">
	<input type="hidden" name="userid" value="<?php echo $page[1]; ?>">
	<input type="hidden" name="result" value="edit_account">
	<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="mb-2">
					<label for="user_name"><?php echo lang($messages, $pagename, 'edit', 'username'); ?></label>
					<input type="text" class="form-control" placeholder="New Username" id="user_name" name="user_name">
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="mb-2">
					<label for="password"><?php echo lang($messages, $pagename, 'edit', 'update_password'); ?></label>
					<input type="password" class="form-control" placeholder="New Password" id="password" name="password">
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12 mb-3">
		<div class="card">
			<div class="card-body">
				<div class="mb-2">
					<label for="email_new"><?php echo lang($messages, $pagename, 'edit', 'change_email'); ?></label>
					<input type="email" class="form-control" placeholder="example@mail.com" id="email_new" name="email_new">
				</div>
			</div>
		</div>
	</div>
</form>
<?php
	} else {
?>

<div class="card fadeIn mb-2">
	<div class="card-body">
		<div class="media align-items-center">
            <a href="#" class="mr-3">
                <img alt="<?php echo userDev('username', $page[1]); ?>" style="width: 128px; border-radius: 15px !important;" src="<?php echo userDev('avatar', $page[1]); ?>">
            </a>
            <div class="media-body">
				<div class="row d-flex align-items-start">
					<div class="col-md-8 col-sm-12 mb-3">
						<h2 class="mb-2 text-sm"><b><?php echo userDev('username', $page[1]); ?></b> </h2>
						
						<a href="<?php echo URI . '/' . $page[0] . '/' . $page[1] . '/edit'; ?>" class="btn-a" style="text-decoration: none; margin-bottom: 5px;"><?php echo lang($messages, $pagename, 'content', 'buttons', 'edit'); ?></a>
						<a href="<?php echo URI . '/' . $page[0]; ?>" class="btn-a" style="text-decoration: none; margin-bottom: 5px;"><?php echo lang($messages, $pagename, 'content', 'buttons', 'back'); ?></a>
					</div>
					<div class="col-md-4 col-sm-12 mb-3" align="right">
					</div>
				</div>
            </div>
        </div>
	</div>
</div>

<?php if (!empty(BOT_TOKEN) AND !empty(GUILD_ID)) { ?>
<section class="card fadeIn mb-2">
	<div class="card-body">
		<div class="row d-flex align-items-center">
			<?php if (userMemberOnGuild($page[1], GUILD_ID, BOT_TOKEN)) { ?>
			<div class="col-12 d-inline-block ml-3 text-success">
				<h3><i class="fa fa-circle-check"></i> <?php echo lang($messages, $pagename, 'content', 'discord', 'on_server'); ?></h3>
			</div>
			<?php } else { ?>
			<div class="col-12 d-inline-block ml-3 text-danger">
				<h3><i class="fa fa-warning"></i> <?php echo lang($messages, $pagename, 'content', 'discord', 'not_on_server'); ?></h3>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>

<div class="row d-flex align-items-start mb-2 fadeIn">
	<div class="col-md-4 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'member_since'); ?></b></h4>
						<h6 class="text-muted"><?php echo countSince(userDev('since', $page[1])); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-4 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'sync_id', 'label'); ?></b> <a href="<?php echo URI;?>/license/create/<?php echo userDev('udid', $page[1]); ?>" class="btn-a" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'sync_id', 'tooltip'); ?>"><i class="fa fa-plus"></i></a></h4>
						<h6 class="text-muted"><?php echo (empty(userDev('udid', $page[1]))) ? 'Unknown' : userDev('udid', $page[1]); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-4 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'devices', 'label'); ?></b> <a href="#" class="btn-a clear_all_devices" data-id="<?php echo $page[1]; ?>" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'devices', 'tooltip'); ?>"><i class="fa fa-arrow-right-from-bracket"></i></a></h4>
						<h6 class="text-muted"><?php echo hasDevices($page[1]); ?> <?php echo hasStatus('<span class="text-success" style="font-size: 16px;">Online</span>', '<span class="text-danger" style="font-size: 16px;">Offline</span>', $page[1]); ?></h6>
					</div>
				</div>
				
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'request', 'label'); ?></b> <a href="#" class="btn-a clear_all_request" data-id="<?php echo $page[1]; ?>" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang($messages, $pagename, 'content', 'card', 'request', 'tooltip'); ?>"><i class="fa-regular fa-circle-xmark"></i></a></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountRequest('dbb_logs', 'request', $page[1]),0,".",","); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'keys'); ?></b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCount('dbb_license', 'client', userDev('udid', $page[1])),0,".",","); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'groups'); ?></b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCount('dbb_group_user', 'user', $page[1]),0,".",","); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b><?php echo lang($messages, $pagename, 'content', 'card', 'claims'); ?></b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCount('dbb_code', 'use', $page[1]),0,".",","); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="row d-flex align-items-start mb-2 fadeIn">
	<div class="col-md-12 col-sm-12">
		<section class="card"><div class="card-body"><div id="request-chart"></div></div></section>
	</div>
</div>
	
<div class="fadeIn mb-2">
		<div class="row d-flex align-items-start">
			<div class="col-md-6 col-sm-12 mb-3">
				<section class="card">
					<div class="card-body">
						<div class="media align-items-center">
							<div class="media-body">
								<div class="row d-flex align-items-center">
									<div class="col-md-6">
										<h4 class="mb-3 text-sm"><i class="fa fa-location-dot"></i> <b><?php echo lang($messages, $pagename, 'content', 'card', 'ip_history'); ?></b></h4>
									</div>
									<div class="col-md-6" align="right"></div>
								</div>
								<div class="permission_in_list" <?php echo ($_COOKIE['hidden_permission_list']) ? 'style="display: none;"' : ''; ?>>
									<div class="mb-3">
										<input type="text" class="form-control" name="search" id="search" placeholder="<?php echo lang($messages, 'filters', 'search'); ?>">
										<input type="hidden" value="<?php echo $page[1]; ?>" id="userId">
										<input type="hidden" value="1" id="paginationID">
										<input type="hidden" value="id#DESC" id="option">
										<select class="form-control w-20" id="total" hidden>
											<option value="10" selected>10</option>
										</select>
									</div>
									<div class="mb-3" id="load_ip_history_list"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-6 col-sm-12 mb-3">

				<div class="card">
					<div class="card-body">
					<div class="row d-flex align-items-start mb-2">
						<div class="col-md-6">
							<h4>Groups</h4>
						</div>
						<div class="col-md-6" align="right">
							<a href="#" class="btn-a" onclick="updateGroups(this);" data-id="<?php echo $page[1]; ?>"><i class="fa fa-sliders"></i></a>
						</div>
					</div>
						<div class="package-page" id="packages-card-body">
							<div class="categories">
								<div class="category" id="user_group_list">
									<ul class="packages mb-0 collapse show ntp-packages fadeIn" id="user_groups_list">
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	window.activeTab = 'ip_history';
	userHistoryCall();
});
$(document).ready(function() {
	viewListOfUser('<?php echo $page[1]; ?>');
});


$(document).ready(function() {
    function updateChart() {
        $.ajax({
            type: "POST",
            url: site_domain + "/execute/action.php",
            data: { result: 'chart_license_accepted_by_user', chartValue: '<?php echo $page[1]; ?>' },
            dataType: "json",
            success: function(response) {
                chart.updateSeries([
                    { name: 'Denied', data: response.deniedData },
                    { name: 'Accepted', data: response.acceptedData }
                ]);
            },
            error: function(error) {
                console.error("Error: ", error);
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
<?php
	}
}

?>

<div class="modal fade" id="groupListAdd" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
			<h1 class="modal-title fs-5 mb-0" id="staticBackdropLabel"><i class="text-primary fa fa-layer-group"></i> <?php echo lang($messages, $pagename, 'content', 'modal'); ?></h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-dialog-scrollable">
			<div class="package-page" id="packages-card-body">
				<div class="categories">
					<div class="category" id="group_list">
						<ul class="packages mb-0 collapse show ntp-packages group_list_user" id="groups_list">
							
						</ul>
					</div>
				</div>
			</div>
        </div>
    </div>
  </div>
</div>