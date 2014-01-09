<?php
// $this->breadcrumbs=array(
// 	'Workflows'=>array('index'),
// 	$model->workflowId,
// );
// $this->menu=array(
// 	array('label'=>'List Workflow', 'url'=>array('index')),
// 	array('label'=>'Create Workflow', 'url'=>array('create')),
// 	array('label'=>'Update Workflow', 'url'=>array('update', 'id'=>$model->workflowId)),
// 	array('label'=>'Delete Workflow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->workflowId),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Workflow', 'url'=>array('admin')),
// );
$this->breadcrumb = '<li>' . CHtml::link('Workflow', Yii::app()->createUrl('/workflow')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>View</li>';
$this->pageHeader = 'Workflow : ' . $model->workflowName;
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/workflow/update/' . $model->workflowId); ?>"><i class="icon-edit icon-white"></i> Update</a>
	</div>
</div>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-bordered table-striped table-condensed'),
	'attributes'=>array(
		array(
			'name'=>'Employee',
			'value'=>isset($model->employee->username) ? $model->employee->username : '',
		),
		'groupId',
	),
));
?>
