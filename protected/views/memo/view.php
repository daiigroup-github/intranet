<?php
$this->breadcrumbs = array(
	'Memos'=>array(
		'index'),
	$model->memoId,
);
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
<h1><?php echo $model->subject; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'subject',
		array(
			'name'=>'detail',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:10%'),
			'value'=>$model->detail,
		),
		array(
			'name'=>'image',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;display:none'),
			'value'=>showImage($model->image, $model->subject),
		),
		'createBy',
		'createDateTime',
	),
));
?>

<?php
if(isset($memoToList))
{
	echo "<h3>รายการพนักงานที่ส่งถึง</h3>";
	echo "<hr>";
	foreach($memoToList as $memoTo)
	{
		echo "<div class='row'>";
		echo "<div class='span2'>";
		echo "</div>";
		echo "<div class='span2'>";
		echo $memoTo->employee->fnTh . " " . $memoTo->employee->lnTh . " (" . $memoTo->employee->username . ")";
		echo "</div>";
		echo "<div class='span2'>";
		if($memoTo->status == 1)
		{
			echo "ยังไม่อ่าน";
		}
		else
		{
			echo "อ่านแล้ว";
		}
		echo "</div>";
		if(isset($memoTo->updateDateTime))
		{
			echo "<div class='span2'>";
			echo "เมื่อ " . $memoTo->updateDateTime;
			echo "</div>";
		}
		echo "</div>";
		echo "<hr>";
	}
}

function showImage($imageUrl, $title)
{
	$image = "";
	if(!empty($imageUrl) && isset($imageUrl))
	{
		if(strpos($imageUrl, ".pdf"))
		{
			$image = "<p><a class='pdf' Title='$title' href='$imageUrl'>ดูไฟล์แนบ</a></p>";
		}
		else
		{
			$image = "<p><a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='200px' alt='' /></a></p>";
		}
	}
	return $image;
}
?>
