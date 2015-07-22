<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->params['pageHeader'] = $title;
$this->params['breadcrumbs'][] = ['label' => $title];
?>
<div class="panel">
    <div class="panel-heading">
        <?= $title ?>
    </div>
    <div class="panel-body">
        <div class="row">​​​
            <?php foreach ($fitfastEmployees as $fitfastEmployee): ?>
                <div class="col-md-4 col-sm-6">
                    <?= $this->renderFile('@app/themes/pixel-admin/layouts/_fitandfast_panel.php', ['fitandfast' => $fitfastEmployee]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
