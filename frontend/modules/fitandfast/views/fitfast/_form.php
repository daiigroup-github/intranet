<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Fitfast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fitfast-form">

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

		<?= $form->field($model, 'fitfastEmployeeId',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'employeeId',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'title',['options'=>['class'=>'row form-group']])->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'description',['options'=>['class'=>'row form-group']])->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'type',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'halfS',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'S',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'SS',['options'=>['class'=>'row form-group']])->textInput() ?>

		<?= $form->field($model, 'F',['options'=>['class'=>'row form-group']])->textInput() ?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
