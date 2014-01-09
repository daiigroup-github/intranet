<?php
$this->breadcrumb = '<li>' . CHtml::link('พนักงาน', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'แก้ไขข้อมูลพนักงาน : ' . strtoupper($model->username);
?>
<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>