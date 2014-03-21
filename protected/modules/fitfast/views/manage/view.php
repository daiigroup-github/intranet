<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */

$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> View</li>';

$this->pageHeader = 'View FitAndFast';
?>

<?php
echo CHtml::link('<i class="icon-pencil"></i> แก้ไขขอ้มูล', $this->createUrl('update', array(
		'id'=>$model->fitAndFastId)), array(
	'class'=>'btn btn-info pull-right'));

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped table-condensed'),
	'attributes'=>array(
		//		'fitAndFastId',
		//		'status',
		'createDateTime',
		'updateDateTime',
		array(
			'name'=>'employeeId',
			'value'=>$model->employee->fnTh . ' ' . $model->employee->lnTh),
		'title',
		'description',
		'forYear',
		array(
			'name'=>'type',
			'value'=>$model->typeText()),
		'targetJan',
		//		'actualJan',
		//		'gradeJan',
		'targetFeb',
		//		'actualFeb',
		//		'gradeFeb',
		'targetMar',
		//		'actualMar',
		//		'gradeMar',
		'targetApr',
		//		'actualApr',
		//		'gradeApr',
		'targetMay',
		//		'actualMay',
		//		'gradeMay',
		'targetJun',
		//		'actualJun',
		//		'gradeJun',
		'targetJul',
		//		'actualJul',
		//		'gradeJul',
		'targetAug',
		//		'actualAug',
		//		'gradeAug',
		'targetSep',
		//		'actualSep',
		//		'gradeSep',
		'targetOct',
		//		'actualOct',
		//		'gradeOct',
		'targetNov',
		//		'actualNov',
		//		'gradeNov',
		'targetDec',
	//		'actualDec',
	//		'gradeDec',
	),
));
?>
