<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// 'Create',
// );
//
// $this->menu=array(
// array('label'=>'List QtechProject', 'url'=>array('index')),
// array('label'=>'Manage QtechProject', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Create QtechProject';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>