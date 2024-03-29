<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
$this->params['pageHeader'] = '<i class="fa fa-dashboard page-header-icon"></i>&nbsp;&nbsp;Dashboard';
$this->params['breadcrumbs'][] = 'Dashboard'
?>
<script>
    init.push(function () {
        // Easy Pie Charts
        var easyPieChartDefaults = {
            animate: 2000,
            scaleColor: false,
            lineWidth: 6,
            lineCap: 'square',
            size: 200,
            trackColor: '#e5e5e5'
        }
        $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
            barColor: 'red'//PixelAdmin.settings.consts.COLORS[1]
        }));
        $('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
            barColor: PixelAdmin.settings.consts.COLORS[1]
        }));
        $('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
            barColor: PixelAdmin.settings.consts.COLORS[1]
        }));
    });
</script>

<div class="row">
					<div class="col-xs-4">
						<!-- Centered text -->
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
									<i class="fa fa-globe"></i>&nbsp;&nbsp;BANDWIDTH
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
									<div class="pie-chart" data-percent="43" id="easy-pie-chart-1">
										<div class="pie-chart-label">12.3TB</div>
									</div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
					<div class="col-xs-4">
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
									<i class="fa fa-flash"></i>&nbsp;&nbsp;PICK LOAD
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
									<div class="pie-chart" data-percent="93" id="easy-pie-chart-2">
										<div class="pie-chart-label">93%</div>
									</div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
					<div class="col-xs-4">
						<div class="stat-panel text-center">
							<div class="stat-row">
								<!-- Dark gray background, small padding, extra small text, semibold text -->
								<div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
									<i class="fa fa-cloud"></i>&nbsp;&nbsp;USED RAM
								</div>
							</div> <!-- /.stat-row -->
							<div class="stat-row">
								<!-- Bordered, without top border, without horizontal padding -->
								<div class="stat-cell bordered no-border-t no-padding-hr">
									<div class="pie-chart" data-percent="75" id="easy-pie-chart-3">
										<div class="pie-chart-label">12GB</div>
									</div>
								</div>
							</div> <!-- /.stat-row -->
						</div> <!-- /.stat-panel -->
					</div>
				</div>
			</div>

<?php
$this->registerJs("
");
?>