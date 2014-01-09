<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfo */

$this->breadcrumbs = array(
	'Employee Infos'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List EmployeeInfo',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create EmployeeInfo',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>รับผู้สมัครเข้าทำงาน</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
	</div>
</div>
<div class="search-form" style="display:none">
	<?php /* $this->renderPartial('_search',array(
	  'model'=>$model,
	  )); */ ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-info-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'dataProvider'=>ApplicationInterview::model()->switchAction(),
	//'filter'=>$model,
	'columns'=>array(
		//'ID',
		array(
			'name'=>'fnTh',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:20%'),
			'value'=>'CHtml::encode(isset($data->employeeInfo->fnTh) ? $data->employeeInfo->fnTh : "-")',
		),
		array(
			'name'=>'lnTh',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:20%'),
			'value'=>'CHtml::encode(isset($data->employeeInfo->lnTh) ? $data->employeeInfo->lnTh : "-")',
		),
		array(
			'name'=>'appliedPosition',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:20%'),
			'value'=>'CHtml::encode(isset($data->employeeInfo->appliedPosition) ? $data->employeeInfo->appliedPosition : "-")',
		),
		array(
			'name'=>'status',
			'type'=>'raw',
			//'htmlOptions'=>array('style'=>'text-align:left;width:15%'),
			'value'=>'showStatus($data->status)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{นัดสัมภาษณ์ให้นาย}',
			'buttons'=>array(
				'นัดสัมภาษณ์ให้นาย'=>array(
					'name'=>'xxxx',
					'url'=>'$this->grid->controller->createUrl("view", array("id"=>$data->applicationId,"gridId"=>$this->grid->id,"appInterId"=>$data->primaryKey))'
				//,'visible' => '!(ApplicationInterview::model()->Interviewed($data->applicationId))',
				),
				'นัดสัมภาษณ์ให้นาย'=>array(
					'url'=>'$this->grid->controller->createUrl("waitSendCeo", array("id"=>$data->applicationId,"gridId"=>$this->grid->id,"appInterId"=>$data->primaryKey))'
					,
					'visible'=>'ApplicationInterview::model()->Interviewed($data->applicationId)',
				),
			),
		),
	),
));

function showStatus($status)
{
	switch($status)
	{
		case EmployeeInfo::STATUS_APP_CREATE :
			return "ส่งใบสมัคร";
		case EmployeeInfo::STATUS_APP_INTERVIEW :
			return "รอสัมภาษณ์";
		case EmployeeInfo::STATUS_APP_ESTIMATE :
			return "สัมภาษณ์แล้ว";
	}
}
?>

<?php
//--------------------- begin new code --------------------------
// add the (closed) dialog for the iframe
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'cru-dialog',
	'options'=>array(
		'title'=>'เลือกผู้สัมภาษณ์งาน',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>750,
		'height'=>500,
	//'buttons' => array('AA','')
	),
));
?>
<iframe id="cru-frame" width="100%" height="100%"></iframe>
<?php
$this->endWidget();

//--------------------- end new code --------------------------

