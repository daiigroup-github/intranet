<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'document-control-data-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'class' => 'form-horizontal'
	),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class' => 'alert alert-error'));
$form->error($model, 'documentControlDataName');
$form->error($model, 'dataModel');
$form->error($model, 'dataMethod');
?>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentControlDataName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentControlDataName', array(
				'size' => 60,
				'maxlength' => 100));
			?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'dataModel'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'dataModel', array(
				'size' => 60,
				'maxlength' => 1000));
			?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'dataMethod'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'dataMethod', array(
				'size' => 60,
				'maxlength' => 1000));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fieldId'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'fieldId', array(
				'size' => 60,
				'maxlength' => 200));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fieldValue'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'fieldValue', array(
				'size' => 60,
				'maxlength' => 200));
			?>
		</div>
	</div>
</fieldset>

<hr>

<h3>Document Control Item</h3>
<?php
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	'id' => 'copylink',
	'removeText' => '<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
	'removeHtmlOptions' => array(
		'style' => 'color:red'),
	'options' => array(
		'copyClass' => 'newcopy',
		'limit' => 0,
		'clearInputs' => true,
		'excludeSelector' => '.skipcopy',
	)
));

if (isset($documentControlDataItemOld))
{
	foreach ($documentControlDataItemOld as $item)
	{
		echo "<div class='control-group'>";
		echo '<div class="controls">';
		echo $form->textField($item, "documentControlDataItemUseId", array(
			'name' => "documentControlDataItem[update][documentControlDataItemUseId][$item->documentControlDataItemId]",
			'size' => 60,
			'maxlength' => 500,
			'placeHolder' => 'id'));
		echo $form->textField($item, "documentControlDataItemValue", array(
			'name' => "documentControlDataItem[update][documentControlDataItemValue][$item->documentControlDataItemId]",
			'size' => 60,
			'maxlength' => 500,
			'placeHolder' => 'value'));
		echo "</div></div>";
	}
}
?>
<fieldset>
	<div class="control-group copy">
		<label class="control-label">Item(s)</label>
		<div class="controls">
			<?php
			echo $form->textField($documentControlDataItem, 'documentControlDataItemUseId[]', array(
				'size' => 60,
				'maxlength' => 500,
				'placeHolder' => 'id'));
			?>
			<?php
			echo $form->textField($documentControlDataItem, 'documentControlDataItemValue[]', array(
				'size' => 60,
				'maxlength' => 500,
				'placeHolder' => 'value'));
			?>
			<a id="copylink" href="#" rel=".copy" class="btn"><i class="icon-plus"></i></a>
		</div>
	</div>

</fieldset>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class' => 'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->