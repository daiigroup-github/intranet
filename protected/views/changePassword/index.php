<?php
$this->pageHeader = 'เปลี่ยนรหัสผ่าน';
?>

<div class="form well">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'changepassword-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	));
	?>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	?>

	<p>
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php $form->error($model, 'password'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'password_repeat'); ?>
		<?php echo $form->passwordField($model, 'password_repeat'); ?>
		<?php $form->error($model, 'password_repeat'); ?>

	<div class="alert">
		<strong>หมายเหตุ</strong> รหัสผ่านจะต้องมีตัวอักษรพิมพ์ใหญ่อย่างน้อย 1 ตัว ตัวอักษรพิมพ์เล็กอย่างน้อย 1 ตัว  ตัวเลขอย่างน้อย 1 ตัว และความยาวอย่างน้อย 8 ตัวอักษร
	</div>
</p>

<div class="form-actions">
	<?php echo CHtml::submitButton('เปลี่ยนรหัสผ่าน'); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
