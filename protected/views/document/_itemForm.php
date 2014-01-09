<h3>เพิ่มรายการ</h3>

<?php
Yii::import('ext.jqrelcopy.JQRelcopy');
echo $form->hiddenField($model, 'documentTypeId');

$datePickerConfig = array(
	'name'=>'datePicker',
	'options'=>array(
		'showAnim'=>'fold',
		'dateFormat'=>'yy-mm-dd')
);

$this->widget('ext.jqrelcopy.JQRelcopy', array(
	'id'=>'copyFieldLink',
	'removeText'=>'<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
	'removeHtmlOptions'=>array(
		'style'=>'color:red'),
	'options'=>array(
		'copyClass'=>'newcopy',
		'limit'=>0,
		'clearInputs'=>true,
		'excludeSelector'=>'.skipcopy',
	),
	'jsAfterNewId'=>JQRelcopy::afterNewIdDatePicker($datePickerConfig),
));

/* if (count($documentType->documentTemplate) > 0)
  { */
?>

<div class="copy1 well">
	<?php
	foreach($documentType->documentTemplate as $template)
	{
		$editState = explode(",", $template->editState);
		if($template->status && $template->isItem)
		{
			if(!in_array("-1", $editState))
			{
				$templateName = $template->documentTemplateField->documentTemplateFieldName;

				echo '<div class="control-group">';
				echo '<label class="control-label">' . $templateName . '</label>';
				if($template->fieldType == 2)
				{
					echo '<label class="text-error">*</label>';
				}
				echo '<div class="controls">';
				echo $form->hiddenField(DocumentItem::model(), 'documentTemplateFieldId[]', array(
					'class'=>'input-small',
					'value'=>$template->documentTemplateFieldId
				));

				if($template->documentControlType->documentControlTypeName != 'date')
					$this->selectControlType(DocumentItem::model(), $form, $template->documentItemField, $template);
				else
				{
					$datePickerConfig['htmlOptions'] = array(
						'name'=>get_class(DocumentItem::model()) . '[' . $template->documentItemField . '][]');
					$this->widget('zii.widgets.jui.CJuiDatePicker', $datePickerConfig);
				}
				echo $form->hiddenField(DocumentItem::model(), "isRequire[$template->documentItemField][]", array(
					'value'=>$template->fieldType));

				echo $form->error(DocumentItem::model(), 'control');
				echo '</div>';
				echo '</div>';
			}
			else
			{
				echo '<div class="control-group">';
				echo '<div class="controls">';
				echo $form->hiddenField(DocumentItem::model(), 'documentTemplateFieldId[]', array(
					'class'=>'input-small',
					'value'=>$template->documentTemplateFieldId
				));
				echo $form->error(DocumentItem::model(), 'control');
				echo '</div>';
				echo '</div>';
			}
		}
	}
	?>

</div>
<?php
echo '<a id="copyFieldLink" href="#" rel=".copy1" class="btn"><i class="icon-plus"></i>เพิ่มรายการ</a>';
?>

<hr />
<?php
//}
?>