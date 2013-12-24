<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'employee-level-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'code'); ?>
		<?php
		echo $form->textField($model, 'code', array(
			'size' => 60,
			'maxlength' => 100));
		?>
		<?php echo $form->error($model, 'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'level'); ?>
		<?php echo $form->textField($model, 'level'); ?>
		<?php echo $form->error($model, 'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php
		echo $form->textField($model, 'description', array(
			'size' => 60,
			'maxlength' => 80));
		?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'companyId'); ?>
		<?php //echo $form->textField($model,'companyId',array('size'=>20,'maxlength'=>20));  ?>
		<?php echo $form->dropdownList($model, 'companyId', Company::model()->getAllCompany()); ?>
		<?php echo $form->error($model, 'companyId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'divisionId'); ?>
		<?php //echo $form->textField($model,'divisionId');  ?>
		<?php echo $form->dropdownList($model, 'divisionId', CompanyDivision::model()->getAllCompanyDivision()); ?>
		<?php echo $form->error($model, 'divisionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'isManager'); ?>
		<?php echo $form->checkBox($model, 'isManager'); ?>
		<?php echo $form->error($model, 'isManager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->