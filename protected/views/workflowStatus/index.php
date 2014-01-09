<?php
$this->breadcrumb = '<li>Workflow Status<span class="divider">/</span></li>';
$this->pageHeader = 'Workflows Status';

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
<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/workflowStatus/Create'); ?>"><i class="icon-plus"></i></a>
	</div>
</div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'workflow-status-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		'workflowStatusId',
		'workflowStatusName',
		'workflowStatusGroup',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
