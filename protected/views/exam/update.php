<?php
/* @var $this ExamController */
/* @var $model ExamTitle */

$this->breadcrumbs = array(
	'Exam Titles' => array(
		'index'),
	$model->examId => array(
		'view',
		'id' => $model->examId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List ExamTitle',
		'url' => array(
			'index')),
	array(
		'label' => 'Create ExamTitle',
		'url' => array(
			'create')),
	array(
		'label' => 'View ExamTitle',
		'url' => array(
			'view',
			'id' => $model->examId)),
	array(
		'label' => 'Manage ExamTitle',
		'url' => array(
			'admin')),
);
?>

<h1>Update ExamTitle <?php echo $model->examId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>