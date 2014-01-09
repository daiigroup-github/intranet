<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'well form-horizontal',
	),
	));
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'documentControlDataId'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlDataId', array(
				'size'=>20,
				'maxlength'=>20));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'documentControlDataName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlDataName', array(
				'size'=>60,
				'maxlength'=>100));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'dataModel'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'dataModel', array(
				'size'=>60,
				'maxlength'=>1000));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->label($model, 'dataMethod'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'dataMethod', array(
				'size'=>60,
				'maxlength'=>1000));
			?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<?php
			echo CHtml::submitButton('ค้นหา', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>
</fieldset>

<?php $this->endWidget(); ?>
<!-- search-form -->