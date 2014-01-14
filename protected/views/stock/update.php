<?php

$this->breadcrumb = '<li>' . CHtml::link('คลังอุปกรณ์สำนักงาน', Yii::app()->createUrl('/stock')) . '<span class="divider">/</span></li>
					<li>Update</li>';
$this->pageHeader = 'การจัดการคลังอุปกรณ์สำนักงาน : ' . $model->stockId;
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>