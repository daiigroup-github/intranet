<?php
$this->pageHeader = 'Customer Create';
$this->breadcrumb = '<li>' . CHtml::link('Customer', Yii::app()->request->urlReferrer) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Create<span class="divider">/</span></li>';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'customerSale'=>$customerSale));
?>