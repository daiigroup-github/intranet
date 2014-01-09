<?php
$this->breadcrumbs = array(
	'Employees',
);

$this->menu = array(
	array(
		'label'=>'List Employee',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Employee',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Employees</h1>

<?php
echo CHtml::link('Advanced Search', '#', array(
	'class'=>'search-button'));
?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'employeeId',
		array(
			'name'=>'fnTh',
			'value'=>'CHtml::encode($data->fnTh." ".$data->lnTh)',
		),
		array(
			'name'=>'position',
			'value'=>'CHtml::encode($data->position)',
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>'Action',
			'template'=>'{view}{update}{Mileage}',
			'buttons'=>array(
				'Mileage'=>array(
					'url'=>'Yii::app()->createUrl("employee/mileage", array("id"=>$data->employeeId))',
				),
			)
		),
	),
));
?>
