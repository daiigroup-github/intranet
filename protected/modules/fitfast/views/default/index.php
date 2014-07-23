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
} else if ($summary['percent'] > 50) {
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
$this->pageHeader = $employeeName;
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
            <i class="icon-upload-alt icon-2x"></i> คลิกเพื่อส่งงาน
        </p>

        <?php $i = 0; ?>
        <?php foreach ($data as $t => $v): ?>
            <div class="well well-small">
                <h3><?php echo ($t == 1) ? 'Performance' : 'Implement'; ?></h3>

                <?php foreach ($v as $faf): ?>
                    <strong><?php echo $faf['title']; ?></strong>
                    <table class="table table-bordered table-striped table-hover" style="font-size:12px;">
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
                            <?php foreach (FitAndFast::model()->targetArray as $target): ?>
                                <td>
                                    <?php echo $faf[$target]; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td>ส่งงาน</td>
                            <?php foreach (FitAndFast::model()->actualArray as $k => $actual): ?>
                                <td>
                                    <?php
                                    if (empty($faf[FitAndFast::model()->gradeArray[$k]]) && !empty($faf[FitAndFast::model()->targetArray[$k]]) && $isUpload) {
                                        echo CHtml::link('<i class="icon-upload-alt"></i>', $this->createUrl($this->id . '/upload/' . $faf['fitAndFastId'] . '/' . FitAndFast::model()->fileArray[$k]), array(
                                            'class' => ''));
                                    }
                                    //										else
                                    //										{
                                    //											if($faf[FitAndFast::model()->fileArray[$k]])
                                    //											{
                                    //												echo CHtml::link('<i class="icon-file"></i><br />' . $faf[FitAndFast::model()->fileArray[$k] . 'DateTime'], Yii::app()->baseUrl . '/' . $faf[FitAndFast::model()->fileArray[$k]], array(
                                    //													'class'=>'pdf'));
                                    //											}
                                    //										}

                                    if (empty($faf[FitAndFast::model()->gradeArray[$k]]) && $faf[FitAndFast::model()->fileArray[$k]])
                                        echo '<br />';

                                    if ($faf[FitAndFast::model()->fileArray[$k]]) {
                                        echo CHtml::link('<i class="icon-file"></i> ' . $faf[FitAndFast::model()->fileArray[$k] . 'DateTime'], Yii::app()->baseUrl . '/' . $faf[FitAndFast::model()->fileArray[$k]], array(
                                            'class' => 'pdf'));
                                    }
                                    ?>

                                    <span id="<?php echo $actual . $i; ?>"><?php echo $faf[$actual]; ?></span>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php
                        /*
                         * Grade
                         */
                        ?>
                        <tr>
                            <td>เกรด</td>
                            <?php foreach (FitAndFast::model()->gradeArray as $l => $grade): ?>
                                <td>
                                    <?php
                                    /*
                                      if(!$flag)
                                      {
                                      if(empty($faf[$grade]) || in_array(Yii::app()->user->getState('username'), array(
                                      'kbw',
                                      'npr'
                                      )))
                                      {
                                      $this->renderPartial('_updateGrade', array(
                                      'grade'=>$faf[$grade],
                                      'sBtnId'=>'s' . ucfirst($grade) . $i,
                                      'fBtnId'=>'f' . ucfirst($grade) . $i,
                                      'fitAndFastId'=>$faf['fitAndFastId'],
                                      'field'=>$grade
                                      ));
                                      }
                                      else
                                      {
                                      if($faf[$grade] == 'S')
                                      echo '<span class="label label-success">S</span>';
                                      else
                                      echo '<span class="label label-important">F</span>';
                                      }
                                      }
                                      else
                                      {
                                      if(!empty($faf[$grade]))
                                      {
                                      if($faf[$grade] == 'S')
                                      echo '<span class="label label-success">S</span>';
                                      else
                                      echo '<span class="label label-important">F</span>';
                                      }
                                      }
                                     */

                                    /**
                                     * Employee
                                     * 1 only manager can update grade
                                     * 2 only kbw can edit grade
                                     *
                                     * Manag3er
                                     * 1 only nsy can update grade
                                     * 2 only kbw can edit grade
                                     */
                                    if (!empty($faf[$grade])) {
                                        if (in_array(Yii::app()->user->name, $this->editGradeUsersArray)) {
                                            $editView = ($t == 1) ? '_editPerformanceGrade' : '_editImplementGrade';
                                            $this->renderPartial($editView, array(
                                                'grade' => $faf[$grade],
                                                'fitAndFastId' => $faf['fitAndFastId'],
                                                'field' => $grade,
                                                'type' => $t,
                                                'btnId' => ucfirst($grade) . $i,
                                            ));
                                        } else {
                                            if ($faf[$grade] == 'F')
                                                echo '<span class="label label-important">F</span>';
                                            else
                                                echo '<span class="label label-success">' . $faf[$grade] . '</span>';
                                        }
                                    } else {
                                        if ($faf[FitAndFast::model()->statusFitAndFastArray[$l]] == FitAndFast::STATUS_UPLOADED) {
                                            if (in_array(Yii::app()->user->name, $this->editGradeUsersArray)) {
                                                if (!empty($faf[FitAndFast::model()->fileArray[$l]]) && !empty($faf[FitAndFast::model()->targetArray[$l]])) {
                                                    $this->renderPartial('_updateGrade', array(
                                                        'grade' => $faf[$grade],
                                                        'fitAndFastId' => $faf['fitAndFastId'],
                                                        'field' => $grade,
                                                        'type' => $t,
                                                        'btnId' => ucfirst($grade) . $i,
                                                    ));
                                                }
                                            } else {
                                                echo '<span class="label label-warning">รออนุมัติ</span>';
                                            }
                                        }
                                    }

                                    //echo (!empty($faf[$grade . 'DateTime'])) ? '<br />' . $faf[$grade . 'DateTime'] : '';
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php $i++; ?>

                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
