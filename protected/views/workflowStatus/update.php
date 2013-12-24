<?php

$this->breadcrumb = '<li>' . CHtml::link('Workflow Status', Yii::app()->createUrl('/workflowStatus')) . '<span class="divider">/</span></li>
					<li>Update</li>';
$this->pageHeader = 'Workflows Status : ' . $model->workflowStatusId;
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>