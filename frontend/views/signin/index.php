<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="signin-header">
    <a href="index.html" class="logo">
<!--        <div class="demo-logo bg-primary"><img src="assets/demo/logo-big.png" alt="" style="margin-top: -4px;"></div>-->
        <div class="demo-logo bg-primary"><?= \yii\helpers\Html::img(\yii\helpers\BaseUrl::base().'/images/logo.jpg', ['style'=>'margin-top:-12px;width:100px;'])?></div>
        &nbsp;
        <?= Yii::$app->id ?>
    </a> <!-- / .logo -->
<!--    <a href="pages-signup-alt.html" class="btn btn-primary">Sign Up</a>-->
</div> <!-- / .header -->

<h1 class="form-header">Sign in to your Account</h1>

<?php $form = ActiveForm::begin([
    'id' => 'signin-form_id',
    'options' => ['class' => 'panel', 'placeholder' => 'Username'],
    'fieldConfig' => ['template' => '{input}']
]); ?>
<?= $form->field($model, 'username', ['inputOptions' => ['class' => 'form-control input-lg', 'placeholder' => 'Username']]) ?>
<?= $form->field($model, 'password', ['options' => ['class' => 'form-group signin-password'], 'inputOptions' => ['class' => 'form-control input-lg', 'placeholder' => 'Password']])->passwordInput() ?>
<div class="form-actions">
    <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'login-button']) ?>
</div>
<?php ActiveForm::end(); ?>

<div class="signin-with">

</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <?php foreach ($webs as $k => $web): ?>
                <?php
                $img = strtolower(implode('', explode(' ', $k)));
                ?>
                <div class="col-md-2">
                    <?= Html::a(Html::img(\yii\helpers\BaseUrl::base() . '/images/webs/' . $img . '.jpg', ['class' => 'img-rounded']) . '<br />' . $k, 'http://' . $web, ['class' => 'thumbnail text-center']); ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>