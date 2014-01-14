<?php
$this->breadcrumb = '<li>' . CHtml::link('Employee', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>
					<li>เปลี่ยนรหัสผ่าน</li>';
$this->pageHeader = 'เปลี่ยนรหัสผ่าน';
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'changepassword-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array(
		'class' => 'form-horizontal'),
	));
?>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class' => 'alert alert-error'));
$form->error($model, 'oldPassword');
$form->error($model, 'password');
$form->error($model, 'password_repeat');
?>

<div class="control-group">
	<label class="control-label">
		<?php echo $form->labelEx($model, 'oldPassword'); ?>	
	</label>
	<div class="controls">
		<?php echo $form->passwordField($model, 'oldPassword'); ?>
	</div>
</div>

<div class="control-group">
	<label class="control-label">
		<?php echo $form->labelEx($model, 'password'); ?>	
	</label>
	<div class="controls">
		<?php echo $form->passwordField($model, 'password'); ?>
	</div>
</div>

<div class="control-group">
	<label class="control-label">
		<?php echo $form->labelEx($model, 'password_repeat'); ?>	
	</label>
	<div class="controls">
		<?php echo $form->passwordField($model, 'password_repeat'); ?>
	</div>
</div>

<div class="form-actions">
	<?php
	echo CHtml::submitButton('เปลี่ยนรหัสผ่าน', array(
		'confirm' => 'คุณต้องการเปลี่ยนรหัสผ่านหรือไม่ ?',
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->