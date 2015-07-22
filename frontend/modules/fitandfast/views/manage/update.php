<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FitfastEmployee */

$this->title = 'Update Fitfast Employee : ' . ' ' . $model->employee->fullThName;
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee->fullThName, 'url' => ['view', 'id' => $model->fitfastEmployeeId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-employee-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
