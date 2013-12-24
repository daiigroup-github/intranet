<?php
$this->breadcrumbs = array(
	'Documents' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label' => 'List Document',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Document',
		'url' => array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('document-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>การจัดการ เอกสาร</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/document/index'); ?>"><i class="icon-plus"></i></a>
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
	'id' => 'document-grid',
	'dataProvider' => $model->searchAdmin(),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns' => array(
		array(
			'name' => 'documentTypeId',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:left;width:20%'),
			'value' => 'CHtml::encode(isset($data->documentType->documentTypeName) ? $data->documentType->documentTypeName : "-")',
		),
		'documentCode',
		array(
			'name' => 'creator',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:left;width:15%'),
			'value' => 'CHtml::encode(isset(Employee::model()->findByPk($data->employeeId)->employeeId) ? Employee::model()->findByPk($data->employeeId)->fnTh." ".Employee::model()->findByPk($data->employeeId)->lnTh : "Draft")',
		),
		array(
			'name' => 'createDateTime',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;'),
			'value' => 'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
//		array(
//				'name' => 'status',
//				'type' => 'raw',
//				'htmlOptions' =>array('style'=>'text-align:center;width:10%'),
//				'value' => 'CHtml::encode(isset($data->documentWorkflow->currentState) ? $data->documentWorkflow->workflowCurrent->workflowName : "None")',
//					
//		),
		array(
			'name' => 'status',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:15%'),
			'value' => 'CHtml::encode(isset(Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName) ? Document::model()->findCurrentStatusByDocumentId($data->documentId)->currentStatus." (".Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName.") " : "ดำเนินการแล้ว")',
		),
		array(
			'header' => '',
			'class' => 'CButtonColumn',
			'template' => '{view} ',
			'buttons' => array(
			/* 'Field' => array(
			  'title'=>'Field',
			  'url'=>'$this->grid->controller->createUrl("managefield", array("documentTypeId"=>$data->documentTypeId))', */
			//'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
			//'visible'=>"checkVisible('Advertiser.VerifyBalance')",
			//),			
			),
		),
	),
));
?>
