<?php
$this->breadcrumb = '<li>' . CHtml::link('พนักงาน', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'ใบสมัครงาน';
?>


<?php
if($citizenFlag)
{
	echo $this->renderPartial('_form', array(
		'model'=>$model));
}
else
{
	echo $this->renderPartial('_formCheckId', array(
		'model'=>$model,
		'citizenFlag'=>$citizenFlag));
}
?>