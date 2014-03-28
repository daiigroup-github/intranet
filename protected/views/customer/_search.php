<div class= "form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
		'htmlOptions' => array(
			'class' => 'form-inline well',
		),
	));
	?>

	<?php
	echo $form->textField($model, 'searchText', array(
		'class' => 'input-small',
		'placeholder' => 'Search'));
	?>
	<?php
	echo $form->dropDownList($model, 'companyId', Company::model()->getAllCompany(), array(
		'class' => 'input-medium'));
	?>
	<?php //echo $form->dropDownList($model, 'saleId', Employee::model()->getAllSale(), array('class'=>'input-small'));  ?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->