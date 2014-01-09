<?php
$this->pageHeader = 'Exam';
$this->breadcrumb = '<li>Exam<span class="divider">/</span></li>';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('exam-title-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/exam/create'); ?>"><i class="icon-plus"></i></a>
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
	'id'=>'exam-title-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		'title',
		'creator',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>