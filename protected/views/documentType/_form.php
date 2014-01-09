<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'document-type-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal')
	));
?>

<p class="note">
	Fields with <span class="required">*</span> are required.
	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class'=>'alert alert-error'));
	$form->error($model, 'status');
	$form->error($model, 'documentTypeName');
	$form->error($model, 'documentCodePrefix');
	$form->error($model, 'itemTable');
	$form->error($model, 'transactionTable');
	$form->error($model, 'workflowGroupId');
	$form->error($model, 'groupId');
	?>
</p>

<fieldset>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentTypeName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentTypeName', array(
				'size'=>60,
				'maxlength'=>500));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentTypeDescription'); ?></label>
		<div class="controls">
			<?php
			echo $form->textArea($model, 'documentTypeDescription', array(
				'size'=>150,
				'maxlength'=>3000));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'documentCodePrefix'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'documentCodePrefix', array(
				'size'=>5,
				'maxlength'=>5));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'itemTable'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'itemTable', array(
				'size'=>200,
				'maxlength'=>200));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'transactionTable'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'transactionTable', array(
				'size'=>200,
				'maxlength'=>200));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'workflowGroupId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'workflowGroupId', WorkflowGroup::model()->getAllWorkflowGroup(), array(
				'ajax'=>array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('DocumentType/GetStateByWorkflowGroup'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					//'update'=>"#DocumentTemplate_editState, #DocumentTemplate_items_editState ", //selector to update
					'update'=>".editState", //selector to update
					'data'=>array(
						'groupId'=>'js:this.value'),
				//leave out the data key to pass all form values through
				),
				'id'=>'DocumentType_workflowGroupId',
				'class'=>'input-medium',
			));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'groupId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'groupId', Group::model()->getAllGroup(), array(
				'class'=>'input-medium'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'customView'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'customView', array(
				'size'=>200,
				'maxlength'=>200));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'customAction'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'customAction', array(
				'size'=>80,
				'maxlength'=>80));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'inMobile'); ?></label>
		<div class="controls">
			<?php echo $form->checkBox($model, 'inMobile'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'status'); ?></label>
		<div class="controls">
			<?php echo $form->checkBox($model, 'status'); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'companyDivisionId'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'companyDivisionId', CompanyDivision::model()->getAllCompanyDivision(), array(
				'class'=>'input-medium'));
			?>
		</div>
	</div>
	<div>
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</fieldset>
<hr>

<h3>ฟิลด์ของเอกสาร</h3>

<?php
if(count($model->documentTemplate) > 0)
{
	?>
	<?php
	$i = 0;
	foreach($model->documentTemplate as $docTemplate)
	{
		if(!$docTemplate->isItem)
		{
			?>
			<div class="alert alert-success">
				<div class="row-fluid">
					<div class="span2">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate->documentTemplateField, 'documentTemplateFieldName', array(
								'font-color'=>'red'));
						}

						echo $docTemplate->documentTemplateField->documentTemplateFieldName;
						?>
					</div>
					<div class="span2">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate->documentControlType, 'documentControlTypeName');
						}
						echo $form->dropDownList($docTemplate, 'documentControlTypeId', DocumentControlType::getAllDocumentControlType(), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldDocumentControlTypeId][' . $docTemplate->id . ']'));
						?>
					</div>
					<div class="span2">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'documentControlDataId');
						}
						echo $form->dropDownList($docTemplate, 'documentControlDataId', DocumentControlData::getAllDocumentControlData(), array(
							'class'=>'input-small',
							'prompt'=>"เลือก",
							'name'=>'DocumentTemplate[oldDocumentControlDataId][' . $docTemplate->id . ']'));
						/* if (isset($docTemplate->documentControlData))
						  {
						  echo $form->dropDownList($docTemplate, 'documentControlDataId', DocumentControlData::getAllDocumentControlData(), array('class'=>'input-small','prompt'=>"เลือก",'name'=>'DocumentTemplate[oldDocumentControlDataId]['.$docTemplate->id.']'));
						  }
						  else
						  {
						  echo "-";
						  } */
						?>
					</div>
					<div class="span1">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'fieldType');
						}
						echo $form->dropDownList($docTemplate, 'fieldType', array(
							"1"=>"Normal",
							"2"=>"Require"), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldFieldType][' . $docTemplate->id . ']'
						));
						?>
					</div>
					<div class="span3">
						<?php
						echo $form->labelEx($docTemplate, 'editState');
						$ids = explode(",", $docTemplate->editState);

						foreach($ids as $id)
						{
							echo Workflow::model()->getNameById($id) . "</br>";
						}

						echo $form->dropDownList($docTemplate, 'editState', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
							'class'=>'input-large editState',
							'name'=>'DocumentTemplate[oldEditState][' . $docTemplate->id . ']',
							'multiple'=>'multiple'
						));

						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'addState');
						}

						$ids = explode(",", $docTemplate->addState);

						foreach($ids as $id)
						{
							echo Workflow::model()->getNameById($id) . "</br>";
						}

						echo $form->dropDownList($docTemplate, 'addState', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
							'class'=>'input-large editState',
							'name'=>'DocumentTemplate[oldAddState][' . $docTemplate->id . ']',
							'multiple'=>'multiple'
						));
						?>
					</div>
					<div class="span2">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'status');
						}

						echo $form->dropDownList($docTemplate, 'status', array(
							"1"=>"Active",
							"0"=>"Non Active"), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldStatus][' . $docTemplate->id . ']'
						));
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
?>

<?php
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
	)
));
?>
<div class="well copy1">
	<div class="row-fluid">
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'documentTemplateFieldId'); ?>
			<div id="Field">
				<?php
				echo $form->dropDownList($documentTemplate, 'documentTemplateFieldId[]', DocumentTemplateField::getAllDocumentTemplateField(), array(
					'class'=>'input-small'));
				?>
				<div id="FieldDialog"></div>
			</div>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'documentControlTypeId'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'documentControlTypeId[]', DocumentControlType::getAllDocumentControlType(), array(
				'class'=>'input-small'));
			?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'documentControlDataId'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'documentControlDataId[]', DocumentControlData::getAllDocumentControlData(), array(
				'class'=>'input-small',
				'prompt'=>"เลือก"));
			?>
		</div>
		<div class="span1">
			<?php echo $form->labelEx($documentTemplate, 'fieldType'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'fieldType[]', array(
				"1"=>"Normal",
				"2"=>"Require"), array(
				'class'=>'input-small'));
			?>

		</div>
		<div class="span3">
			<?php echo $form->labelEx($documentTemplate, 'editState'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'editState[][]', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
				'class'=>'input-large editState',
				'multiple'=>'multiple'));
			?>

			<?php echo $form->labelEx($documentTemplate, 'addState'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'addState[][]', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
				'class'=>'input-large editState',
				'multiple'=>'multiple'));
			?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'status'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'status[' . $documentTemplate->id . ']', array(
				"1"=>"Active",
				"0"=>"Non Active"), array(
				'class'=>'input-small'));
			?>

		</div>
	</div>
</div>
<a id="copyFieldLink" href="#" rel=".copy1" class="btn"><i class="icon-plus"></i></a>

<p style="margin-top: 10px">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class'=>'btn btn-primary'));
	?>
</p>
<hr />

<h3>Item ของเอกสาร</h3>

<?php
if(count($model->documentTemplate) > 0)
{
	$i = 0;
	foreach($model->documentTemplate as $docTemplate)
	{
		if($docTemplate->isItem)
		{
			?>
			<div class="alert alert-info">
				<div class="row-fluid">
					<div class="span2">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate->documentTemplateField, 'documentTemplateFieldName', array(
								'font-color'=>'red'));
						}

						echo $docTemplate->documentTemplateField->documentTemplateFieldName;
						?>
					</div>
					<div class="span3">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate->documentControlType, 'documentControlTypeName');
						}
						echo $form->dropDownList($docTemplate, 'documentControlTypeId', DocumentControlType::getAllDocumentControlType(), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldDocumentControlTypeId][' . $docTemplate->id . ']'));
						?>

						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'documentControlDataId');
						}
						echo $form->dropDownList($docTemplate, 'documentControlDataId', DocumentControlData::getAllDocumentControlData(), array(
							'class'=>'input-small',
							'prompt'=>"เลือก",
							'name'=>'DocumentTemplate[oldDocumentControlDataId][' . $docTemplate->id . ']'));
						/* if (isset($docTemplate->documentControlData))
						  {
						  echo $form->dropDownList($docTemplate, 'documentControlDataId', DocumentControlData::getAllDocumentControlData(), array('class'=>'input-small','prompt'=>"เลือก",'name'=>'DocumentTemplate[oldDocumentControlDataId]['.$docTemplate->id.']'));
						  }
						  else
						  {
						  echo "-";
						  } */
						?>
					</div>
					<div class="span2">
						<?php echo $form->labelEx($docTemplate, 'documentItemField'); ?>
						<?php
						if(isset($docTemplate->documentItemField) || !empty($docTemplate->documentItemField))
						{
							echo $docTemplate->documentItemField;
						}
						else
						{
							echo "-";
						}
						?>
					</div>
					<div class="span1">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'fieldType');
						}

						echo $form->dropDownList($docTemplate, 'fieldType', array(
							"1"=>"Normal",
							"2"=>"Require",), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldFieldType][' . $docTemplate->id . ']'));
						?>
					</div>
					<div class="span3">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'editState');
						}

						$ids = explode(",", $docTemplate->editState);

						foreach($ids as $id)
						{
							echo Workflow::model()->getNameById($id) . "</br>";
						}

						echo $form->dropDownList($docTemplate, 'editState', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
							'class'=>'input-large  editState',
							'name'=>'DocumentTemplate[oldEditState][' . $docTemplate->id . ']',
							'multiple'=>'multiple'));

						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'addState');
						}

						$ids = explode(",", $docTemplate->addState);

						foreach($ids as $id)
						{
							echo Workflow::model()->getNameById($id) . "</br>";
						}

						echo $form->dropDownList($docTemplate, 'addState', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
							'class'=>'input-large  editState',
							'name'=>'DocumentTemplate[oldAddState][' . $docTemplate->id . ']',
							'multiple'=>'multiple'));
						?>

					</div>
					<div class="span1">
						<?php
						if($i == 0)
						{
							echo $form->labelEx($docTemplate, 'status');
						}

						echo $form->dropDownList($docTemplate, 'status', array(
							"1"=>"Active",
							"0"=>"Non Active"), array(
							'class'=>'input-small',
							'name'=>'DocumentTemplate[oldStatus][' . $docTemplate->id . ']'));
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
?>

<?php
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	'id'=>'copyItemLink',
	'removeText'=>'<button class="btn btn-danger"><i class="icon-minus icon-white"></i></button>',
	'removeHtmlOptions'=>array(
		'style'=>'color:red'),
	'options'=>array(
		'copyClass'=>'newcopy',
		'limit'=>0,
		'clearInputs'=>true,
		'excludeSelector'=>'.skipcopy',
	)
));
?>
<div class="well copy">
	<div class="row-fluid">
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'documentTemplateFieldId'); ?>
			<div id="Field">
				<?php
				echo $form->dropDownList($documentTemplate, 'items[documentTemplateFieldId][]', DocumentTemplateField::getAllDocumentTemplateField(), array(
					'class'=>'input-small'));
				?>
			</div>
		</div>
		<div class="span3">
			<?php echo $form->labelEx($documentTemplate, 'documentControlTypeId'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[documentControlTypeId][]', DocumentControlType::getAllDocumentControlType(), array(
				'class'=>'input-small'));
			?>

			<?php echo $form->labelEx($documentTemplate, 'documentControlDataId'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[documentControlDataId][]', DocumentControlData::getAllDocumentControlData(), array(
				'class'=>'input-small',
				'prompt'=>"เลือก"));
			?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($documentTemplate, 'documentItemField'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[documentItemField][]', DocumentItem::model()->getAllDocumentItemField(), array(
				'class'=>'input-small'));
			?>
		</div>
		<div class="span1">
			<?php echo $form->labelEx($documentTemplate, 'fieldType'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[fieldType][]', array(
				"1"=>"Normal",
				"2"=>"Require",
				), array(
				'class'=>'input-mini'));
			?>
		</div>
		<div class="span3">
			<?php echo $form->labelEx($documentTemplate, 'editState'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[editState][]', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
				'class'=>'input-large  editState',
				'multiple'=>'multiple'));
			?>
			<?php echo $form->labelEx($documentTemplate, 'addState'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[addState][]', WorkflowState::model()->getWorkflowByWorkflowGroupId($model->workflowGroupId), array(
				'class'=>'input-large  editState',
				'multiple'=>'multiple'));
			?>
		</div>
		<div class="span1">
			<?php echo $form->labelEx($documentTemplate, 'status'); ?>
			<?php
			echo $form->dropDownList($documentTemplate, 'items[status][' . $documentTemplate->id . ']', array(
				"1"=>"Active",
				"0"=>"Non Active"), array(
				'class'=>'input-mini'));
			?>
		</div>
	</div>
</div>
<a id="copyItemLink" href="#" rel=".copy" class="btn"><i class="icon-plus"></i></a>

<div class="form-actions">
	<?php
	echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
		'class'=>'btn btn-primary'));
	?>
</div>

<?php $this->endWidget(); ?>
<!-- form -->