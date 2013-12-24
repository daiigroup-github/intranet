<?php

// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('/qtechProject'),
// $projectModel->customer->customerName.' : '.$projectModel->projectName=>array('/qtechProject/'.$model->qtechProjectId),
// 'Create Process',
// );
// 
// $this->menu=array(
// array('label'=>'List QtechProcess', 'url'=>array('index')),
// array('label'=>'Manage QtechProcess', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>' . CHtml::link($projectModel->customer->customerName . ' : ' . $projectModel->projectName, Yii::app()->createUrl('/qtechProject/' . $model->qtechProjectId)) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Create QtechProcess';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>