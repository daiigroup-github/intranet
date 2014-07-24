<style>
    .chart {
        position: relative;
        display: inline-block;
        width: 265px;
        height: 265px;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
    }

    .chart canvas {
        position: absolute;
        top: 0;
        left: 0;
    }

    .percent {
        display: inline-block;
        line-height: 265px;
        z-index: 2;
        font-size: 1.8em;
    }

    .percent:after {
        content: '%';
        margin-left: 0.1em;
        font-size: .8em;
    }
</style>
<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;

if ($summary['percent'] > 80) {
    $lineColor = '#00aa00';
} elseif ($summary['percent'] > 50) {
    $lineColor = '#ffee00';
} else {
    $lineColor = '#ff0000';
}

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/easypiechart/jquery.easypiechart.min.js');
$cs->registerScript('pie', "
$(function() {
    //create instance
    $('.chart').easyPieChart({
        animate: 2000,
		/*onStep: function(from, to, percent) {
			this.el.children[0].innerHTML = Math.round(percent);
		},*/
		size:265,
		barColor:'{$lineColor}',
		lineCap : 'butt',
		lineWidth: 48,
    });
});
");

$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6', CClientScript::POS_HEAD);
$this->pageHeader = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
?>

<div class="row-fluid">
    <div class="span3">
        <h3>Summary</h3>

        <div class="chart" data-percent="<?php echo $summary['percent']; ?>">
            <p class="percent"><?php echo $summary['percent']; ?></p>
        </div>
    </div>

    <div class="span9">
        <p class="alert alert-info">
            <i class="icon-upload-alt icon-2x"></i> คลิกเพื่อส่งงาน ไฟล์ PDF เท่านั้น!!
        </p>

        <?php foreach(Fitfast::model()->typeArray() as $type):?>

        <h3><?php echo strtoupper($type);?></h3>

        <div class="well well-small">
            <?php foreach ($fitfastEmployeeModel->{$type} as $performance): ?>
                <strong><?php echo $performance->title; ?></strong>
                <table class="table table-bordered table-striped table-hover"
                       style="font-size: 12px;">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ม.ค.</th>
                        <th>ก.พ.</th>
                        <th>มี.ค.</th>
                        <th>เม.ย.</th>
                        <th>พ.ค.</th>
                        <th>มิ.ย.</th>
                        <th>ก.ค.</th>
                        <th>ส.ค.</th>
                        <th>ก.ย.</th>
                        <th>ต.ค.</th>
                        <th>พ.ย.</th>
                        <th>ธ.ค.</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>เป้าหมาย</td>
                        <?php
                        $i = 1;
                        $lastMonth = 0;
                        foreach ($performance->fitfastTargets as $fitfastTarget) {
                            if ($i <= $fitfastTarget->month) {
                                for ($j = 1; $j <= $fitfastTarget->month - $i; $j++) {
                                    echo '<td></td>';
                                }
                            }

                            echo '<td>' . $fitfastTarget->target . '</td>';
                            $i += $j;
                            $lastMonth = $fitfastTarget->month;
                        }

                        if ($lastMonth != 12) {
                            while ($lastMonth < 12) {
                                echo '<td></td>';
                                $lastMonth++;
                            }
                        }
                        ?>
                    </tr>

                    <tr>
                        <td>ส่งงาน</td>
                        <?php
                        $i = 1;
                        $lastMonth = 0;
                        foreach ($performance->fitfastTargets as $fitfastTarget) {

                            if ($i <= $fitfastTarget->month) {
                                for ($j = 1; $j <= $fitfastTarget->month - $i; $j++) {
                                    echo '<td></td>';
                                }
                            }

                            echo '<td>';
                            //upload button
                            if(!empty($fitfastTarget->target) && empty($fitfastTarget->grade))
                            {
                                echo CHtml::link('<i class="icon-upload-alt"></i>', $this->createUrl($this->id . '/upload/' . $fitfastTarget->fitfastTargetId), array(
                                    'class' => 'btn btn-mini btn-primary'
                                )) . '<br />';
                            }

                            if (!empty($fitfastTarget->file)) {
                                echo CHtml::link('<i class="icon-file"></i> ' . $fitfastTarget->createDateTime, Yii::app()->baseUrl . '/' . $fitfastTarget->file, array(
                                    'class' => 'pdf'
                                ));
                            }

                            $i += $j;
                            $lastMonth = $fitfastTarget->month;
                        }

                        if ($lastMonth != 12) {
                            while ($lastMonth < 12) {
                                echo '<td></td>';
                                $lastMonth++;
                            }
                        }
                        ?>
                    </tr>

                    <tr>
                        <td>เกรด</td>
                        <?php
                        $i = 1;
                        $lastMonth = 0;
                        foreach ($performance->fitfastTargets as $fitfastTarget) {

                            if ($i <= $fitfastTarget->month) {
                                for ($j = 1; $j <= $fitfastTarget->month - $i; $j++) {
                                    echo '<td></td>';
                                }
                            }

                            echo '<td>';
                            if ($fitfastTarget->grade) {
                                $labelClass = '';
                                switch($fitfastTarget->grade){
                                    case FitfastTarget::GRADE_F:
                                        $labelClass = 'important';
                                        break;
                                    default:
                                        $labelClass = 'success';
                                }
                                echo '<span class="label label-'.$labelClass.'">'.FitfastTarget::model()->gradeText($fitfastTarget->grade).'</label>';
                            }
                            else{
                                echo '<span class="label label-warning">รออนุมัติ</span>';
                            }
                            echo '</td>';

                            $i += $j;
                            $lastMonth = $fitfastTarget->month;
                        }

                        if ($lastMonth != 12) {
                            while ($lastMonth < 12) {
                                echo '<td></td>';
                                $lastMonth++;
                            }
                        }
                        ?>
                    </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
        <?php endforeach;?>
    </div>
</div>
