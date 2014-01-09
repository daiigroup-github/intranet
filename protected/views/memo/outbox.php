<?php
$this->breadcrumbs = array(
	'Memos'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Memo',
		'url'=>array(
			'index')
	),
	array(
		'label'=>'Create Memo',
		'url'=>array(
			'create')
	),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('memo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Memo ถาดออก</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/memo/create'); ?>"><i class="icon-plus"></i><i class="icon-tags"></i></a>
	</div>
</div>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));  ?>
<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'memo-grid',
	'dataProvider'=>$model->searchOutbox(Yii::app()->user->id),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		'subject',
		/*
		  array(
		  'name' => 'detail',
		  'type' => 'html',
		  'htmlOptions' =>array('style'=>'text-align:left'),
		  'value' => 'isset($data->detail)?$data->detail:"-"',

		  ), */
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:20%'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} ',
		),
	),
));
?>
