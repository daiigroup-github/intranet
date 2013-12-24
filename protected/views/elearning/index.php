<?php
/* @var $this ElearningController */
/* @var $model Elearning */

$this->breadcrumbs = array(
	'Elearnings' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label' => 'List Elearning',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Elearning',
		'url' => array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
	$('#elearning-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>
	Manage Elearnings

	<?php
	echo CHtml::link('<i class="icon-plus"></i> เพิ่มรายการ', Yii::app()->createUrl('elearning/create'), array(
		'class' => 'btn btn-primary pull-right',
	));
	?>
</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php
$this->renderPartial('_search', array(
	'model' => $model,
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'elearning-grid',
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'itemsCssClass' => 'table table-striped table-bordered',
	'columns' => array(
		'title',
		'numberOfQuestion',
	  	'parentId',
		array(
			'class' => 'CButtonColumn',
		),
	),
));
?>
