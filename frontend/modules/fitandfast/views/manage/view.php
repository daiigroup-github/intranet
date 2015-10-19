<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use frontend\assets\FancyBoxAsset;

/* @var $this yii\web\View */
/* @var $model frontend\models\FitfastEmployee */

$this->title = $model->employee->fnTh . ' ' . $model->employee->lnTh;
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
FancyBoxAsset::register($this);
?>
<div class="fitfast-employee-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title"><?= $this->title ?> :: <?= $model->forYear ?></span>

            <div class="panel-heading-controls">
                <?php /*
                <?= Html::a('Update', ['update', 'id' => $model->fitfastEmployeeId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->fitfastEmployeeId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            */ ?>
                <?= Html::a('<i class="fa fa-plus"></i> Fit and Fast', ['create-fitfast', 'id' => $model->fitfastEmployeeId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
            </div>
            <!-- / .panel-heading-controls -->
        </div>
        <!-- / .panel-heading -->
        <div class="panel-body">
            <?php /*=DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'fitfastEmployeeId',
                    'status',
                    'createDateTime',
                    'updateDateTime',
                    'employeeId',
                    'halfS',
                    'S',
                    'SS',
                    'F',
                    'forYear',
                    'percent',
                ],
            ])*/ ?>

            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <th>s</th>
                    <th>S</th>
                    <th>SS</th>
                    <th>F</th>
                    <th>%</th>
                </tr>
                <tr>
                    <td><?= $model->halfS ?></td>
                    <td><?= $model->S ?></td>
                    <td><?= $model->SS ?></td>
                    <td><?= $model->F ?></td>
                    <td><?= number_format($model->percent, 2) ?></td>
                </tr>
            </table>

            <?php
            /**
             *
             * <div class="panel colourable">
             * <div class="panel-heading">
             * <span class="panel-title">Fit and Fast Items</span>
             * </div>
             * <!-- / .panel-heading -->
             * <div class="panel-body">
             * <?= GridView::widget([
             * 'layout' => "{summary}\n{items}\n{pager}\n",
             * 'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getFitfasts()]),
             * 'pager' => [
             * 'options' => ['class' => 'pagination pagination-xs']
             * ],
             * 'options' => [
             * 'class' => 'table-light'
             * ],
             * 'columns' => [
             * ['class' => 'yii\grid\SerialColumn'],
             *
             * 'title',
             * [
             * 'attribute' => 'halfS',
             * 'label' => 's',
             * ],
             * 'S',
             * 'SS',
             * 'F',
             * ['class' => 'yii\grid\ActionColumn'],
             * ],
             * ]); ?>
             * </div>
             * </div>
             */
            ?>

            <?php foreach ($model->fitfasts as $fitfast): ?>
                <div class="panel colourable">
                    <div class="panel-heading">
                        <?= $fitfast->title ?>
                        <div class="panel-heading-controls">
                            <?= Html::a('<i class="fa fa-plus"></i> Target', ['create-fitfast-target', 'id' => $fitfast->fitfastId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <th>s</th>
                                <th>S</th>
                                <th>SS</th>
                                <th>F</th>
                            </tr>
                            <tr>
                                <td><?= $fitfast->halfS ?></td>
                                <td><?= $fitfast->S ?></td>
                                <td><?= $fitfast->SS ?></td>
                                <td><?= $fitfast->F ?></td>
                            </tr>
                        </table>

                        <?= GridView::widget([
                            'layout' => "{summary}\n{items}\n{pager}\n",
                            'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $fitfast->getFitfastTargets()->andWhere('status=1')]),
                            'pager' => [
                                'options' => ['class' => 'pagination pagination-xs']
                            ],
                            'options' => [
                                'class' => 'table-light'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'target',
                                [
                                    'attribute' => 'month',
                                    'value' => function ($model) {
                                        return $model->getMonthText($model->month);
                                    }
                                ],
                                [
                                    'attribute' => 'file',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model->file) {
                                            //file url
                                            return Html::a('View File', [$model->file], ['rel' => 'fancyboxPDF', 'class' => 'fancyBoxPDF']);
//                                                    return $model->file;
                                        } else {
                                            //upload file
                                            return ($model->grade==0) ? Html::fileInput('file[' . $model->fitfastTargetId . ']') : '-';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'grade',
                                    'value' => function ($model) {
                                        return $model->gradeText;
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
//                                    'template'=>'{view} {update} {delete}',
                                    'template' => '{update}',
                                    'buttons' => [
//                                        'view' => function($url, $model) {
//                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', \yii\helpers\Url::to(['/fitandfast/manage/view-fitfast-target', 'id'=>$model->fitfastTargetId]));
//                                        },
                                        'update' => function ($url, $model) {
                                            return ($model->grade == 0) ?Html::a('<span class="glyphicon glyphicon-pencil"></span>', \yii\helpers\Url::to(['/fitandfast/manage/update-fitfast-target', 'id' => $model->fitfastTargetId])) : '';
                                        }
                                    ]
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
