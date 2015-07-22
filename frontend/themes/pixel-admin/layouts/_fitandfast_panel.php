<?php
$js = '';

$id = 'chart-id-' . uniqid();
$percent = $fitandfast['percent'];
$grades = isset($fitandfast['grades']) ? $fitandfast['grades'] : null;
$size = isset($fitandfast['size']) ? $fitandfast['size'] : 120;
?>
    <div class="stat-panel text-center">
        <div class="stat-row">
            <!-- Dark gray background, small padding, extra small text, semibold text -->
            <div class="stat-cell bg-dark-gray padding-sm text-xs text-semibold">
                <?php if(isset($fitandfast['url'])):?>
                    <p class="lead"><?= \yii\helpers\Html::a('<i class="fa fa-search"></i> '.$fitandfast['title'], $fitandfast['url']) ?></p>
                <?php else:?>
                <p class="lead"><?= $fitandfast['title'] ?></p>
                <?php endif;?>

                <?php if(isset($grades)):?>
                <label class="label label-success">SS:<?= $grades['SS'] ?></label>
                <label class="label label-primary">S:<?= $grades['S'] ?></label>
                <label class="label label-info">s:<?= $grades['s'] ?></label>
                <label class="label label-danger">F:<?= $grades['F'] ?></label>
                <?php endif;?>
            </div>
        </div>
        <!-- /.stat-row -->
        <div class="stat-row">
            <!-- Bordered, without top border, without horizontal padding -->
            <div class="stat-cell bordered no-border-t no-padding-hr">
                <div class="pie-chart" data-percent="<?= $percent ?>" id="<?= $id ?>">
                    <div class="pie-chart-label"><?= $percent ?></div>
                </div>
            </div>
        </div>
        <!-- /.stat-row -->
    </div> <!-- /.stat-panel -->

<?php
$barColor = '';
if (isset($fitandfast['barColor'])) {
    $barColor = $fitandfast['barColor'];
} else {
    if ($percent >= 80) {
        //dark green
        $barColor = 'PixelAdmin.settings.consts.COLORS[9]';
    } elseif ($percent >= 60 && $percent < 80) {
        //light green
        $barColor = 'PixelAdmin.settings.consts.COLORS[0]';
    } elseif ($percent >= 40 && $percent < 60) {
        //yellow
        $barColor = 'PixelAdmin.settings.consts.COLORS[4]';
    } else {
        //red
        $barColor = 'PixelAdmin.settings.consts.COLORS[2]';
    }
}

$js .= "$('#{$id}').easyPieChart($.extend({}, easyPieChartDefaults, {
                barColor: {$barColor},
                size : {$size}
            }));";
?>


<?php
$this->registerJs("
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
//        $('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
//            barColor: 'red'//PixelAdmin.settings.consts.COLORS[1]
//        }));

    {$js}
    });
");
?>