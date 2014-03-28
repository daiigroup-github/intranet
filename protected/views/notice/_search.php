<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	));
?>

<div class="row">
	<?php echo $form->label($model, 'noticeId'); ?>
	<?php
	echo $form->textField($model, 'noticeId', array(
		'size' => 20,
		'maxlength' => 20));
	?>
</div>

<div class="row">
	<?php echo $form->label($model, 'title'); ?>
	<?php
	echo $form->textField($model, 'title', array(
		'size' => 60,
		'maxlength' => 500));
	?>
</div>

<div class="row">
	<?php echo $form->label($model, 'description'); ?>
	<?php
	echo $form->textField($model, 'description', array(
		'size' => 60,
		'maxlength' => 2000));
	?>
</div>

<div class="row">
	<?php echo $form->label($model, 'employeeId'); ?>
	<?php
	echo $form->textField($model, 'employeeId', array(
		'size' => 20,
		'maxlength' => 20));
	?>
</div>

<div class="row">
	<?php echo $form->label($model, 'status'); ?>
	<?php echo $form->textField($model, 'status'); ?>
</div>

<div class="row">
	<?php echo $form->label($model, 'noticeTypeId'); ?>
	<?php
	echo $form->textField($model, 'noticeTypeId', array(
		'size' => 20,
		'maxlength' => 20));
	?>
</div>

<div class="row">
	<?php echo $form->label($model, 'createDateTime'); ?>
	<?php echo $form->textField($model, 'createDateTime'); ?>
</div>

<div class="row">
	<?php echo $form->label($model, 'updateDateTime'); ?>
	<?php echo $form->textField($model, 'updateDateTime'); ?>
</div>

<div class="row buttons">
	<?php echo CHtml::submitButton('Search'); ?>
</div>

<?php $this->endWidget(); ?>
<!-- search-form -->