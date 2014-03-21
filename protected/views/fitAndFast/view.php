<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */

$this->breadcrumbs=array(
	'Fit And Fasts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List FitAndFast', 'url'=>array('index')),
	array('label'=>'Create FitAndFast', 'url'=>array('create')),
	array('label'=>'Update FitAndFast', 'url'=>array('update', 'id'=>$model->fitAndFastId)),
	array('label'=>'Delete FitAndFast', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fitAndFastId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FitAndFast', 'url'=>array('admin')),
);
?>

<h1>View FitAndFast #<?php echo $model->fitAndFastId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fitAndFastId',
		'status',
		'createDateTime',
		'updateDateTime',
		'employeeId',
		'title',
		'description',
		'sumS',
		'sumF',
		'targetJan',
		'actualJan',
		'gradeJan',
		'targetFeb',
		'actualFeb',
		'gradeFeb',
		'targetMar',
		'actualMar',
		'gradeMar',
		'targetApr',
		'actualApr',
		'gradeApr',
		'targetMay',
		'actualMay',
		'gradeMay',
		'targetJun',
		'actualJun',
		'gradeJun',
		'targetJul',
		'actualJul',
		'gradeJul',
		'targetAug',
		'actualAug',
		'gradeAug',
		'targetSep',
		'actualSep',
		'gradeSep',
		'targetOct',
		'actualOct',
		'gradeOct',
		'targetNov',
		'actualNov',
		'gradeNov',
		'targetDec',
		'actualDec',
		'gradeDec',
	),
)); ?>
