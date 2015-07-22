<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FitfastEmployee */

$this->title = 'Create Fitfast Employee';
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-employee-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
