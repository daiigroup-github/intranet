<?php
$this->breadcrumb = '<li>Workflow Group<span class="divider">/</span></li>';
$this->pageHeader = 'Workflow Groups';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('workflow-group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/workflowGroup/create'); ?>"><i class="icon-plus"></i></a>
	</div>
</div>

<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'workflow-group-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		//'workflowGroupId',
		'workflowGroupName',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
