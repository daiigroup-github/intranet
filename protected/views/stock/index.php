<?php
$this->breadcrumb = '<li>' . CHtml::link('คลังอุปกรณ์สำนักงาน', Yii::app()->createUrl('/stock')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'การจัดการคลังอุปกรณ์สำนักงาน';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('stock-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn" href="<?php echo Yii::app()->createUrl('/stock/create'); ?>"><i class="icon-plus"></i></a>
	</div>
</div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:inline">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'stock-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'รายการอุปกรณ์สำนักงาน',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:20%'),
			'value'=>'CHtml::encode($data->stockDetail->stockDetailName)',
		),
		array(
			'name'=>'บริษัท',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:30%'),
			'value'=>'CHtml::encode($data->company->companyNameTh)',
		),
		array(
			'name'=>'จำนวนเริ่มต้น',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:7%'),
			//'value' => 'CHtml::encode($data->company->companyNameTh)',
			'value'=>'CHtml::encode(StockTransaction::model()->sumInitialStock($data->stockId))',
		),
		array(
			'name'=>'stockQuantity',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:right;width:10%'),
			'value'=>'CHtml::encode(number_format($data->stockQuantity))',
		),
		array(
			'name'=>'stockUnitPrice',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:right;width:7%'),
			'value'=>'CHtml::encode(number_format($data->stockUnitPrice,2))',
		),
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:17%;'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
		/*
		  'updateDateTime',
		  'active',
		 */
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
