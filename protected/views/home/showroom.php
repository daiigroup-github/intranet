<?php
//$this->pageHeader = "Home";
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>

<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails">
			<li class="span12">
				<p>
					<?php for ($i = 1; $i < 906; $i++): ?>
						<?php
						$seq = str_pad($i, 4, '0', STR_PAD_LEFT);
						?>

						<?php $imageName = $baseUrl . "/images/sportDay2013/" . $seq . ".jpg"; ?>
						<?php $imageThumbName = $baseUrl . "/images/sportDay2013/thumbnail/" . $seq . ".jpg"; ?>
						<a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?php echo $imageName; ?>" ><img  height="100px" src="<?php echo $imageThumbName; ?>" alt="" /></a>
						<?php endfor; ?>
				</p>
			</li>
		</ul>
	</div>
</div>