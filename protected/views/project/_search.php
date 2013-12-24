<div class="wide form">

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
	echo $form->textField($model, 'projectName', array(
		'size' => 60,
		'maxlength' => 100,
		'placeHolder' => 'ชื่อโปรเจ็ค'));
	?>
	<?php
	echo $form->dropdownList($model, 'customerId', Customer::model()->getAllCustomer(), array(
		'prompt' => '...ลูกค้า...'));
	?>
	<?php //echo $form->textField($model,'status'); ?>
	<?php //echo $form->textField($model,'createDateTime');  ?>
	<?php //echo $form->textField($model,'productCatId',array('size'=>10,'maxlength'=>10)); ?>
	<?php //echo $form->textField($model,'productValue',array('size'=>10,'maxlength'=>10));   ?>

	<?php //echo $form->textField($model,'projectDetail',array('size'=>60,'maxlength'=>255)); ?>
	<?php //echo $form->textField($model,'projectPrice');  ?>
	<?php //echo $form->textField($model,'projectImageName',array('size'=>60,'maxlength'=>255)); ?>
	<?php //echo $form->textField($model,'projectAddress',array('size'=>60,'maxlength'=>255));  ?>

	<?php //echo $form->textField($model,'engineerId',array('size'=>10,'maxlength'=>10)); ?>
	<?php //echo $form->textField($model,'saleId',array('size'=>10,'maxlength'=>10)); ?>
	<?php //echo $form->textField($model,'startDate');  ?>
	<?php //echo $form->textField($model,'endDate'); ?>
	<?php //echo $form->textField($model,'latitude',array('size'=>20,'maxlength'=>20));  ?>
	<?php //echo $form->textField($model,'longitude',array('size'=>20,'maxlength'=>20));   ?>
	<?php //echo $form->textField($model,'branchValue',array('size'=>10,'maxlength'=>10));  ?>
	<?php echo CHtml::submitButton('ค้นหา'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->