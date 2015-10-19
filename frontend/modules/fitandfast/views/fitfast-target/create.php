<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\fitfastTarget */

$this->title = 'Create Fitfast Target';
$this->params['breadcrumbs'][] = ['label' => 'Fitfast Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-target-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
