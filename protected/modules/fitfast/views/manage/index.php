<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */

$this->breadcrumb = '<li>Manage Fit And Fast</li>';

Yii::app()->clientScript->registerScript('search', "
$('#fitAndFastSearch').submit(function(){
	$('#fit-and-fast-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageHeader = 'Manage Fit And Fast';
?>

<?php
echo CHtml::link('<i class="icon-plus-sign"></i> เพิ่มข้อมูล', $this->createUrl('create'), array(
	'class'=>'btn btn-success pull-right'));
?>

<?php
$this->renderPartial('_search', array(
	'model'=>$model,));
?>

<div class="row-fluid">
	<div class="span12">
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'fit-and-fast-grid',
			'dataProvider'=>$model->search(),
			//'filter' => $model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array(
					'name'=>'employeeId',
					'type'=>'raw',
					'value'=>'($data->status)?"<i class=\"icon-play\" style=\"color:green\"></i> ". $data->employee->fnTh." ".$data->employee->lnTh:"<i class=\"icon-stop\" style=\"color:red\"></i> ". $data->employee->fnTh." ".$data->employee->lnTh',
				),
				'title',
				array(
					'name'=>'type',
					'value'=>'$data->typeText()'),
				/*
				  'description',
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
				 */
				array(
					'class'=>'CButtonColumn',),
			),
		));
		?>
	</div>
</div>
