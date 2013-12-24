<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'htmlOptions' => array(
		'class' => 'well form-horizontal',
	),
	));
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'documentTemplateFieldId'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentTemplateFieldId', array(
				'size' => 20,
				'maxlength' => 20));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'documentTemplateFieldName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentTemplateFieldName', array(
				'size' => 60,
				'maxlength' => 500));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'status'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'status'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'createDateTime'); ?></label>
		<div class="controls">
			<?php echo $form->textField($model, 'createDateTime'); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">	
			<?php
			echo CHtml::submitButton('ค้นหา', array(
				'class' => 'btn btn-primary'));
			?>
		</div>
	</div>
</fieldset>

<?php $this->endWidget(); ?>
<!-- search-form -->