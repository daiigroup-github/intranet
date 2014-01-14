<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'notice-type-form',
		'enableAjaxValidation' => false,
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	?>

	<p>
		<?php echo $form->labelEx($model, 'noticeTypeName'); ?>
		<?php
		echo $form->textField($model, 'noticeTypeName', array(
			'size' => 60,
			'maxlength' => 500));
		?>
		<?php echo $form->error($model, 'noticeTypeName'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'noticeTypeCode'); ?>
		<?php
		echo $form->textField($model, 'noticeTypeCode', array(
			'size' => 60,
			'maxlength' => 10));
		?>
		<?php echo $form->error($model, 'noticeTypeCode'); ?>
	</p>


	<p>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</p>

	<?php $this->endWidget(); ?>

</div><!-- form -->