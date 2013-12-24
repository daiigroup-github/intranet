<?php

$this->breadcrumb = '<li>' . CHtml::link('Workflow Status', Yii::app()->request->urlReferrer) . '<span class="divider">/</span></li>';
$this->pageHeader = 'View Workflow Status #' . $model->workflowStatusId;
?>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'workflowStatusId',
		'workflowStatusName',
	),
));
?>
