<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */

$this->breadcrumbs = array(
	'Elearning Exam Questions'=>array(
		'index'),
	$model->title,
);

$this->menu = array(
	array(
		'label'=>'List ElearningExamQuestion',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ElearningExamQuestion',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update ElearningExamQuestion',
		'url'=>array(
			'update',
			'id'=>$model->questionId)),
	array(
		'label'=>'Delete ElearningExamQuestion',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->questionId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage ElearningExamQuestion',
		'url'=>array(
			'admin')),
);
?>

<h1>View ElearningExamQuestion #<?php echo $model->questionId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'questionId',
		'status',
		'title',
		'description:html',
		'elearningId',
	),
));
?>


<div class="page-header">
	<h3>Choices</h3>
</div>
<?php foreach($model->choice as $choiceModel): ?>
	<div class="alert <?php echo ($choiceModel->isCorrect) ? 'alert-success' : ''; ?>">
		<dl class="dl-horizontal">
			<dt>Title</dt>
			<dd><?php echo $choiceModel->title; ?></dd>

			<dt>Description</dt>
			<dd><?php echo $choiceModel->description; ?></dd>
		</dl>
	</div>
<?php endforeach; ?>