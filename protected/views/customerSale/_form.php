<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'customer-sale-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'customerId'); ?>
		<?php
		echo $form->textField($model, 'customerId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
		<?php echo $form->error($model, 'customerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'saleId'); ?>
		<?php
		echo $form->textField($model, 'saleId', array(
			'size' => 20,
			'maxlength' => 20));
		?>
		<?php echo $form->error($model, 'saleId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'companyValue'); ?>
		<?php
		echo $form->textField($model, 'companyValue', array(
			'size' => 10,
			'maxlength' => 10));
		?>
		<?php echo $form->error($model, 'companyValue'); ?>
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