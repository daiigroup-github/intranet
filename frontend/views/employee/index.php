<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="employee-index">

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>

    <div class="panel">
        <?php /*
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id' => 'employee-search',
                'method' => 'get',
                'options' => ['class' => 'form-inline'],
                'fieldConfig' => ['template' => '{input}']
            ]); ?>
            <?= $form->field($model, 'searchText', ['inputOptions' => ['class' => 'form-control', 'placeholder' => 'Search Text']]) ?>
            <?= $form->field($model, 'status')->dropDownList($model->employeeStatus, ['class' => 'form-control', 'prompt' => 'All']) ?>
            <?= Html::submitButton('<i class="fa fa-search"></i>&nbsp;Search', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>
        </div>
        */?>

        <div class="panel-body">

            <?= GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'filterModel' => $modelSearch,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => \yii\grid\DataColumn::className(),
                        'format' => 'text',
                        'label' => 'ชื่อ-สกุล',
                        'attribute' => 'fnTh',
                        'value' => function ($model) {
                            return $model->fnTh . ' ' . $model->lnTh . ' (' . $model->username . ')';
                        }
                    ],
                    'employeeCode',
                    [
                        'attribute' => 'companyId',
                        'filter' => \frontend\models\Company::getAllCompany(),
                        'value' => function ($model) {
                            return $model->company->companyNameTh;
                        }
                    ],
                    [
                        'attribute' => 'branchId',
                        'filter' => \frontend\models\Branch::getAllBranch(),
                        'value' => function ($model) {
                            return $model->branch->branchName;
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => $model->getEmployeeStatus(),
                        'value'=>function($model) {
                            return $model->employeeStatusText;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ]
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>

