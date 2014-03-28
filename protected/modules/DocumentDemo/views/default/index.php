<?php
$this->breadcrumb = '<li>Documents<span class="divider">/</span></li>';
$this->pageHeader = 'Documents';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('document-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="search-form" style="display:block">
	<?php
	$this->renderPartial('_search', array(
		'model' => $model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'document-grid',
	'dataProvider' => $model->search(),
	//'filter'=>$model,
	// 'htmlOptions'=>array(
	// 'class'=>'span10 offset1',
	// ),
	'itemsCssClass' => 'table table-striped table-bordered table-condensed',
	'columns' => array(
		'documentTypeName',
		array(
			'class' => 'CButtonColumn',
			'header' => 'Action',
			'template' => '{New}',
			'buttons' => array(
				'New' => array(
					'url' => 'Yii::app()->createUrl("DocumentDemo/default/newDocument?documentTypeId=".$data->documentTypeId)',
				),
			),
			'htmlOptions' => array(
				'style' => 'width:120px;text-align:center;',
			),
		),
	),
));
?>
	