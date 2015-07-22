<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fitfasts';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-index">

    
    <p>
        <?= Html::a('Create Fitfast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel">
        <div class="panel-body">
            <?= GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

					'fitfastId',
					'status',
					'createDateTime',
					'updateDateTime',
					'fitfastEmployeeId',
					// 'employeeId',
					// 'title:ntext',
					// 'description:ntext',
					// 'type',
					// 'halfS',
					// 'S',
					// 'SS',
					// 'F',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
