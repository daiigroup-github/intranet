<?php
$this->breadcrumbs = array(
	'Memos'=>array(
		'index'),
	$model->memoId=>array(
		'view',
		'id'=>$model->memoId),
	'Update',
);
?>

<h1>Update Memo <?php echo $model->memoId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'employeeModel'=>$employeeModel));
?>