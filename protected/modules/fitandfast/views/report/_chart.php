<?php
//options
$size = 0;
$lineWidth = 0;

switch ($span) {
    case 2:
        $lineWidth = 28;
        $size = 165;
        break;
    default:
        $lineWidth = 48;
        $size = 265;
}
?>

<?php
if ($percent > 80) {
    $lineColor = '#00aa00';
} else if ($percent > 50) {
    $lineColor = '#ffee00';
} else {
    $lineColor = '#ff0000';
}

$id = isset($id) ? $id : '';

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/easypiechart/jquery.easypiechart.min.js');
$cs->registerScript('pie' . $id, "
$(function() {
    //create instance
    $('#chart{$id}').easyPieChart({
        animate: 2000,
		/*onStep: function(from, to, percent) {
			this.el.children[0].innerHTML = Math.round(percent);
		},*/
		size:{$size},
		barColor:'{$lineColor}',
		lineCap : 'butt',
		lineWidth: {$lineWidth},
    });
});
");
$cs->registerCSSFile($baseUrl . "/css/chart{$span}.css");
?>

    <div class="chart" id="chart<?php echo $id; ?>" data-percent="<?php echo $percent; ?>">
        <p class="percent"><?php echo $percent; ?></p>
    </div>

<?php if (isset($grades)): ?>
    <?php if ($grades !== array()): ?>
        <p style="text-align: center;">
        <?php foreach ($grades as $k => $v): ?>
            <span id="<?php echo $k; ?>" class="label <?php echo ($k == 'F') ? 'label-important' : 'label-success' ?>"><?php echo $v . $k ?></span>
        <?php endforeach; ?>
        </p>
    <?php else: ?>
        <p style="text-align: center;">
            <span id="s" class="label label-success">0s</span>
            <span id="S" class="label label-success">0S</span>
            <span id="SS" class="label label-success">0SS</span>
            <span id="F" class="label label-important">0F</span>
        </p>
    <?php endif; ?>
<?php endif; ?>