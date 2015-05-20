<?php
/* @var $this ManageController */
/* @var $model Fitfast */

$this->breadcrumbs = array(
    'Fitfasts' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Fitfast', 'url' => array('index')),
    array('label' => 'Create Fitfast', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#fitfast-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
$this->pageHeader = 'Manage Fit and Fast'
?>

<div class="row">
    <div class="span7">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div>
    <div class="span2">
        <?php echo CHtml::link('<i class="icon-download"></i> Import', $this->createUrl('import'), array('class' => 'btn btn-xs btn-success')); ?>
        <?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class' => 'btn btn-xs btn-primary pull-right')); ?>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'fitfast-grid',
    'dataProvider' => $model->search(),
//			'filter'=>$model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'columns' => array(
        array('class' => 'IndexColumn'),
//				'fitfastId',
//        'status',
//				'createDateTime',
//				'updateDateTime',
//				'fitfastEmployeeId',
        array(
            'name' => 'employeeId',
            'value' => '$data->employee->fnTh . " " . $data->employee->lnTh'
        ),
        'title',
//				'description',
        array(
            'name' => 'type',
            'value' => 'substr(ucfirst($data->fitfastTypeText), 0, 1)'
        ),
        'halfS',
        'S',
        'SS',
        'F',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
