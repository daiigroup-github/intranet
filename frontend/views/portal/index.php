<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->params['pageHeader'] = 'Daii Group Portal'
?>
<div class="page-header text-center">
    <h1>Daii Group PCL. Protal</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a('<i class="fa fa-sign-in"></i> เข้าระบบ', 'signin', ['class'=>'btn btn-primary btn-lg btn-block']);?>
    </div>
</div>

<br />

<div class="row">
    <?php foreach ($webs as $k=>$web):?>
        <?php
        $img = strtolower(implode('', explode(' ', $k)));
        ?>
    <div class="col-md-4">
        <div class="panel panel-success panel-dark">
            <div class="panel-heading"><?= $k?></div>
            <div class="panel-body">
                <?= Html::a(Html::img(\yii\helpers\BaseUrl::base().'/images/webs/'.$img.'.jpg', ['class'=>'img-rounded']), 'http://'.$web, ['class'=>'thumbnail']);?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
