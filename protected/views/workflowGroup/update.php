<?php
$this->breadcrumb = '<li>' . CHtml::link('Workflow Groups', Yii::app()->createUrl('/workflowGroup')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Update<span class="divider">/</span></li>';
$this->pageHeader = 'Update Workflow Group';
?>
<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'workflowStateModel'=>$workflowStateModel,
	'workflowStatusModel'=>$workflowStatusModel));
?>