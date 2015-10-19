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
        <?php if(Yii::$app->controller->action->id != 'create-fitfast-target'):?>
		<?= $form->field($fitfastTargetModel, 'status',['options'=>['class'=>'row form-group']])->checkbox(['disabled'=>$disabled]) ?>

		<?php //= $form->field($fitfastTargetModel, 'employeeId',['options'=>['class'=>'row form-group']])->textInput(['value'=>$fitfastTargetModel->employee->fullThName, 'disabled'=>true]) ?>
        <?php endif;?>

		<?= $form->field($fitfastTargetModel, 'month',['options'=>['class'=>'row form-group']])->dropDownList($fitfastTargetModel->monthFull, ['disabled'=>$disabled]) ?>

		<?= $form->field($fitfastTargetModel, 'target',['options'=>['class'=>'row form-group']])->textarea(['rows' => 6, 'disabled'=>$disabled]) ?>

        <?php if(Yii::$app->controller->action->id != 'create-fitfast-target'):?>
		<?= $form->field($fitfastTargetModel, 'file',['options'=>['class'=>'row form-group']])->fileInput(['maxlength' => 255, 'disabled'=>$disabled]) ?>

		<?= $form->field($fitfastTargetModel, 'grade',['options'=>['class'=>'row form-group']])->textInput(['value'=>$fitfastTargetModel->gradeText, 'disabled'=>true]) ?>
        <?php endif;?>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::submitButton($fitfastTargetModel->isNewRecord ? 'Create' : 'Update', ['class' => $fitfastTargetModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
