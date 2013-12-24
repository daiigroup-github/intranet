<?php
$this->breadcrumbs = array(
	'Qtech Process Subs',
);

$this->menu = array(
	array(
		'label' => 'Create QtechProcessSub',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage QtechProcessSub',
		'url' => array(
			'admin')),
);
?>

<h1>Qtech Process Subs</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
