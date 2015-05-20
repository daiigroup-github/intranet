<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */

$this->breadcrumbs=array(
	'Fitfast Targets'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List FitfastTarget', 'url'=>array('index')),
array('label'=>'Create FitfastTarget', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#fitfast-target-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Fitfast Targets
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
			'id'=>'fitfast-target-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'fitfastTargetId',
				'status',
				'createDateTime',
				'updateDateTime',
				'employeeId',
				'fitfastId',
				/*
				'month',
				'target',
				'file',
				'grade',
				'parentId',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


