<?php

$this->breadcrumb = '<li>' . CHtml::link('Workflow Groups', Yii::app()->createUrl('/workflowGroup')) . '<span class="divider">/</span></li>
					<li>Create<span class="divider">/</span></li>';
$this->pageHeader = 'Create Workflow Group';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model,
	'workflowStateModel' => $workflowStateModel,
	'workflowStatusModel' => $workflowStatusModel));
?>