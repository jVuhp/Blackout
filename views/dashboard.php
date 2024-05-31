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
$pagename = 'dashboard';
$pageicon = 'dashboard';
$position = '1';
$pageview = '1';
$permission = 'dbb.dashboard';

if (!has('dbb.dashboard')) hasNo();

if (TOKEN_STATUS) { if (!sessions($_COOKIE['dbb_token'])) echo '<script>location.href="' . URI . '/auth";</script>'; }
?>

	<div class="row d-flex align-items-center mb-3">
		<div class="col-md-8">
			<h5 class="mb-0"><b class="text-primary"><i class="ti ti-<?php echo lang($messages, $pagename, 'header', 'icon'); ?>"></i> <?php echo lang($messages, $pagename, 'content', 'title'); ?></b></h5>
			<h1><b><?php echo lang($messages, $pagename, 'content', 'subtitle'); ?></b></h1>
		</div>
		<div class="col-md-4" align="right"> 
		</div>
	</div>
	<p></p>
<div class="row d-flex align-items-start mb-2 fadeIn">
	<div class="col-md-6 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-users-group"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b>Members</b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountL('dbb_user'),0,",","."); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-6 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-browser"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><b>Tokens Devices</b> <a href="#" class="btn-a" style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="Close all sessions!"><i class="fa-regular fa-circle-xmark"></i></a></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountL('dbb_token'),0,",","."); ?></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-swipe"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo number_format(hasCountRequest('dbb_logs', 'request'),0,",","."); ?> <b>Requests</b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountL('dbb_logs'),0,",","."); ?> <b>Logs</b></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-<?php echo lang($messages, 'product', 'header', 'icon'); ?>"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo number_format(hasCountL('dbb_license'),0,",","."); ?> <b>Keys</b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountL('dbb_product'),0,",","."); ?> <b>Products</b></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-<?php echo lang($messages, 'group', 'header', 'icon'); ?>"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo number_format(hasCountL('dbb_group'),0,",","."); ?> <b>Groups</b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountL('dbb_group_user'),0,",","."); ?> <b>Groups in Users</b></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-3 col-sm-6 mb-2">
		<section class="card">
			<div class="card-body">
				<div class="media align-items-center">
					<h5 class="icon-blue-suave-text" style="width: 48px !important; height: 48px !important; padding: 3px; border-radius: 5px;"><i class="ti ti-<?php echo lang($messages, 'code', 'header', 'icon'); ?>"></i></h5>
					<div class="media-body">
						<h4 class="mb-0 text-sm"><?php echo number_format(hasCountL('dbb_code'),0,",","."); ?> <b>Codes</b></h4>
						<h6 class="text-muted"><?php echo number_format(hasCountS('dbb_code', 'use', 'NULL'),0,",","."); ?> <b>Codes Used</b></h6>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="row d-flex align-items-center fadeIn">
	<div class="col-md-6 col-sm-12 mb-3">
		<section class="card">
			<div class="card-body">
				<div id="request-chart"></div>
			</div>
		</section>
	</div>
	<div class="col-md-6 col-sm-12 mb-3">
		<section class="card">
			<div class="card-body">
				<div id="activity-chart"></div>
			</div>
		</section>
	</div>
</div>

<script>
$(document).ready(function() {
    function updateChart() {
        $.ajax({
            type: "POST",
            url: site_domain + "/execute/action.php",
            data: { result: 'chart_license_admin' },
            dataType: "json",
            success: function(response) {
				var newData = [
					{ name: 'Denied', data: Object.values(response.deniedData) },
					{ name: 'Accepted', data: Object.values(response.acceptedData) }
				];
				chart.updateSeries(newData);
            },
            error: function(error) {
                console.error("Error al obtener datos del servidor:", error);
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
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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

    function updateChartPuchases() {
        $.ajax({
            type: "POST",
            url: site_domain + "/execute/action.php",
            data: { result: 'puchases_chart_admin' },
            dataType: "json",
            success: function(response) {
				var newData = [
					{ name: 'Puchased', data: Object.values(response.puchases) },
					{ name: 'Declined', data: Object.values(response.declined) },
					{ name: 'In Basket', data: Object.values(response.inbasket) }
				];
				chart_puchase.updateSeries(newData);
            },
            error: function(error) {
                console.error("Error al obtener datos del servidor:", error);
            }
        });
    }

    var options_puchase = {
        colors: ['#8fff69', '#c33737', '#c08484'],
        series: [{
            name: 'Puchased',
            data: []
        }, {
            name: 'Declined',
            data: []
        }, {
            name: 'In Basket',
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
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
                    return val;
                }
            }
        },
        theme: {
            mode: document.documentElement.getAttribute('data-bs-theme')
        }
    };

    var chart_puchase = new ApexCharts(document.querySelector("#activity-chart"), options_puchase);
    chart_puchase.render();

    updateChartPuchases();

    setInterval(updateChartPuchases, 60000);
});

</script>