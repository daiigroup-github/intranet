<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

?>
<?php $this->beginContent('@app/themes/pixel-admin/layouts/main.php'); ?>
<div id="main-wrapper">

    <?php echo $this->render('_main_navigation'); ?>

    <?php echo $this->render('_main_menu'); ?>

    <div id="content-wrapper">
        <?php echo $this->render('_breadcrumb'); ?>
        <?php echo $this->render('_header'); ?>

        <?php echo $content; ?>
    </div>
    <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div>

<?php $this->registerJs("
    init.push(function () {
        // set equalize height for stat panel
        var setEqHeight = function () {
            $('#content-wrapper .row').each(function () {
                var \$p = $(this).find('.stat-panel');
                if (! \$p.length) return;
                \$p.attr('style', '');
                var h = \$p.first().height(), max_h = h;
                \$p.each(function () {
                    h = $(this).height();
                    if (max_h < h) max_h = h;
                });
                \$p.css('height', max_h);
            });
        };

        setEqHeight();
        $(window).on('pa.resize', setEqHeight);
        $(window).resize();
    })
    window.PixelAdmin.start(init);
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
