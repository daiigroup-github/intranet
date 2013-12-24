<?php
$this->breadcrumb = '<li>พนักงาน<span class="divider">/</span></li>';
$this->pageHeader = 'พนักงาน';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<!-- <a class="btn search-button"><i class="icon-search"></i></a> -->
		<a class="btn" href="<?php echo Yii::app()->createUrl('/employee/create'); ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
	</div>
</div>		

<div class="search-form" style="display:inline">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	// 'htmlOptions'=>array(
	// 'class'=>'span10 offset1',
	// ),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'employeeCode',
		array(
			'name' => 'fnTh',
			'value' => 'CHtml::encode($data->fnTh." ".$data->lnTh)',
		),
		array(
			'name' => 'position',
			'value' => 'CHtml::encode($data->position)',
			'filter' => false,
		),
		array(
			'class' => 'CButtonColumn',
			'header' => 'Action',
			'template' => '{view}{update}',
// 				'buttons'=>array(
// 					'Mileage'=>array(
// 						'url'=>'Yii::app()->createUrl("employee/mileage", array("id"=>$data->employeeId))',
// 					),
// 				),
			'htmlOptions' => array(
				'style' => 'width:120px;text-align:center;',
			),
		),
	),
));
?>
	