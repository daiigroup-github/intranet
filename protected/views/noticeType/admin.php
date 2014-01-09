<?php
$this->breadcrumb = '<li>ประเภทข่าวสาร<span class="divider">/</span></li>';
$this->pageHeader = 'ประเภทข่าวสาร';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notice-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/noticeType/create'); ?>"><i class="icon-plus"></i></a>
	</div>
</div>

<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notice-type-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		//'noticeTypeId',
		'noticeTypeName',
		'noticeTypeCode',
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:17%;'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
