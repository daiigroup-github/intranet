<?php
$this->breadcrumbs = array(
	'Projects' => array(
		'index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('project-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Projects</h1>
<div class="btn-toolbar">
	<div class="btn-group">
		<!-- <a class="btn search-button pull-right"><i class="icon-search"></i></a> -->
		<a class="btn" href="<?php echo Yii::app()->createUrl('/project/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
		<!--<a class="btn" href="<?php echo Yii::app()->createUrl('/project/ExportExcel/'); ?>"></i>Export Excel</a> -->
	</div>
</div>	
<div class="search-form" style="display:inline">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'project-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'projectName',
		array(
			'name' => 'customerId',
			'value' => 'isset($data->customer)?CHtml::encode($data->customer->customerFnTh." ".$data->customer->customerLnTh):"-"',
		),
		'status',
		//'createDateTime',
		//'productCatId',
		//'productValue',

		/*
		  'projectDetail',
		  'projectPrice',
		  'projectImageName',
		  'projectAddress',
		  'customerId',
		  'engineerId',
		  'saleId',
		  'startDate',
		  'endDate',
		  'latitude',
		  'longitude',
		  'branchValue',
		 */
		array(
			'header' => '',
			'class' => 'CButtonColumn',
			'template' => '{view}',
		/* 'buttons'=>array(
		  'สร้าง' => array(
		  'title'=>'Field',
		  'url'=>'$this->grid->controller->createUrl("Create", array("documentTypeId"=>$data->documentTypeId))',
		  //'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
		  //'visible'=>"checkVisible('Advertiser.VerifyBalance')",
		  ), */
		),
	),
));
?>
