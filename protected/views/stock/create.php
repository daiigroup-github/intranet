<?php
$this->breadcrumb = '<li>' . CHtml::link('คลังอุปกรณ์สำนักงาน', Yii::app()->createUrl('/stock')) . '<span class="divider">/</span></li>
					<li>Create</li>';
$this->pageHeader = 'การจัดการคลังอุปกรณ์สำนักงาน';
?>

<h1>Create Stock</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>