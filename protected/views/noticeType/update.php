<?php
$this->breadcrumbs = array(
	'Notice Types'=>array(
		'index'),
	$model->noticeTypeId=>array(
		'view',
		'id'=>$model->noticeTypeId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List NoticeType',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create NoticeType',
		'url'=>array(
			'create')),
	array(
		'label'=>'View NoticeType',
		'url'=>array(
			'view',
			'id'=>$model->noticeTypeId)),
	array(
		'label'=>'Manage NoticeType',
		'url'=>array(
			'admin')),
);
?>

<h1>Update NoticeType <?php echo $model->noticeTypeId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>