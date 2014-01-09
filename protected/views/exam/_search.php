<?php
/* @var $this ExamController */
/* @var $model ExamTitle */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'htmlOptions'=>array(
			'class'=>'form-inline well',
		),
		'method'=>'get',
	));
	?>

	<?php
	echo $form->textField($model, 'searchText', array(
		'class'=>'input-medium',
		'placeholder'=>'Search'));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->