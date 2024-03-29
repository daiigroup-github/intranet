<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="theme-asphalt main-menu-animated main-navbar-fixed main-menu-fixed <?php echo isset($this->params['bodyCSS'])?$this->params['bodyCSS']:'';?>">
<script>var init = [];</script>
<?php $this->beginBody() ?>
<?php echo $content;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
