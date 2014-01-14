<?php

// $this->breadcrumbs=array(
// 'Employees'=>array('index'),
// 'Mileage : '.strtoupper($model->username),
// );

$this->breadcrumb = '<li>' . CHtml::link('Employee', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Mileage Daily</li>';
$this->pageHeader = 'Mileage Daily : ' . strtoupper($model->username);
?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $dataProvider,
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'createDate',
		'sumMileageDiff',
		array(
			'class' => 'CButtonColumn',
			'header' => 'Action',
			'template' => '{view}',
			'buttons' => array(
				'view' => array(
					'url' => 'Yii::app()->createUrl("employee/mileageWithEmployeeId", array("id"=>$data->employeeId, "createDate"=>$data->createDate))',
				),
			)
		),
	),
));
?>
