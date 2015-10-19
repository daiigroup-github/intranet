<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
//current action $this->context->module->controller->action->id
?>
<?php $form = ActiveForm::begin([
    'id' => 'employee-form',
    'enableClientValidation' => false,
    'options' => [
        'class' => 'form-horizontal',
        'enctype'=>'multipart/form-data'
    ]
]); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">ข้อมูลส่วนตัว</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'prefix', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList($model->getPrefixArray(), ['prompt'=>'--- Select ---']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'nickName', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 45]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'gender', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList($model->getGenderArray(), ['prompt'=>'--- Select ---']) ?>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'fnTh', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 80]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'lnTh', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 120]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'fnEn', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 80]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'lnEn', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 120]) ?>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'citizenId', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 50]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'citizenIdExpire', ['options' => ['class' => 'form-group no-margin-hr']])->widget(
                                DatePicker::className(),
                                [
                                    'dateFormat' => 'dd-MM-yyyy',
                                    'options' => ['class' => 'form-control'],
                                ]
                            )  ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'mobile', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 20]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'birthDate', ['options' => ['class' => 'form-group no-margin-hr']])->widget(
                                DatePicker::className(),
                                [
                                    'dateFormat' => 'dd-MM-yyyy',
                                    'options' => ['class' => 'form-control'],
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">ข้อมูลบริษัท</span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'position', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 120]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'companyDivisionId', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList(\frontend\models\CompanyDivision::getAllCompanyDivision(), ['prompt'=>'--- Select ---']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'employeeLevelId', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList(\frontend\models\EmployeeLevel::getAllEmployeeLevel(), ['prompt'=>'--- Level ---']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'managerId', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList($model->getAllManager(), ['prompt'=>'--- ผู้จัดการฝ่าย ---']) ?>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-sm-7">
                            <?= $form->field($model, 'companyId', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList(\frontend\models\Company::getAllCompany(), ['prompt'=>'--- บริษัท ---']) ?>
                        </div>
                        <div class="col-sm-5">
                            <?= $form->field($model, 'branchId', ['options' => ['class' => 'form-group no-margin-hr']])->dropDownList(\frontend\models\Branch::getAllBranch(), ['prompt'=>'--- สาขา ---']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><?= $model->startDate ?>
                            <?= $form->field($model, 'startDate', ['options' => ['class' => 'form-group no-margin-hr']])->widget(
                                DatePicker::className(),
                                [
                                    'dateFormat' => 'dd-MM-yyyy',
                                    'options' => ['class' => 'form-control'],
                                ]
                            ) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'accountNo', ['options' => ['class' => 'form-group no-margin-hr']])->textInput(['maxlength' => 50]) ?>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-4">
                            <?= $form->field($model, 'isSale', ['options' => ['class' => 'form-group no-margin-hr']])->checkbox() ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'isEngineer', ['options' => ['class' => 'form-group no-margin-hr']])->checkbox() ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'isManager', ['options' => ['class' => 'form-group no-margin-hr']])->checkbox() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Image</label>
                                    <div id="dropzonejs-example" class="dropzone-box">
                                        <div class="dz-default dz-message">
                                            <i class="fa fa-cloud-upload"></i>
                                            Drop files in
                                            here<br><span class="dz-text-small">or click to pick manually</span>
                                        </div>
                                        <div class="fallback">
                                            <input name="file" type="file" multiple=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
    init.push(function () {
        $('#dropzonejs-example').dropzone({
            url: '//dummy.html',
            paramName: 'file', // The name that will be used to transfer the file
            maxFilesize: 0.5, // MB

            addRemoveLinks : true,
            dictResponseError: 'Can\'t upload file!',
            autoProcessQueue: false,
            thumbnailWidth: 138,
            thumbnailHeight: 120,
            maxFiles: 1,

            previewTemplate: '<div class=\"dz-preview dz-file-preview\"><div class=\"dz-details\"><div class=\"dz-filename\"><span data-dz-name></span></div><div class=\"dz-size\">File size: <span data-dz-size></span></div><div class=\"dz-thumbnail-wrapper\"><div class=\"dz-thumbnail\"><img data-dz-thumbnail><span class=\"dz-nopreview\">No preview</span><div class=\"dz-success-mark\"><i class=\"fa fa-check-circle-o\"></i></div><div class=\"dz-error-mark\"><i class=\"fa fa-times-circle-o\"></i></div><div class=\"dz-error-message\"><span data-dz-errormessage></span></div></div></div></div><div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" data-dz-uploadprogress></div></div></div>',

            resize: function(file) {
                var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                srcRatio = file.width / file.height;
                if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                    info.trgHeight = this.options.thumbnailHeight;
                    info.trgWidth = info.trgHeight * srcRatio;
                    if (info.trgWidth > this.options.thumbnailWidth) {
                        info.trgWidth = this.options.thumbnailWidth;
                        info.trgHeight = info.trgWidth / srcRatio;
                    }
                } else {
                    info.trgHeight = file.height;
                    info.trgWidth = file.width;
                }
                return info;
            }
        });
    });
", $this::POS_END);