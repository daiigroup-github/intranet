<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Fitfast */

$this->title = 'Create Fitfast Target';
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $fitfastModel->employee->fullThName, 'url' => ['view', 'id' => $fitfastModel->fitfastEmployeeId]];

$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$disabled = false;
?>
<div class="fitfast-create">

    <?php if(isset($err) && !empty($err)):?>
        <p class="alert"><?=$err?></p>
    <?php endif;?>

    <?= $this->render('_form_fitfast_target', [
        'fitfastModel' => $fitfastModel,
        'fitfastTargetModel' => $fitfastTargetModel,
        'title' => Html::encode($fitfastModel->title),
        'disabled'=>$disabled
    ]) ?>

</div>
