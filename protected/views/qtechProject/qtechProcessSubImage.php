<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// $model->customer->customerName.' : '.$model->projectName =>array('/qtechProject/'.$model->qtechProjectId),
// $processSubModel->process->processName,
// );
//
// $this->menu=array(
// array('label'=>'Create QtechProject', 'url'=>array('create')),
// array('label'=>'Manage QtechProject', 'url'=>array('admin')),
// );

$this->breadcrumb = '<li>' . CHtml::link('Qtech Projects', Yii::app()->createUrl('/qtechProject')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>' . CHtml::link($model->customer->customerName . ' : ' . $model->projectName, Yii::app()->createUrl('/qtechProject/' . $model->qtechProjectId)) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>' . $processSubModel->process->processName . '<span class="divider">/</span></li>';
$this->pageHeader = $processSubModel->processSubName;
?>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_qtechProcessSubImage',
	'htmlOptions'=>array(
		'class'=>'span'
	),
	'itemsCssClass'=>'row-fluid',
	'pager'=>array(
		'htmlOptions'=>array(
		),
		'header'=>'',
	),
));
?>
