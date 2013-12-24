<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
		'htmlOptions' => array(
			'class' => 'well form-inline'
		),
	));
	?>

	<?php
	echo $form->textField($model, 'workflowStatusName', array(
		'placeholder' => 'Workflow Status Name',
		'class' => 'input-medium'));
	?>
	<?php echo CHtml::submitButton('Search'); ?>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->