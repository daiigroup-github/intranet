<?php
$this->breadcrumbs = array(
	'Employee Levels' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label' => 'List EmployeeLevel',
		'url' => array(
			'index')),
	array(
		'label' => 'Create EmployeeLevel',
		'url' => array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-level-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Employee Levels</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/employeeLevel/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
	</div>
</div>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-level-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns' => array(
		'level',
		'code',
		'description',
		'companyId',
		'divisionId',
		//'isManager',
		array(
			'name' => 'isManager',
			'type' => 'raw',
			'value' => 'CHtml::encode(($data->isManager == "1")?"Yes":"No")',
		),
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => 'CHtml::encode(($data->status == "1")?"ใช้งาน":"ไม่ใช้งาน")',
		),
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>
