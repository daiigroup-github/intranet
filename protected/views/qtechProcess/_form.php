<div class="form well">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'qtech-process-form',
		'enableAjaxValidation' => false,
	));
	?>

	<div class="row">
		<div class="span">
			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php
			echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
				'class' => 'alert alert-error'));
			?>
		</div>
	</div>

	<div class="row">
		<div class="span">
			<?php echo $form->labelEx($model, 'processName'); ?>
			<?php
			echo $form->textField($model, 'processName', array(
				'size' => 60,
				'maxlength' => 100));
			?>
			<?php echo $form->error($model, 'processName'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span">
			<?php echo $form->labelEx($model, 'processDetail'); ?>
			<?php
			echo $form->textField($model, 'processDetail', array(
				'size' => 60,
				'maxlength' => 120));
			?>
			<?php echo $form->error($model, 'processDetail'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span">
			<?php echo $form->labelEx($model, 'duration'); ?>
			<?php
			echo $form->textField($model, 'duration', array(
				'size' => 10,
				'maxlength' => 10));
			?>
			<?php echo $form->error($model, 'duration'); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php echo $form->hiddenField($model, 'qtechProjectId'); ?>

	<?php $this->endWidget(); ?>

</div><!-- form -->