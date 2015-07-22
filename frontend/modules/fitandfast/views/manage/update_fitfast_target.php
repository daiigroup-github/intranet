<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\fitfastTarget */

$this->title = $fitfastTargetModel->fitfast->title;
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $fitfastTargetModel->employee->fullThName, 'url' => ['view', 'id' => $fitfastTargetModel->fitfast->fitfastEmployee->fitfastEmployeeId]];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = ['label' => 'Fitfast Targets', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $fitfastTargetModel->fitfastTargetId, 'url' => ['view', 'id' => $fitfastTargetModel->fitfastTargetId]];
//$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);

$disabled = ($fitfastTargetModel->grade == 0) ? false : true;
?>
<div class="fitfast-target-update">

    <?= $this->render('_form_fitfast_target', [
        'fitfastTargetModel' => $fitfastTargetModel,
        'title' => Html::encode($this->title),
        'disabled' => $disabled
    ]) ?>

</div>
