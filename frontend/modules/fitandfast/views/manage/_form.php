<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FitfastEmployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fitfast-employee-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'panel form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div>',
            'labelOptions'=>[
                'class'=>'col-sm-2 control-label'
            ]
        ]
    ]); ?>

    <div class="panel-heading">
        <span class="panel-title"><?=$title?></span>
    </div>

    <div class="panel-body">
        <?php
        $isDisabled = (Yii::$app->controller->action->id == 'update') ? true : false;
        ?>

		<?= $form->field($model, 'status',['options'=>['class'=>'row form-group']])->checkbox() ?>

		<?= $form->field($model, 'createDateTime',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'updateDateTime',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'employeeId',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'halfS',['options'=>['class'=>'row form-group']])->textInput(['disabled'=>$isDisabled]) ?>

		<?= $form->field($model, 'S',['options'=>['class'=>'row form-group']])->textInput(['disabled'=>$isDisabled]) ?>

		<?= $form->field($model, 'SS',['options'=>['class'=>'row form-group']])->textInput(['disabled'=>$isDisabled]) ?>

		<?= $form->field($model, 'F',['options'=>['class'=>'row form-group']])->textInput(['disabled'=>$isDisabled]) ?>

		<?= $form->field($model, 'forYear',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 4]) ?>

		<?= $form->field($model, 'percent',['options'=>['class'=>'row form-group']])->textInput(['disabled'=>$isDisabled]) ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
