<?php

// $this->breadcrumbs=array(
// 'Qtech Processes'=>array('index'),
// $model->qtechProcessId=>array('view','id'=>$model->qtechProcessId),
// 'Update',
// );
// 
// $this->menu=array(
// array('label'=>'List QtechProcess', 'url'=>array('index')),
// array('label'=>'Create QtechProcess', 'url'=>array('create')),
// array('label'=>'View QtechProcess', 'url'=>array('view', 'id'=>$model->qtechProcessId)),
// array('label'=>'Manage QtechProcess', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>' . CHtml::link($model->project->customer->customerName . ' : ' . $model->project->projectName, Yii::app()->createUrl('/qtechProject/' . $model->project->qtechProjectId)) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Update QtechProcess';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>