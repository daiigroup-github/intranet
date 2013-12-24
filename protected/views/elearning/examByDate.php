<?php
$this->pageHeader = 'Exam';
Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
	$('#elearning-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
	<a href="<?php echo Yii::app()->createUrl('elearning/generateExam');?>" class="btn btn-info"><i class="icon-plus-sign"></i> เลือกผู้เข้าสอบ</a>
</p>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'id' => 'search-form',
	'htmlOptions' => array(
		'class' => 'well form-search'),
	));
?>

<?php
echo $form->textField($elearningExamModel, 'searchText', array('class'=>'input-medium'));
echo $form->dropDownList($elearningExamModel, 'examDate', CHtml::listData($examDate, 'examDate', 'examDate'), array(
	'class' => 'input-medium search-query', 'prompt'=>'All'));
?>
<?php
echo CHtml::submitButton('Search', array(
	'class' => 'btn'));
?>

<?php $this->endWidget(); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'elearning-grid',
	'dataProvider' => $elearningExamModel->search(),
	'itemsCssClass' => 'table table-striped table-bordered',
	'columns' => array(
		array(
			'name'=>'status',
			'value'=>'ElearningExam::model()->getStatusText($data->status)',
			),
		'examDate',
		'createDateTime',
		array(
			'name'=>'employee',
			'value'=>'$data->employee->fnTh." ".$data->employee->lnTh',
		),
		'point',
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}{delete}',
			'buttons'=>array(
				'view'=>array(
					'click'=>'',	
					),
				'delete'=>array(
					'click'=>'',
					),
				),
		),
	),
));
?>