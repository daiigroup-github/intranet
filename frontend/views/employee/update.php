<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */

$this->title = 'Update: ' . ' ' . $model->fullThName;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullThName, 'url' => ['view', 'id' => $model->employeeId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = $this->title;
?>
<div class="employee-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
