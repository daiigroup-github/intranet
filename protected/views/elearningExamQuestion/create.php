<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */

$this->breadcrumbs=array(
	'Elearning Exam Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ElearningExamQuestion', 'url'=>array('index')),
	array('label'=>'Manage ElearningExamQuestion', 'url'=>array('admin')),
);
?>

<h1>Create ElearningExamQuestion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'choiceModel'=>$choiceModel, 'choiceModels'=>$choiceModels)); ?>