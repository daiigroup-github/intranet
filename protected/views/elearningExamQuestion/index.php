<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */

$this->breadcrumbs = array(
	'Elearning Exam Questions'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List ElearningExamQuestion',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ElearningExamQuestion',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#elearning-exam-question-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>
	Manage Elearning Exam Questions
	<?php
	echo CHtml::link('<i class="icon-plus"></i> เพิ่มรายการ', Yii::app()->createUrl('ElearningExamQuestion/create'), array(
		'class'=>'btn btn-primary pull-right',
	));
	?>
</h1>

<?php
$this->renderPartial('_search', array(
	'model'=>$model,
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'elearning-exam-question-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered',
	'columns'=>array(
		'status',
		'title',
		'elearningId',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
