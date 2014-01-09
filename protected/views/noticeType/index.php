<?php
$this->breadcrumbs = array(
	'Notice Types',
);

$this->menu = array(
	array(
		'label'=>'Create NoticeType',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage NoticeType',
		'url'=>array(
			'admin')),
);
?>

<h1>Notice Types</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
