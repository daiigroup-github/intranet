<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $fitfastModel frontend\models\Fitfast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fitfast-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-2 control-label'
            ]
        ]
    ]); ?>
    <div class="panel">

        <div class="panel-heading">
            <span class="panel-title"><?= $title ?></span>
        </div>

        <div class="panel-body">

            <?= $form->field($fitfastModel, 'employeeId', ['options' => ['class' => 'row form-group']])->textInput(['value' => $fitfastEmployeeModel->employee->fullThName, 'disabled' => true]) ?>

            <?= $form->field($fitfastModel, 'title', ['options' => ['class' => 'row form-group']])->textarea(['rows' => 6]) ?>

            <?= $form->field($fitfastModel, 'description', ['options' => ['class' => 'row form-group']])->textarea(['rows' => 6]) ?>

            <?= $form->field($fitfastModel, 'type', ['options' => ['class' => 'row form-group']])->dropDownList($fitfastModel->typeArray) ?>

        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">Target</div>
        <div class="panel-body">
            <?php foreach ($fitfastModel->monthFull as $k=>$v):?>
                <?= $form->field($fitfastTargetModel, "[{$k}]target", ['options' => ['class' => 'row form-group']])->label($v)->textInput() ?>
            <?php endforeach;?>
            </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <?= Html::submitButton($fitfastModel->isNewRecord ? 'Create' : 'Update', ['class' => $fitfastModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
