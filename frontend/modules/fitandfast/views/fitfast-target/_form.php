<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\fitfastTarget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fitfast-target-form">

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
		<?= $form->field($model, 'status',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'createDateTime',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'updateDateTime',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'employeeId',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'fitfastId',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'month',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'target',['options'=>['class'=>'row form-group']])->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'file',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'grade',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'parentId',['options'=>['class'=>'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
