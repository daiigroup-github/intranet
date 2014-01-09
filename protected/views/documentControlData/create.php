<?php
$this->breadcrumb = '<li>' . CHtml::link('Document Control Datas', Yii::app()->createUrl('/documentControlData')) . '<span class="divider">/</span></li>
					<li>Create</li>';
$this->pageHeader = 'Create Document Control Datas';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'documentControlDataItem'=>$documentControlDataItem));
?>