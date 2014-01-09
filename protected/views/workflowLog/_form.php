<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'workflow-log-form',
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
		<?php echo $form->labelEx($model, 'workflowStateId'); ?>
		<?php
		echo $form->textField($model, 'workflowStateId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'workflowStateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'employeeId'); ?>
		<?php
		echo $form->textField($model, 'employeeId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'employeeId'); ?>
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