<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'workflow-state-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class'=>'alert alert-error'));
	?>

	<div class="row">
		<?php echo $form->labelEx($model, 'workflowStateName'); ?>
		<?php
		echo $form->textField($model, 'workflowStateName', array(
			'size'=>60,
			'maxlength'=>80));
		?>
		<?php echo $form->error($model, 'workflowStateName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'currentState'); ?>
		<?php
		echo $form->textField($model, 'currentState', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'currentState'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'nextState'); ?>
		<?php
		echo $form->textField($model, 'nextState', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'nextState'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'workflowStatusId'); ?>
		<?php
		echo $form->textField($model, 'workflowStatusId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'workflowStatusId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'workflowGroupId'); ?>
		<?php
		echo $form->textField($model, 'workflowGroupId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
		<?php echo $form->error($model, 'workflowGroupId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->