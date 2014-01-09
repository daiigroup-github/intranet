<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'stock-detail-form',
		'enableAjaxValidation'=>false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class'=>'alert alert-error'));
	?>

	<p>
		<?php echo $form->labelEx($model, 'stockDetailCode'); ?>
		<?php
		echo $form->textField($model, 'stockDetailCode', array(
			'size'=>20,
			'maxlength'=>20,
			'readonly'=>'readonly'));
		?>
		<?php echo $form->error($model, 'stockDetailCode'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'stockDetailName'); ?>
		<?php
		echo $form->textField($model, 'stockDetailName', array(
			'size'=>60,
			'maxlength'=>500));
		?>
		<?php echo $form->error($model, 'stockDetailName'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'stockDetailUnit'); ?>
		<?php
		echo $form->textField($model, 'stockDetailUnit', array(
			'size'=>30,
			'maxlength'=>30));
		?>
		<?php echo $form->error($model, 'stockDetailUnit'); ?>
	</p>


	<p>
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</p>

	<p>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</p>

	<?php $this->endWidget(); ?>

</div><!-- form -->