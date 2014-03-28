<?php
$this->pageHeader = 'การจัดการประเภทเอกสาร';
$this->breadcrumb = '<li>' . CHtml::link('การจัดการประเภทเอกสาร', Yii::app()->createUrl('/documentType')) . '<span class="divider">/</span></li>';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('document-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/documentType/Create'); ?>"><i class="icon-plus"></i></a>
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
	'id' => 'document-type-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		//'documentTypeId',
		'documentTypeName',
		array(
			'name' => 'status',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:10%'),
			'value' => 'CHtml::encode($data->status==1 ? "Active":"In Active")',
		),
		array(
			'name' => 'workflowGroupId',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:10%'),
			'value' => 'CHtml::encode($data->workflowGroupId)',
		),
		array(
			'header' => 'Actions',
			'class' => 'CButtonColumn',
			'template' => '{update} {delete}   ',
			'buttons' => array(
			),
		),
	),
));
?>
