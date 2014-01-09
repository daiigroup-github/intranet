<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */

$this->breadcrumbs = array(
	'Elearning Exam Questions'=>array(
		'index'),
	$model->title=>array(
		'view',
		'id'=>$model->questionId),
	'Update',
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
	array(
		'label'=>'View ElearningExamQuestion',
		'url'=>array(
			'view',
			'id'=>$model->questionId)),
	array(
		'label'=>'Manage ElearningExamQuestion',
		'url'=>array(
			'admin')),
);
?>

<h1>Update ElearningExamQuestion <?php echo $model->questionId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'choiceModels'=>$choiceModels));
?>