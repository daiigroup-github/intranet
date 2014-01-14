<?php
$this->breadcrumb = '<li>' . CHtml::link('ประกาศ', Yii::app()->createUrl('/notice/admin')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'ประกาศ';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notice-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

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

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/notice/create'); ?>"><i class="icon-plus"></i></a>
	</div>
</div>	

<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'notice-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	//'rowCssClassExpression'=>'($data->status == 1)?"row-open":"row-closed"',
	'columns' => array(
		array(
			'name' => 'imageUrl',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'width:100px;text-align:center'),
			'value' => 'showImage($data->imageUrl)',
		),
		'title',
		'headline',
		'description',
		array(
			'name' => 'employeeId',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:left;width:10%'),
			'value' => 'CHtml::encode(isset($data->employee) ? $data->employee->fnTh." ".$data->employee->lnTh : "-")',
		),
		//'status',
		array(
			'name' => 'noticeTypeId',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:left;width:10%'),
			'value' => 'CHtml::encode(isset($data->noticeType->noticeTypeName) ? $data->noticeType->noticeTypeName : "-")',
		),
		/*
		  'createDateTime',
		  'updateDateTime',
		 */
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>

<?php

function showImage($imageUrl)
{
	$image = "";
	if (!empty($imageUrl) && isset($imageUrl))
	{
		if (strpos($imageUrl, ".pdf"))
		{
			$image = "<p><a class='pdf' Title='$imageUrl' href='$imageUrl'>ดูไฟล์แนบ</a></p>";
		}
		else
		{
			$image = "<p><a class='fancyFrame' Title='$imageUrl' href='$imageUrl'><img src='$imageUrl' width='70px' alt='' /></a></p>";
		}
	}
	return $image;
}
?>
