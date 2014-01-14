<?php
$this->breadcrumb = '<li>' . CHtml::link('เอกสาร', Yii::app()->createUrl('/document')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'สร้างเอกสาร';

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
<p class="alert-danger">***กรุณาเลือกเอกสารที่ต้องการสร้าง โดยคลิ๊กที่ &nbsp; <span style="color:blue;display:inline">"สร้าง"</span> &nbsp; โดยเอกสารด้านล่างจะแบ่งเป็นเอกสารของแต่ละฝ่าย***</p>


<div class="btn-toolbar">
	<div class="btn-group">
		<!-- <a class="btn search-button"><i class="icon-search"></i></a> -->

	</div>
</div>	
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('documentTypeSearch', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$companyDivisions = CompanyDivision::model()->getAllCompanyDivision();
foreach ($companyDivisions as $k => $v)
{
	if (!empty($k))
	{
		if ($model->searchForCreateDocument(Yii::app()->user->id, $k)->itemCount)
		{
			echo "<h3>$v</h3>";
			$this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'document-type-grid' . $k,
				'dataProvider' => $model->searchForCreateDocument(Yii::app()->user->id, $k),
				//'filter'=>$model,
				'itemsCssClass' => 'table table-striped table-bordered table-condensed',
				'columns' => array(
					//'documentTypeId',
					'documentTypeName',
					array(
						'header' => '',
						'class' => 'CButtonColumn',
						'template' => '{สร้าง}',
						'buttons' => array(
							'สร้าง' => array(
								'title' => 'Field',
								'url' => '$this->grid->controller->createUrl((!$data->customAction) ? "create" : $data->customAction, array("documentTypeId"=>$data->documentTypeId))',
							//'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
							//'visible'=>"checkVisible('Advertiser.VerifyBalance')",
							),
						),
					),
				),
			));
		}
	}
	else
	{
		if ($model->searchForCreateDocument(Yii::app()->user->id, null)->itemCount)
		{
			echo "<h2>เอกสารอื่นๆ</h2>";
			$this->widget('zii.widgets.grid.CGridView', array(
				'id' => 'document-type-grid' . $k,
				'dataProvider' => $model->searchForCreateDocument(Yii::app()->user->id, null),
				//'filter'=>$model,
				'itemsCssClass' => 'table table-striped table-bordered table-condensed',
				'columns' => array(
					//'documentTypeId',
					'documentTypeName',
					array(
						'header' => '',
						'class' => 'CButtonColumn',
						'template' => '{สร้าง}',
						'buttons' => array(
							'สร้าง' => array(
								'title' => 'Field',
								'url' => '$this->grid->controller->createUrl((!$data->customAction) ? "create" : $data->customAction, array("documentTypeId"=>$data->documentTypeId))',
							//'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
							//'visible'=>"checkVisible('Advertiser.VerifyBalance')",
							),
						),
					),
				),
			));
		}
	}
}
?>