<?php
$this->breadcrumb = '<li>พนักงาน<span class="divider">/</span></li>';
$this->pageHeader = 'จัดการเบอร์ต่อภายใน';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="search-form" style="display:inline">
	<?php
	$this->renderPartial('extensionSearch', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	// 'htmlOptions'=>array(
	// 'class'=>'span10 offset1',
	// ),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		array(
			'name' => 'fnTh',
			'value' => 'CHtml::encode($data->fnTh." ".$data->lnTh)',
		),
		'nickName',
		'position',
		array(
			'name' => 'ext',
			'value' => 'CHtml::encode($data->ext)',
			'filter' => false,
		),
		array(
			'class' => 'CButtonColumn',
			'header' => 'Action',
			'template' => '{แก้ไขเบอร์ต่อ}',
			'buttons' => array(
				'แก้ไขเบอร์ต่อ' => array(
					'url' => 'Yii::app()->createUrl("employee/ExtensionUpdate", array("id"=>$data->employeeId))',
				),
			),
			'htmlOptions' => array(
				'style' => 'width:120px;text-align:center;',
			),
		),
	),
));
?>
	