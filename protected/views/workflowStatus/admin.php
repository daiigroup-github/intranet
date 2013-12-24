<?php
$this->breadcrumbs = array(
	'Workflow Statuses' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label' => 'List WorkflowStatus',
		'url' => array(
			'index')),
	array(
		'label' => 'Create WorkflowStatus',
		'url' => array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('workflow-status-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Workflow Statuses</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/workflowstatus/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
	</div>
</div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'workflow-status-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	'columns' => array(
		'workflowStatusId',
		'workflowStatusName',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>
