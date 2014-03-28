<?php
$this->breadcrumb = '<li>' . CHtml::link('Document Control Type', Yii::app()->createUrl('/documentControlType')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Create Document Control Type';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('document-control-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/DocumentControlType/Create'); ?>"><i class="icon-plus"></i></a>
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
	'id' => 'document-control-type-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'documentControlTypeId',
		'documentControlTypeName',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>
