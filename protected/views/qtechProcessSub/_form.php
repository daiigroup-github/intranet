<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'qtech-process-sub-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'employeeId'); ?>
		<?php echo $form->dropDownList($model, 'employeeId', Employee::getAllEngineer()); ?>
		<?php echo $form->error($model, 'employeeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'processSubName'); ?>
		<?php
		echo $form->textField($model, 'processSubName', array(
			'size' => 60,
			'maxlength' => 100));
		?>
		<?php echo $form->error($model, 'processSubName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'processSubDetail'); ?>
		<?php
		echo $form->textField($model, 'processSubDetail', array(
			'size' => 60,
			'maxlength' => 100));
		?>
		<?php echo $form->error($model, 'processSubDetail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'earningPrecent'); ?>
		<?php echo $form->textField($model, 'earningPrecent'); ?>
		<?php echo $form->error($model, 'earningPrecent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'contractorCost'); ?>
		<?php echo $form->textField($model, 'contractorCost'); ?>
		<?php echo $form->error($model, 'contractorCost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'duration'); ?>
		<?php echo $form->textField($model, 'duration'); ?>
		<?php echo $form->error($model, 'duration'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php echo $form->hiddenField($model, 'qtechProjectId'); ?>
	<?php echo $form->hiddenField($model, 'qtechProcessId'); ?>

	<?php $this->endWidget(); ?>

</div><!-- form -->