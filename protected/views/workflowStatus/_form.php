<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'workflow-status-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));
?>


<div class="row">
	<div class="span12">
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php
		echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
			'class' => 'alert alert-error'));
		$form->error($model, 'workflowStatusName');
		?>
	</div>
</div>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'workflowStatusName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowStatusName', array(
				'size' => 60,
				'maxlength' => 80));
			?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'workflowStatusGroup'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowStatusGroup', array(
				'size' => 60,
				'maxlength' => 100));
			?>
		</div>
	</div>
	<div class="form-actions">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class' => 'btn btn-primary'));
		?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>
<!-- form -->