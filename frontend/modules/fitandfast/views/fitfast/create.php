<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Fitfast */

$this->title = 'Create Fitfast';
$this->params['breadcrumbs'][] = ['label' => 'Fitfasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="fitfast-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
