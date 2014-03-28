<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'workflow-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));
?>

<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	$form->error($model, 'workflowName');
	$form->error($model, 'employeeId');
	$form->error($model, 'groupId');
	?>
</p>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'workflowName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowName', array(
				'size' => 60,
				'maxlength' => 500));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'employeeId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'employeeId', Employee::model()->getAllEmployeeByDivisionValue(65535), array(
				'class' => 'input-medium'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'groupId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'groupId', Group::model()->getAllGroup(), array(
				'class' => 'input-medium'));
			?>
		</div>
	</div>
</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->