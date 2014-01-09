<?php
$this->breadcrumbs = array(
	'Document Template Fields',
);

$this->menu = array(
	array(
		'label'=>'Create DocumentTemplateField',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage DocumentTemplateField',
		'url'=>array(
			'admin')),
);
?>

<h1>Document Template Fields</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
