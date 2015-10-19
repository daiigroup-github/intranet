<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\fitfastTarget */

$this->title = 'Update Fitfast Target: ' . ' ' . $model->fitfastTargetId;
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fitfastTargetId, 'url' => ['view', 'id' => $model->fitfastTargetId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-target-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
