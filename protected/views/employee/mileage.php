<?php

// $this->breadcrumbs=array(
// 'Employees'=>array('index'),
// 'Mileage '.strtoupper($model->username)=>array('employee/mileage/'.$model->employeeId),
// ($_GET['createDate'])
// );

$this->breadcrumb = '<li>' . CHtml::link('Employee', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>' . CHtml::link('Mileage Daily', Yii::app()->createUrl('/employee/mileage/' . $model->employeeId)) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Mileage</li>';
$this->pageHeader = 'Employees Mileage : ' . strtoupper($model->username) . ' ' . $_GET['createDate'];
?>

<?php

$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_mileage',
	'itemsCssClass' => 'row-fluid',
));
?>
