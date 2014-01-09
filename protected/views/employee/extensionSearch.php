<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions'=>array(
			'class'=>'form-inline well',
		),
	));
	?>
	<?php
	echo $form->textField($model, 'searchText', array(
		'class'=>'input-small',
		'placeholder'=>'Search'));
	?>
	<?php
	echo $form->dropDownList($model, 'companyId', Company::model()->getAllCompanyHaveEmployee(), array(
		'class'=>'input-medium'));
	?>
	<?php
	echo $form->dropDownList($model, 'companyDivisionId', CompanyDivision::model()->getAllCompanyDivision(), array(
		'class'=>'input-medium'));
	?>
	<?php
	echo $form->dropDownList($model, 'branchId', Branch::model()->getAllBranch(), array(
		'class'=>'input-medium'));
	?>
	<?php
	echo $form->hiddenField($model, 'status', array(
		'value'=>1));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>
</div><!-- search-form -->