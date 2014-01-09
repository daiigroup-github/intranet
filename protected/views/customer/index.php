<?php
$this->pageHeader = 'Customer';
$this->breadcrumb = '<li>Customer<span class="divider">/</span></li>';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button"><i class="icon-search"></i></a>
		<a class="btn" href="<?php echo Yii::app()->createUrl('/customer/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
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
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		'customerId',
		array(
			'header'=>'Customer',
			'value'=>'CHtml::encode($data->customerFnTh." ".$data->customerLnTh)',
		),
		array(
			'header'=>'Company',
			'value'=>'CHtml::encode($data->customerCompany)',
		),
		'email',
		/*
		  'email',
		  'password',
		  'companyValue',
		  'saleId',
		  'engineerId',
		  'branchId',
		  'branchValue',
		  'address',
		  'city',
		  'province',
		  'zipcode',
		  'phone',
		 */
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
