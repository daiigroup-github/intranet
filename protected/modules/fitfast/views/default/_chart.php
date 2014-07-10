<style>
	.chart {
		position: relative;
		display: inline-block;
		width: 265px;
		height: 265px;
		margin-top: 10px;
		margin-bottom: 10px;
		text-align: center;
	}
	.chart canvas {
		position: absolute;
		top: 0;
		left: 0;
	}
	.percent {
		display: inline-block;
		line-height: 265px;
		z-index: 2;
		font-size: 1.8em;
	}
	.percent:after {
		content: '%';
		margin-left: 0.1em;
		font-size: .8em;
	}
</style>

<?php
if($percent > 80)
{
	$lineColor = '#00aa00';
}
else if($percent > 50)
{
	$lineColor = '#ffee00';
}
else
{
	$lineColor = '#ff0000';
}

$id = isset($id) ? $id : '';

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/easypiechart/jquery.easypiechart.min.js');
$cs->registerScript('pie'.$id, "
$(function() {
    //create instance
    $('#chart{$id}').easyPieChart({
        animate: 2000,
		/*onStep: function(from, to, percent) {
			this.el.children[0].innerHTML = Math.round(percent);
		},*/
		size:265,
		barColor:'{$lineColor}',
		lineCap : 'butt',
		lineWidth: 48,
    });
});
");
?>

<div class="chart" id="chart<?php echo $id;?>" data-percent="<?php echo $percent; ?>">
	<p class="percent"><?php echo $percent; ?></p>
</div>
