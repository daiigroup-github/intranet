<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fitfast Employees';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-employee-index">

    <p>
        <?= Html::a('Create Fitfast Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel">
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

//					'fitfastEmployeeId',
//					'status',
//					'createDateTime',
//					'updateDateTime',
//					'employeeId',
                    [
                        'attribute' => 'employeeId',
                        'label' => 'Employee',
                        'value' => function ($model) {
                            return $model->employee->fnTh . ' ' . $model->employee->lnTh;
                        }
                    ],
                    [
                        'attribute' => 'forYear',
                        'filter' => $modelSearch->getAllYears(),
                    ],
                    [
                        'attribute' => 'halfS',
                        'label' => 's',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'S',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'SS',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'F',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'percent',
                        'filter' => false,
                        'value' => function ($model) {
                            return number_format($model->percent, 2);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
