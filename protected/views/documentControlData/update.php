<?php
$this->breadcrumb = '<li>' . CHtml::link('Document Control Datas', Yii::app()->createUrl('/documentControlData')) . '<span class="divider">/</span></li>
					<li>Update</li>';
$this->pageHeader = 'Update Document Control Datas : ' . $model->documentControlDataId;
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'documentControlDataItem'=>$documentControlDataItem,
	'documentControlDataItemOld'=>$documentControlDataItemOld));
?>