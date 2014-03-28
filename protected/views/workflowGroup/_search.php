<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array(
		'class' => 'form-horizontal well')
	));
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'workflowGroupId'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowGroupId', array(
				'size' => 20,
				'maxlength' => 20));
			?>
		</div>
	</div>	
	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'workflowGroupName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'workflowGroupName', array(
				'size' => 60,
				'maxlength' => 80));
			?>
		</div>
	</div>	
	<div class="control-group">
		<div class="controls">
			<?php
			echo CHtml::submitButton('Search', array(
				'class' => 'btn btn-primary'));
			?>
		</div>
	</div>	
</fieldset>

<?php $this->endWidget(); ?>
<!-- search-form -->