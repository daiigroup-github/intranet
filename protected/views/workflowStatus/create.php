<?php

$this->breadcrumb = '<li>' . CHtml::link('Workflow Status', Yii::app()->createUrl('/workflowStatus')) . '<span class="divider">/</span></li>
					<li>Create</li>';
$this->pageHeader = 'Create Workflow Status';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>