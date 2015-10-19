<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

?>
<?php $this->beginContent('@app/themes/pixel-admin/layouts/main.php'); ?>
<div class="container">
    <?php echo $content; ?>
</div>

<?php $this->registerJs("
init.push(function () {
            // Javascript code here
        })
        window.PixelAdmin.start(init);
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
