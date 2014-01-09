<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// $model->qtechProjectId=>array('view','id'=>$model->qtechProjectId),
// 'Update',
// );
//
// $this->menu=array(
// array('label'=>'List QtechProject', 'url'=>array('index')),
// array('label'=>'Create QtechProject', 'url'=>array('create')),
// array('label'=>'View QtechProject', 'url'=>array('view', 'id'=>$model->qtechProjectId)),
// array('label'=>'Manage QtechProject', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Update QtechProject';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>