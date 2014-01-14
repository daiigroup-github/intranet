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
		<label class="control-label"><?php echo $form->label($model, 'documentControlTypeId'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlTypeId', array(
				'size' => 20,
				'maxlength' => 20));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'documentControlTypeName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlTypeName', array(
				'size' => 60,
				'maxlength' => 100));
			?>
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