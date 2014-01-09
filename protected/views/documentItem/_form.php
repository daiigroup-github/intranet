<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'document-item-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class'=>'alert alert-error'));
	?>

	<div class="row">
		<?php echo $form->labelEx($model, 'documentId'); ?>
		<?php
		echo $form->textField($model, 'documentId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'documentId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'documentItemName'); ?>
		<?php
		echo $form->textField($model, 'documentItemName', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
		<?php echo $form->error($model, 'documentItemName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description1'); ?>
		<?php
		echo $form->textField($model, 'description1', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
		<?php echo $form->error($model, 'description1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description2'); ?>
		<?php
		echo $form->textField($model, 'description2', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
		<?php echo $form->error($model, 'description2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description3'); ?>
		<?php
		echo $form->textField($model, 'description3', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
		<?php echo $form->error($model, 'description3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->