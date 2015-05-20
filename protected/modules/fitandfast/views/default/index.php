<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);

$this->pageHeader = 'Fit and Fast'
?>

<div class="row">
    <div class="span3">
        <div id="fitfastChart" class="affix">
            <h3><?php echo $fitfastEmployeeModel->employee->fnTh . ' '. $fitfastEmployeeModel->employee->lnTh;?></h3>
            <?php
            $this->renderPartial('fitandfast.views.report._chart', array(
                'percent' => $fitfastEmployeeModel->percent,
                'grades' => $fitfastEmployeeModel->countGrade(),
                'id' => $fitfastEmployeeModel->employeeId,
                'span' => 3
            ));
            ?>
        </div>
    </div>
    <div class="span6">
        <?php foreach ($fitfastModels as $fitfastModel): ?>
            <h3><?php echo $fitfastModel->title; ?></h3>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'fitfast-employee-grid',
                'dataProvider' => new CArrayDataProvider($fitfastModel->fitfastTargets, array(
                    'keyField' => 'fitfastTargetId',
                    'pagination' => array(
                        'pageSize' => 12,
                    ),
                )),
                //'filter' => $model,
                'itemsCssClass' => 'table table-striped table-bordered table-hover',
                'columns' => array(
//                array('class' => 'IndexColumn'),
                    array(
                        'name' => 'moth',
                        'value' => '$data->getMonthThaiText($data->month)'
                    ),
                    'target',
                    array(
                        'name'=>'file',
                        'type'=>'raw',
                        'value'=>'($data->file) ? "<a class=\"pdf\" href=\"".Yii::app()->baseUrl.$data->file."\">view file</a>" : "-"'
                    ),
                    array(
                        'name' => 'grade',
                        'type' => 'raw',
                        'value' => '($data->grade) ? "<span id=grade{$data->fitfastTargetId}>".$data->gradeText($data->grade)."</span>" : "<span id=grade{$data->fitfastTargetId}>0</span>"',
                    ),
                    array(
                        'class' => 'CButtonColumn',
                        'htmlOptions' => array(
                            'style' => 'width:150px;'
                        ),
                        'template' => '{upload}',
//            'template' => '{s} {S} {SS} {F} {cancel} {update} {delete}',
                        'buttons' => array(
                            'upload' => array(
                                'visible' => '($data->grade) ? false : true',
                                'url' => 'Yii::app()->createUrl("fitandfast/fitfastTarget/upload/id/".$data->fitfastTargetId)'
                            ),
                        ),
                    ),
                ),
            )); ?>

        <?php endforeach; ?>
    </div>
</div>

<?php
//fancy box
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js', CClientScript::POS_END);
//$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0', CClientScript::POS_END);
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>
