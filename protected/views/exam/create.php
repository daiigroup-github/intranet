<?php

$this->pageHeader = 'สร้างแบบทดสอบ';
$this->breadcrumb = '<li>' . CHtml::link('แบบทดสอบ', Yii::app()->createUrl('/exam')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>สร้างแบบทดสอบ</li>';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model,
	'examQuestionModel' => $examQuestionModel,
	'examChoiceModel' => $examChoiceModel));
?>