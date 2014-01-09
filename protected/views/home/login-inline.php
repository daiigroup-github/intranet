<!-- Login -->
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form form-inline'),
	));
?>
<?php
echo $form->textField($model, 'username', array(
	'placeholder'=>'Employee ID',
	'class'=>'span2'));
?>
<?php
echo $form->passwordField($model, 'password', array(
	'placeholder'=>'Password',
	'class'=>'span2'));
?>

<?php
echo CHtml::submitButton('Sign in', array(
	'class'=>'btn btn-primary btn-mini',
));
?>

<?php echo CHtml::link('Forgot Password', Yii::app()->createUrl('/forgotpassword')) ?>
<?php $this->endWidget(); ?>