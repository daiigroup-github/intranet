<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'mileage-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class'=>'alert alert-error'));
	?>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'createDate'); ?>
		<?php echo $form->textField($model, 'createDate'); ?>
		<?php echo $form->error($model, 'createDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'createTime'); ?>
		<?php echo $form->textField($model, 'createTime'); ?>
		<?php echo $form->error($model, 'createTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'captureTime'); ?>
		<?php echo $form->textField($model, 'captureTime'); ?>
		<?php echo $form->error($model, 'captureTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'mileage'); ?>
		<?php
		echo $form->textField($model, 'mileage', array(
			'size'=>11,
			'maxlength'=>11));
		?>
		<?php echo $form->error($model, 'mileage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'mileageDiff'); ?>
		<?php
		echo $form->textField($model, 'mileageDiff', array(
			'size'=>5,
			'maxlength'=>5));
		?>
		<?php echo $form->error($model, 'mileageDiff'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'mileageDetail'); ?>
		<?php
		echo $form->textArea($model, 'mileageDetail', array(
			'rows'=>6,
			'cols'=>50));
		?>
		<?php echo $form->error($model, 'mileageDetail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'mileageImage'); ?>
		<?php
		echo $form->textField($model, 'mileageImage', array(
			'size'=>60,
			'maxlength'=>255));
		?>
		<?php echo $form->error($model, 'mileageImage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'latitude'); ?>
		<?php
		echo $form->textField($model, 'latitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'longitude'); ?>
		<?php
		echo $form->textField($model, 'longitude', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'employeeId'); ?>
		<?php
		echo $form->textField($model, 'employeeId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
		<?php echo $form->error($model, 'employeeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'branchId'); ?>
		<?php
		echo $form->textField($model, 'branchId', array(
			'size'=>11,
			'maxlength'=>11));
		?>
		<?php echo $form->error($model, 'branchId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'qtechProjectId'); ?>
		<?php
		echo $form->textField($model, 'qtechProjectId', array(
			'size'=>11,
			'maxlength'=>11));
		?>
		<?php echo $form->error($model, 'qtechProjectId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->