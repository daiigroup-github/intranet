<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'qtech-project-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'productCatId'); ?>
		<?php echo $form->dropDownList($model, 'productCatId', ProductCategory::getAllProductCat()); ?>
		<?php echo $form->error($model, 'productCatId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'projectName'); ?>
		<?php
		echo $form->textField($model, 'projectName', array(
			'size' => 60,
			'maxlength' => 100));
		?>
		<?php echo $form->error($model, 'projectName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'projectDetail'); ?>
		<?php
		echo $form->textField($model, 'projectDetail', array(
			'size' => 60,
			'maxlength' => 255));
		?>
		<?php echo $form->error($model, 'projectDetail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'projectPrice'); ?>
		<?php echo $form->textField($model, 'projectPrice'); ?>
		<?php echo $form->error($model, 'projectPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'projectAddress'); ?>
		<?php
		echo $form->textField($model, 'projectAddress', array(
			'size' => 60,
			'maxlength' => 255));
		?>
		<?php echo $form->error($model, 'projectAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'customerId'); ?>
		<?php echo $form->dropDownList($model, 'customerId', Customer::getAllCustomer()); ?>
		<?php echo $form->error($model, 'customerId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'startDate'); ?>
		<?php echo $form->textField($model, 'startDate'); ?>
		<?php echo $form->error($model, 'startDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->