<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */

$this->title = 'Update Employee: ' . ' ' . $model->employeeId;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employeeId, 'url' => ['view', 'id' => $model->employeeId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="employee-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
