<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Fitfast */

$this->title = 'Create Fitfast';
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $fitfastEmployeeModel->employee->fullThName, 'url' => ['view', 'id' => $fitfastEmployeeModel->fitfastEmployeeId]];

$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-create">

    <?= $this->render('_form_fitfast', [
        'fitfastModel' => $fitfastModel,
        'fitfastTargetModel' => $fitfastTargetModel,
        'fitfastEmployeeModel'=>$fitfastEmployeeModel,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
