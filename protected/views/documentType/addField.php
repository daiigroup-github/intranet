<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'document-template-field-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'documentTemplateFieldName'); ?>
		<?php
		echo $form->textField($model, 'documentTemplateFieldName', array(
			'size' => 60,
			'maxlength' => 500));
		?>
		<?php echo $form->error($model, 'documentTemplateFieldName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'documentTemplateFieldType'); ?>
		<?php
		echo $form->textField($model, 'documentTemplateFieldType', array(
			'size' => 60,
			'maxlength' => 100));
		?>
		<?php echo $form->error($model, 'documentTemplateFieldType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'active'); ?>
		<?php echo $form->textField($model, 'active'); ?>
		<?php echo $form->error($model, 'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'createDateTime'); ?>
		<?php echo $form->textField($model, 'createDateTime'); ?>
		<?php echo $form->error($model, 'createDateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->