<?php
$this->breadcrumb = '<li>' . CHtml::link('Groups', Yii::app()->createUrl('/group')) . '<span class="divider">/</span></li>
					<li>Update</li>';
$this->pageHeader = 'Update Group : ' . $model->groupName;
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'employeeModel'=>$employeeModel,
	'groupMemberModel'=>$groupMemberModel));
?>