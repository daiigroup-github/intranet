<?php
$this->breadcrumbs = array(
	'Notices' => array(
		'index'),
	$model->title,
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


/* $this->menu=array(
  array('label'=>'List Notice', 'url'=>array('index')),
  array('label'=>'Create Notice', 'url'=>array('create')),
  array('label'=>'Update Notice', 'url'=>array('update', 'id'=>$model->noticeId)),
  array('label'=>'Delete Notice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->noticeId),'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>'Manage Notice', 'url'=>array('admin')),
  ); */
?>

<h1 style="text-align:center"><?php echo $model->noticeType->noticeTypeName; ?></h1>
<p></p>
<hr></hr>
<h2 style="color:blue;text-align:center"><?php echo $model->title; ?></h2>
<p>
	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'attributes' => array(
			'headline',
			//'description',
			//'imageUrl',
			array(
				'name' => 'imageUrl',
				'type' => 'raw',
				'htmlOptions' => array(
					'style' => 'text-align:center;display:none'),
				'value' => showImage($model->imageUrl, $model->title),
			),
			array(
				'name' => 'description',
				'type' => 'raw',
				'htmlOptions' => array(
					'style' => 'text-align:center;width:10%'),
				'value' => $model->description,
			),
			array(
				'name' => 'employeeId',
				'type' => 'raw',
				'htmlOptions' => array(
					'style' => 'text-align:center;width:10%'),
				'value' => $model->employee->fnTh . " " . $model->employee->lnTh,
			),
			//'status',
			//'noticeTypeId',
			array(
				'name' => 'createDateTime',
				'type' => 'raw',
				'htmlOptions' => array(
					'style' => 'text-align:center;width:17%;'),
				'value' => ($model->createDateTime) ? Controller::dateThai($model->createDateTime, 2) : "-",
			),
		//'updateDateTime',
		),
	));
	?>
</p>
<?php

function showImage($imageUrl, $title)
{
	$image = "";
	if (!empty($imageUrl) && isset($imageUrl))
	{
		if (strpos($imageUrl, ".pdf"))
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

