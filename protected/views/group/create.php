<?php

$this->breadcrumb = '<li>' . CHtml::link('Groups', Yii::app()->createUrl('/group')) . '<span class="divider">/</span></li>
					<li>Create</li>';
$this->pageHeader = 'Create Group';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model,
	'employeeModel' => $employeeModel,
	'groupMemberModel' => $groupMemberModel));
?>