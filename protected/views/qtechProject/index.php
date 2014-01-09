<?php
// $this->breadcrumbs=array(
// 'Qtech Projects'=>array('index'),
// );
//
// $this->menu=array(
// array('label'=>'List QtechProject', 'url'=>array('index')),
// array('label'=>'Create QtechProject', 'url'=>array('create')),
// );

$this->breadcrumb = '<li>Qtech Projects<span class="divider">/</span></li>';
$this->pageHeader = 'Qtech Project';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('qtech-project-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn search-button pull-right"><i class="icon-search"></i></a>
		<a class="btn pull-right" href="<?php echo Yii::app()->createUrl('/qtechProject/create'); ?>"><i class="icon-plus"></i></a>
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
	'id'=>'qtech-project-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'Customer',
			'value'=>'CHtml::encode($data->customer->customerFnTh." ".$data->customer->customerLnTh)',
		),
		'projectName',
		array(
			'header'=>'Action',
			'class'=>'CButtonColumn',
			'htmlOptions'=>array(
				'style'=>'width:120px;text-align:center;'
			),
		),
	),
));
?>
