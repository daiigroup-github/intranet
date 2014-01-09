<?php
$this->breadcrumbs = array(
	'Document Template Fields'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List DocumentTemplateField',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create DocumentTemplateField',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('document-template-field-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Document Template Fields</h1>

<!-- <p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p> -->

<h2><?php echo $documentTypeModel->documentTypeName; ?></h2>
<?php print_r($documentTypeModel); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-template-field-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
	'columns'=>array(
		/* 'documentTemplateFieldId',
		  'documentTemplateFieldName',
		  'documentTemplateFieldType',
		  'active',
		  'createDateTime', */
		array(
			'name'=>'DocumentTemplateFieldName',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:right'),
			//'value' => 'CHtml::encode(number_format($data->advertiser_balance,2))',
			//'value' => 'CHtml::encode($data->documentTemplates->documentTemplateField->documentTemplateFieldName)',
			'value'=>'CHtml::encode($data->documentTypeName)',
		),
		/* array(
		  'name' => 'advertiser_balance',
		  'type' => 'raw',
		  'htmlOptions' =>array('style'=>'text-align:right'),
		  'value' => 'CHtml::encode(number_format($data->advertiser_balance,2))',

		  ), */
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
