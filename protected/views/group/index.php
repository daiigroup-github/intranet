<?php
$this->breadcrumb = '<li>Groups<span class="divider">/</span></li>';
$this->pageHeader = 'Manage Groups';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/group/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
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
	'id' => 'group-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'groupName',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>
