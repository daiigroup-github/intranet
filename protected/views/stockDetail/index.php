<?php
$this->breadcrumbs = array(
	'Stock Details' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	//array('label'=>'List StockDetail', 'url'=>array('index')),
	array(
		'label' => 'Create StockDetail',
		'url' => array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('stock-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>การจัดการรายการของ</h1>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn" href="<?php echo Yii::app()->createUrl('/stockDetail/Create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
	</div>
</div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:inline">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'stock-detail-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns' => array(
		'stockDetailCode',
		'stockDetailName',
		array(
			'name' => 'stockDetailUnit',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:7%'),
			'value' => 'CHtml::encode($data->stockDetailUnit)',
		),
		array(
			'name' => 'createDateTime',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:15%'),
			'value' => 'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		array(
			'name' => 'status',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:10%'),
			'value' => 'CHtml::encode($data->status==1 ? "Active":"In Active")',
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{update}{delete}',
		),
	),
));
?>
