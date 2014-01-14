<?php
$this->breadcrumb = '<li>พนักงาน<span class="divider">/</span></li>';
$this->pageHeader = 'พนักงาน';

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
	$this->renderPartial('_searchForm', array(
		'leaveModel' => $leaveModel,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $dataProvider,
	//'filter'=>$model,
// 'htmlOptions'=>array(
// 'class'=>'span10 offset1',
// ),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'employeeCode',
		array(
			'name' => 'fnTh',
			'value' => 'CHtml::encode($data->fnTh." ".$data->lnTh)',
		),
		array(
			'name' => 'leaveSick',
			'value' => 'calLeaveTime($data->leaveSick)'
		),
		array(
			'name' => 'leavePersonal',
			'value' => 'calLeaveTime($data->leavePersonal)'
		),
		array(
			'name' => 'leaveVocation',
			'value' => 'calLeaveTime($data->leaveVocation)'
		),
		array(
			'name' => 'leavePregnancy',
			'value' => 'calLeaveTime($data->leavePregnancy)'
		),
		array(
			'name' => 'leaveOrdinate',
			'value' => 'calLeaveTime($data->leaveOrdinate)'
		),
	//'leaveOther',
//		array(
//			'name' => 'position',
//			'value' => 'CHtml::encode($data->position)',
//			'filter' => false,
//		),
//		array(
//			'class' => 'CButtonColumn',
//			'header' => 'Action',
//			'template' => '{view}{update}',
//// 				'buttons'=>array(
//// 					'Mileage'=>array(
//// 						'url'=>'Yii::app()->createUrl("employee/mileage", array("id"=>$data->employeeId))',
//// 					),
//// 				),
//			'htmlOptions' => array(
//				'style' => 'width:120px;text-align:center;',
//			),
//		),
	),
));

function calLeaveTime($leaveTime)
{
	$res = explode(".", $leaveTime);
	return isset($res[1]) ? $res[0] . " วัน " . (floatval("0." . $res[1]) * 8) . " ช.ม. " : $res[0] . " วัน ";
}
?>
	