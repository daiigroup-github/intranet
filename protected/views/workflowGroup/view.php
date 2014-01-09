<?php
$this->breadcrumb = '<li>' . CHtml::link('Workflow Group', Yii::app()->request->urlReferrer) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Workflow Groups';
?>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'workflowGroupId',
		'workflowGroupName',
	),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'workflow-state-grid',
	'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'summaryText'=>'',
	'columns'=>array(
		//'workflowStateId',
		'workflowStateName',
		array(
			'name'=>'currentState',
			'value'=>'CHtml::encode(isset($data->workflowCurrent->workflowName)?$data->workflowCurrent->workflowName : "-")',
		),
		array(
			'name'=>'nextState',
			'value'=>'CHtml::encode(($data->workflowNext)?$data->workflowNext->workflowName:"-")',
		),
		array(
			'name'=>'workflowStatusId',
			'value'=>'CHtml::encode($data->workflowStatus->workflowStatusName)',
		),
		array(
			'name'=>'requireConfirm',
			'value'=>'CHtml::encode($data->requireConfirm)',
		),
	//'workflowGroupId',
	//array('class'=>'CButtonColumn',),
	),
));
?>
