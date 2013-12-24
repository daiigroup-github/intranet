<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class' => 'well form-search'),
)); ?>

<?php echo $form->textField($model,'title',array('class'=>'imput-medium search-query')); ?>
<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>

<?php $this->endWidget(); ?>
