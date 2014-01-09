<?php
$this->breadcrumb = '<li>' . CHtml::link('เอกสาร', Yii::app()->createUrl('/document')) . '<span class="divider">/</span></li>
					<li>เอกสารถาดเข้า</li>';
$this->pageHeader = 'เอกสารถาดเข้า';

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

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i>ค้นหา</a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/document/index'); ?>"><i class="icon-plus"></i>สร้างเอกสาร</a>
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
	'id'=>'document-grid',
	'dataProvider'=>$model->searchInbox(Yii::app()->user->id),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		array(
			'name'=>'documentTypeId',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:20%'),
			'value'=>'CHtml::encode(isset($data->documentType->documentTypeName) ? $data->documentType->documentTypeName : "-")',
		),
		'documentCode',
		array(
			'name'=>'creator',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:15%'),
			'value'=>'CHtml::encode(isset(Employee::model()->findByPk($data->employeeId)->employeeId) ? Employee::model()->findByPk($data->employeeId)->fnTh." ".Employee::model()->findByPk($data->employeeId)->lnTh : "Draft")',
		),
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		//'createDateTime',
		array(
			'name'=>'status',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:15%'),
			'value'=>'CHtml::encode(isset(Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName) ? Document::model()->findCurrentStatusByDocumentId($data->documentId)->currentStatus." (".Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName.") " : "แบบร่างเอกสาร")',
		),
		array(
			'header'=>'',
			'class'=>'CButtonColumn',
			'template'=>'{view} ',
			'buttons'=>array(
				'view'=>array(
					'url'=>'isset($data->documentType->customView) ? Yii::app()->createUrl("document/".$data->documentType->customView, array("id"=>$data->documentId)): Yii::app()->createUrl("document/$data->documentId")',
				),
			),
		),
	),
));
?>
