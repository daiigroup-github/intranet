<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */

$this->breadcrumbs=array(
	'Elearning Exam Questions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ElearningExamQuestion', 'url'=>array('index')),
	array('label'=>'Create ElearningExamQuestion', 'url'=>array('create')),
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

<h1>Manage Elearning Exam Questions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'elearning-exam-question-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'questionId',
		'status',
		'title',
		'description',
		'elearningId',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
