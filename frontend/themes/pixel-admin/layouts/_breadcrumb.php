<?php
use yii\widgets\Breadcrumbs;
//use frontend\assets\AppAsset;
//AppAsset::register($this);
?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'options'=>['class'=>'breadcrumb breadcrumb-page']
]) ?>