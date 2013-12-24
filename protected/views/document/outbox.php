<?php
$this->breadcrumb = '<li>' . CHtml::link('เอกสาร', Yii::app()->createUrl('/document')) . '<span class="divider">/</span></li>
					<li>เอกสารถาดออก</li>';
$this->pageHeader = 'เอกสารถาดออก';

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
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,));
	?>
</div><!-- search-form -->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'document-grid',
	'dataProvider' => $model->searchOutbox(Yii::app()->user->id),
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
		//'createDateTime',
		array(
			'name' => 'createDateTime',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:left;'),
			'value' => 'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		array(
			'name' => "status",
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:15%'),
			'value' => 'CHtml::encode(isset(Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName) ? Document::model()->findCurrentStatusByDocumentId($data->documentId)->currentStatus." (".Document::model()->findCurrentStatusByDocumentId($data->documentId)->statusName.") " : "แบบร่างเอกสาร")',
		),
		array(
			'name' => "waitProcess",
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:15%'),
			'value' => array(
				$this,
				'getWaitProcess'),
		),
		array(
			'header' => '',
			'class' => 'CButtonColumn',
			'template' => '{view} ',
			'buttons' => array(
				'view' => array(
					'url' => 'isset($data->documentType->customView) ? Yii::app()->createUrl("document/".$data->documentType->customView, array("id"=>$data->documentId)): Yii::app()->createUrl("document/$data->documentId")',),
			),
		),
	),
));
?>

