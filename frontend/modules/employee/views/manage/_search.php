<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'employeeId') ?>

    <?= $form->field($model, 'employeeCode') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'createDateTime') ?>

    <?= $form->field($model, 'updateDateTime') ?>

    <?php // echo $form->field($model, 'isFirstLogin') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'prefix') ?>

    <?php // echo $form->field($model, 'prefixOther') ?>

    <?php // echo $form->field($model, 'fnTh') ?>

    <?php // echo $form->field($model, 'lnTh') ?>

    <?php // echo $form->field($model, 'nickName') ?>

    <?php // echo $form->field($model, 'fnEn') ?>

    <?php // echo $form->field($model, 'lnEn') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'citizenId') ?>

    <?php // echo $form->field($model, 'citizenIdExpire') ?>

    <?php // echo $form->field($model, 'accountNo') ?>

    <?php // echo $form->field($model, 'ext') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'employeeLevelId') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'companyId') ?>

    <?php // echo $form->field($model, 'companyValue') ?>

    <?php // echo $form->field($model, 'branchId') ?>

    <?php // echo $form->field($model, 'branchValue') ?>

    <?php // echo $form->field($model, 'companyDivisionId') ?>

    <?php // echo $form->field($model, 'managerId') ?>

    <?php // echo $form->field($model, 'startDate') ?>

    <?php // echo $form->field($model, 'proDate') ?>

    <?php // echo $form->field($model, 'transferDate') ?>

    <?php // echo $form->field($model, 'endDate') ?>

    <?php // echo $form->field($model, 'birthDate') ?>

    <?php // echo $form->field($model, 'isSale') ?>

    <?php // echo $form->field($model, 'isEngineer') ?>

    <?php // echo $form->field($model, 'leaveQuota') ?>

    <?php // echo $form->field($model, 'leaveRemain') ?>

    <?php // echo $form->field($model, 'isManager') ?>

    <?php // echo $form->field($model, 'lastChangePasswordDateTime') ?>

    <?php // echo $form->field($model, 'loginFailed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
