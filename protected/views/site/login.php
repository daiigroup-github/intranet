<?php
$this->pageHeader = 'เข้าสู่ระบบ';
?>

<style type="text/css">
	body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
	}

	.form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
        margin-bottom: 10px;
	}
	.form-signin input[type="text"],
	.form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
	}

</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,),
	'htmlOptions' => array(
		'class' => 'form-signin'),));
?>

<?php
echo $form->textField($model, 'username', array(
	'placeholder' => 'Username',
	'class' => 'input-block-level'));
?>

<?php
echo $form->passwordField($model, 'password', array(
	'placeholder' => 'Password',
	'class' => 'input-block-level'));
?>

<label class="checkbox">
	<?php echo $form->checkBox($model, 'rememberMe'); ?>
	<?php echo $form->label($model, 'rememberMe'); ?>
</label>

<p class="alert alert-error ">
	หากคุณลืมรหัสผ่าน <a href="<?php echo Yii::app()->createUrl('/Site/ResetPassword'); ?>" title="ขอรหัสผ่านใหม่" >..คลิิ๊ก..</a>
</p>

<?php
echo CHtml::submitButton('เข้าสู่ระบบ', array(
	'class' => 'btn btn-primary',));
?>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class' => 'alert alert-error'));
?>

<?php
if (isset($_GET["resetMessage"]))
	echo "<p style='color:red'>กรุณา ตรวจสอบ อีเมล์ ของท่านเพื่อรับ รหัสผ่านใหม่</p>";
?>

<?php $this->endWidget(); ?>