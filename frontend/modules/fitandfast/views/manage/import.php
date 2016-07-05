<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FitfastEmployee */

$this->title = 'Import Fit and Fast';
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-employee-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'panel form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-2 control-label'
            ]
        ]
    ]); ?>

    <div class="panel-heading">
        <span class="panel-title"><?= $this->title ?></span>
    </div>

    <div class="panel-body">

        <div class="row form-group field-fitfastemployee-importfile">
            <label class="col-sm-2 control-label" for="fitfastemployee-importfile">Import File</label>
            <div class="col-sm-10">
                <input type="file" id="fitfastemployee-importfile" name="importFile">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <?= Html::submitButton('Import File', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
