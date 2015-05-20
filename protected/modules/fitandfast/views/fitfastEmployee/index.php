<?php
/* @var $this FitfastEmployeeController */
/* @var $model FitfastEmployee */

$this->breadcrumbs=array(
	'Fitfast Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List FitfastEmployee', 'url'=>array('index')),
array('label'=>'Create FitfastEmployee', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#fitfast-employee-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Fitfast Employees
		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
			</div>
		</div>
	</div>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'fitfast-employee-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'fitfastEmployeeId',
				'status',
				'createDateTime',
				'updateDateTime',
				'employeeId',
				'halfS',
				/*
				'S',
				'SS',
				'F',
				'forYear',
				'percent',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


