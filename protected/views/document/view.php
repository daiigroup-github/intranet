<?php
$this->breadcrumb = '<li>' . CHtml::link('Document', Yii::app()->createUrl('/document')) . '<span class="divider">/</span></li>';
$this->pageHeader = $model->documentType->documentTypeName . ' : #' . $model->documentCode;

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal',
	)
	));
?>
<?php
if(isset($_GET["errorMsg"]))
	$errorMsg = $_GET["errorMsg"];

if(isset($errorMsg) && !empty($errorMsg))
{
	if($errorMsg == "errorConfirm")
	{
		echo "<p style='color:red;font-size:16px'>รหัสยืนยันไม่ถูกต้อง</p>";
	}
	if($errorMsg == "errorWorkflowStatus")
	{
		echo "<p style='color:red;font-size:16px'>กรุณาระบุการดำเนินการ</p>";
	}
}
?>
<?php
echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
	'class'=>'alert alert-error'));
?>

<!-- Document Items -->
<h3>สร้างโดย : <?php echo $model->employee->fnTh . ' ' . $model->employee->lnTh . '(' . $model->employee->username . ')'; ?> <small><?php echo $this->dateThai($model->createDateTime, 1); ?></small></h3>
<h5>บริษัท : <?php echo $model->employee->company->companyNameTh; ?> | สาขา : <?php echo $model->employee->branch->branchName; ?> | ฝ่าย : <?php echo $model->employee->division->description; ?>  </h5>
<?php
echo $form->hiddenField($documentWorkflowModel, "currentState", array(
	'name'=>'previousState'));

if($model->documentDocumentTemplateField)
{
	$fieldName = array(
		);
	$fieldValue = array(
		);
	$fieldValue2 = array(
		);
	$fieldValue3 = array(
		);
	foreach($model->documentDocumentTemplateField as $item)
	{
		$template = DocumentTemplate::model()->find("documentTypeId=:documentTypeId AND documentTemplateFieldId=:documentTemplateFieldId AND status = :status AND isItem = 0", array(
			':documentTypeId'=>$model->documentTypeId,
			':documentTemplateFieldId'=>$item->documentTemplateFieldId,
			':status'=>'1'));

		if(!isset($currentWorkflowState->workflowCurrent))
		{ // ตรวจสอบว่าเป็น แบบร่างรึมั้ย
			if($documentWorkflowModel->isFinished == 1)
			{ // ตรวจสอบว่าเอกสาร จบการทำงานรึยัง
				$canEdit = false;
			}
			else
			{
				$canEdit = true;
			}
		}
		else
		{
			//ตรวจสอบว่าสามารถแก้ไขฟิลด์ได้รึเป่า
			if(isset($template->editState))
			{
				$canEdit = Workflow::model()->checkCanEditState($currentWorkflowState->workflowCurrent->workflowId, $template->editState, $model->documentId);
			}
			else
			{
				$canEdit = false;
			}

			if(isset($_REQUEST["device"]))
			{
				if($_REQUEST["device"] == "mobile")
				{
					$canedit = false;
				}
			}
		}
		if(isset($template->documentControlType))
		{
			if($template->documentControlType->documentControlTypeName == "file")
			{
				$fieldName[] = $item->documentTemplateField->documentTemplateFieldName;
				$fiName = $item->documentTemplateField->documentTemplateFieldName;
				if(!empty($item->value))
				{
					if(strpos($item->value, ".pdf"))
					{ //ถ้าเป็น pdf ให้ fancy box โหลด class pdf แทน
						$fieldValue[] = "<a class='pdf' Title='$fiName' href='$item->value'>ดูไฟล์แนบ</a> ";
					}
					else
					{
						$fieldValue[] = "<a class='fancyFrame' Title='$fiName' href='$item->value'><img src='$item->value' width='50px' alt='' /></a> ";
					}
					$fieldValue3[] = $form->hiddenField($item, "value", array(
						'name'=>"DocumentDocumentTemplateField[oldFieldFile][$item->id]"));
				}
				else
				{
					$fieldValue[] = '-';
					$fieldValue3[] = $form->hiddenField($item, "value", array(
						'name'=>"DocumentDocumentTemplateField[value][$item->id]",
						'value'=>null));
				}
				if($canEdit == 1)
				{
					$fieldValue2[] = CHtml::activeFileField($item, "value", array(
							'class'=>'input-small',
							'name'=>"DocumentDocumentTemplateField[value][$item->id]"));
				}
				else
				{
					$fieldValue2[] = "";
				}
			}
			else if($template->documentControlType->documentControlTypeName == "link")
			{
				$fieldName[] = "Link";
				$result = DocumentTemplate::model()->find("documentTemplateFieldId =:documentTemplateFieldId AND documentTypeId =:documentTypeId AND isItem = 0", array(
					":documentTemplateFieldId"=>$item->documentTemplateFieldId,
					":documentTypeId"=>$model->documentTypeId));
				if(isset($result->documentControlData))
				{
					$link = $result->documentControlData->dataModel . "/" . $result->documentControlData->dataMethod . "/" . $model->employeeId;
					$fieldValue[] = CHtml::link("ดูข้อมูล", array(
							$link), array(
							'target'=>'_blank'));
					;
				}
				else
				{
					$fieldValue[] = "-";
				}
			}
			else
			{
				$fieldName[] = $item->documentTemplateField->documentTemplateFieldName . ": ";

				if(!$canEdit)
				{
					$result = DocumentTemplate::model()->find("documentTemplateFieldId =:documentTemplateFieldId AND documentTypeId =:documentTypeId AND isItem = 0", array(
						":documentTemplateFieldId"=>$item->documentTemplateFieldId,
						":documentTypeId"=>$model->documentTypeId));


					if(isset($result->documentControlData))
					{
						$dataItem = DocumentControlDataItem::model()->find("documentControlDataItemId =:documentControlDataItemId", array(
							":documentControlDataItemId"=>$item->value));

						if(isset($dataItem->documentControlDataItemValue))
						{
							$fieldValue[] = $dataItem->documentControlDataItemValue;
						}
						else
						{
							$fieldValue[] = "-";
						}
					}
					else
					{
						$fieldValue[] = $item->value;
					}
				}
				else
				{
					$result = DocumentTemplate::model()->find("documentTemplateFieldId =:documentTemplateFieldId AND documentTypeId =:documentTypeId AND isItem = 0", array(
						":documentTemplateFieldId"=>$item->documentTemplateFieldId,
						":documentTypeId"=>$model->documentTypeId));

					if($result->documentControlDataId != 0)
					{
						$dataItems = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
							":documentControlDataId"=>$result->documentControlDataId));
						$w = array(
							);
						foreach($dataItems as $dataItem)
						{
							$w[$dataItem->documentControlDataItemId] = $dataItem->documentControlDataItemValue;
						}
						$fieldValue[] = $form->dropDownList($item, "value", $w, array(
							'name'=>"DocumentDocumentTemplateField[value][$item->id]"));
					}
					else
					{
						$fieldValue[] = $form->textField($item, "value", array(
							'name'=>"DocumentDocumentTemplateField[value][$item->id]"));
					}
				}
			}
		}

		/* if($canEdit)
		  {
		  echo '<div class="control-group alert">';
		  echo '<label class="control-label">'.$fieldName.'</label>';
		  echo '<div class="controls">';
		  echo $fieldValue;
		  echo '</div>';
		  echo '</div>';
		  }
		  else
		  {
		  echo '<dl class="dl-horizontal">';
		  echo '<dt>'.$fieldName.'</dt>';
		  echo '<dd>'.$fieldValue.'</dd>';
		  echo '</dl>';
		  } */
	}
	echo $this->showDocumentField($canEdit, $fieldName, $fieldValue, $fieldValue2, $fieldValue3);
	echo '<hr />';
}

if($model->documentItem)
{
	echo "<h3>รายการของเอกสาร</h3>";

	//Add line of Items
	$fieldName = array(
		);
	$fieldValue = array(
		);
	$itemField = array(
		);
	$i = 0;

	foreach($model->documentItem as $k=> $v)
	{
		if($v->status != 0)
		{
			$itemField[$i]['fieldValue2'][] = null;
			$canEdit = null;
			if(!isset($currentWorkflowState->workflowCurrent))
			{
				if($documentWorkflowModel->isFinished == 1)
				{
					$canEdit = false;
				}
				else
				{
					$canEdit = true;
				}
			}
			if(isset($_REQUEST["device"]))
			{
				if($_REQUEST["device"] == "mobile")
				{
					$canEdit = false;
				}
			}
			/* else
			  {
			  $canEdit = Workflow::model()->checkCanEditState($currentWorkflowState->workflowCurrent->workflowId, $template->editState, $model->documentId);
			  } */
			if(!isset($canEdit))
			{
				$flag1 = $this->checkCanEditItemField($model, "documentItemName", $currentWorkflowState);
			}
			if(!isset($flag1))
			{
				$flag1 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "documentItemName", $v->documentItemName, $flag1);
			$itemName = $v->documentItemName;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}

			//$itemField[$i]['fieldValue'][] = ((!$flag1) ? $itemName : $form->textField($v, "documentItemName", array('name' => "DocumentItem[update][documentItemNameNew][$v->documentItemId]"))).$form->hiddenField($v, "documentItemName", array("name" => "DocumentItem[update][documentItemName][$v->documentItemId]"));
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"documentItemName"));

			if(isset($v->documentItemName) && !empty($v->documentItemName))
			{
				$itemField[$i]['canEdit'][] = $flag1;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "documentItemName");
				$itemField[$i]['fieldValue'][] = ((!$flag1) ? $itemName : $this->selectItemControlType($v, $form, "documentItemName", "DocumentItem[update][documentItemNameNew][$v->documentItemId]", $template)) . $form->hiddenField($v, "documentItemName", array(
						"name"=>"DocumentItem[update][documentItemName][$v->documentItemId]"));
			}

			if(!isset($canEdit))
			{
				$flag2 = $this->checkCanEditItemField($model, "file", $currentWorkflowState);
			}
			if(!isset($flag2))
			{
				$flag2 = $canEdit;
			}

			if(isset($v->file) && !empty($v->file))
			{
				$itemField[$i]['canEdit'][] = $flag2;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "file");

				$className = (strpos($v->file, ".pdf")) ? "pdf" : $className = "fancyFrame";
				$viewImage = "";
				if($className == "pdf")
				{
					$viewImage = "ดูไฟล์แนบ";
				}
				else
				{
					$viewImage = "<img src='$v->file' width='500px' alt='' />";
				}
				$itemField[$i]['fieldValue'][] = "<a class='$className' Title='' href='$v->file'>$viewImage</a>" . $form->hiddenField($v, "file", array(
						"name"=>"DocumentItem[update][oldFile][$v->documentItemId]"));

				if($flag2)
				{
					$itemField[$i]['fieldValue2'][] = CHtml::activeFileField($v, "file", array(
							'class'=>'input-small',
							'name'=>"DocumentItem[update][file][$v->documentItemId]"));
				}
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "file");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "file");
					$itemField[$i]['fieldValue'][] = "-";
					if($flag2)
					{
						$itemField[$i]['fieldValue2'][] = CHtml::activeFileField($v, "file", array(
								'class'=>'input-small',
								'name'=>"DocumentItem[update][file][$v->documentItemId]"));
					}
				}
			}

			if(!isset($canEdit))
			{
				$flag3 = $this->checkCanEditItemField($model, "description", $currentWorkflowState);
			}
			if(!isset($flag3))
			{
				$flag3 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "description", $v->description, $flag3);
			$itemName = $v->description;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}

			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"description"));
			if(isset($v->description) && !empty($v->description))
			{

				$itemField[$i]['canEdit'][] = $flag3;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description");
				$itemField[$i]['fieldValue'][] = ((!$flag3) ? $itemName : $this->selectItemControlType($v, $form, "description", "DocumentItem[update][description][$v->documentItemId]", $template)) . $form->hiddenField($v, "description", array(
						"name"=>"DocumentItem[update][oldDescription][$v->documentItemId]"));
				//$itemField[$i]['fieldValue'][] = ((!$flag3) ? $v->description : $form->textField($v, "description", array('name' => "DocumentItem[update][description][$v->documentItemId]"))).$form->hiddenField($v, "description", array("name" => "DocumentItem[update][oldDescription][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "description");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description");
					//$itemField[$i]['fieldValue'][] = ((!$flag3) ? $v->description : $form->textField($v, "description", array('name' => "DocumentItem[update][description][$v->documentItemId]"))).$form->hiddenField($v, "description", array("name" => "DocumentItem[update][oldDescription][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag3) ? $itemName : $this->selectItemControlType($v, $form, "description", "DocumentItem[update][description][$v->documentItemId]", $template)) . $form->hiddenField($v, "description", array(
							"name"=>"DocumentItem[update][oldDescription][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag4 = $this->checkCanEditItemField($model, "remark", $currentWorkflowState);
			}
			if(!isset($flag4))
			{
				$flag4 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "remark", $v->remark, $flag4);
			$itemName = $v->remark;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"remark"));
			if(isset($v->remark) && !empty($v->remark))
			{
				$itemField[$i]['canEdit'][] = $flag4;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "remark");
				$itemField[$i]['fieldValue'][] = ((!$flag4) ? $itemName : $this->selectItemControlType($v, $form, "remark", "DocumentItem[update][remark][$v->documentItemId]", $template)) . $form->hiddenField($v, "remark", array(
						"name"=>"DocumentItem[update][oldRemark][$v->documentItemId]"));
				//$itemField[$i]['fieldValue'][] = ((!$flag4) ? $v->remark : $form->textField($v, "remark", array('name' => "DocumentItem[update][remark][$v->documentItemId]"))).$form->hiddenField($v, "remark", array("name" => "DocumentItem[update][oldRemark][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "remark");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "remark");
					//$itemField[$i]['fieldValue'][] = ((!$flag4) ? $v->remark : $form->textField($v, "remark", array('name' => "DocumentItem[update][remark][$v->documentItemId]"))).$form->hiddenField($v, "remark", array("name" => "DocumentItem[update][oldRemark][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag4) ? $itemName : $this->selectItemControlType($v, $form, "remark", "DocumentItem[update][remark][$v->documentItemId]", $template)) . $form->hiddenField($v, "remark", array(
							"name"=>"DocumentItem[update][oldRemark][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag5 = $this->checkCanEditItemField($model, "id", $currentWorkflowState);
			}
			if(!isset($flag5))
			{
				$flag5 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "id", $v->id, $flag5);
			$itemName = $v->id;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"id"));
			if(isset($v->id) && !empty($v->id))
			{

				$itemField[$i]['canEdit'][] = $flag5;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "id");
				//$itemField[$i]['fieldValue'][] = ((!$flag5) ? $v->id : $form->textField($v, "id", array('name' => "DocumentItem[update][id][$v->documentItemId]"))).$form->hiddenField($v, "id", array("name" => "DocumentItem[update][oldId][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag5) ? $itemName : $this->selectItemControlType($v, $form, "id", "DocumentItem[update][id][$v->documentItemId]", $template)) . $form->hiddenField($v, "id", array(
						"name"=>"DocumentItem[update][oldId][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "id");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "id");
					//$itemField[$i]['fieldValue'][] = ((!$flag5) ? $v->id : $form->textField($v, "id", array('name' => "DocumentItem[update][id][$v->documentItemId]"))).$form->hiddenField($v, "id", array("name" => "DocumentItem[update][oldId][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag5) ? $itemName : $this->selectItemControlType($v, $form, "id", "DocumentItem[update][id][$v->documentItemId]", $template)) . $form->hiddenField($v, "id", array(
							"name"=>"DocumentItem[update][oldId][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag6 = $this->checkCanEditItemField($model, "value", $currentWorkflowState);
			}
			if(!isset($flag6))
			{
				$flag6 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "value", $v->value, $flag6);
			$itemName = $v->value;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"value"));
			if(isset($v->value) && !empty($v->value))
			{

				$itemField[$i]['canEdit'][] = $flag6;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "value");
				//$itemField[$i]['fieldValue'][] = ((!$flag6) ? $v->value : $form->textField($v, "value", array('name' => "DocumentItem[update][value][$v->documentItemId]"))).$form->hiddenField($v, "value", array("name" => "DocumentItem[update][oldValue][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag6) ? $itemName : $this->selectItemControlType($v, $form, "value", "DocumentItem[update][value][$v->documentItemId]", $template)) . $form->hiddenField($v, "value", array(
						"name"=>"DocumentItem[update][oldValue][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "value");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "value");
					//$itemField[$i]['fieldValue'][] = ((!$flag6) ? $v->value : $form->textField($v, "value", array('name' => "DocumentItem[update][value][$v->documentItemId]"))).$form->hiddenField($v, "value", array("name" => "DocumentItem[update][oldValue][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag6) ? $itemName : $this->selectItemControlType($v, $form, "value", "DocumentItem[update][value][$v->documentItemId]", $template)) . $form->hiddenField($v, "value", array(
							"name"=>"DocumentItem[update][oldValue][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag7 = $this->checkCanEditItemField($model, "table", $currentWorkflowState);
			}
			if(!isset($flag7))
			{
				$flag7 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "table", $v->value, $flag7);
			$itemName = $v->table;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"table"));
			if(isset($v->table) && !empty($v->table))
			{

				$itemField[$i]['canEdit'][] = $flag7;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "table");
				//$itemField[$i]['fieldValue'][] = ((!$flag7) ? $v->table : $form->textField($v, "table", array('name' => "DocumentItem[update][table][$v->documentItemId]"))).$form->hiddenField($v, "table", array("name" => "DocumentItem[update][oldTable][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag7) ? $itemName : $this->selectItemControlType($v, $form, "table", "DocumentItem[update][table][$v->documentItemId]", $template)) . $form->hiddenField($v, "table", array(
						"name"=>"DocumentItem[update][oldTable][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "table");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "table");
					//$itemField[$i]['fieldValue'][] = ((!$flag7) ? $v->table : $form->textField($v, "table", array('name' => "DocumentItem[update][table][$v->documentItemId]"))).$form->hiddenField($v, "table", array("name" => "DocumentItem[update][oldTable][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag7) ? $itemName : $this->selectItemControlType($v, $form, "table", "DocumentItem[update][table][$v->documentItemId]", $template)) . $form->hiddenField($v, "table", array(
							"name"=>"DocumentItem[update][oldTable][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag8 = $this->checkCanEditItemField($model, "unit", $currentWorkflowState);
			}
			if(!isset($flag8))
			{
				$flag8 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "unit", $v->unit, $flag8);
			$itemName = $v->unit;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"unit"));
			if(isset($v->unit) && !empty($v->unit))
			{

				$itemField[$i]['canEdit'][] = $flag8;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "unit");
				//$itemField[$i]['fieldValue'][] = ((!$flag8) ? $v->unit : $form->textField($v, "unit", array('name' => "DocumentItem[update][unit][$v->documentItemId]"))).$form->hiddenField($v, "unit", array("name" => "DocumentItem[update][oldUnit][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag8) ? $itemName : $this->selectItemControlType($v, $form, "unit", "DocumentItem[update][unit][$v->documentItemId]", $template)) . $form->hiddenField($v, "unit", array(
						"name"=>"DocumentItem[update][oldUnit][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "unit");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "unit");
					//$itemField[$i]['fieldValue'][] = ((!$flag8) ? $v->unit : $form->textField($v, "unit", array('name' => "DocumentItem[update][unit][$v->documentItemId]"))).$form->hiddenField($v, "unit", array("name" => "DocumentItem[update][oldUnit][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag8) ? $itemName : $this->selectItemControlType($v, $form, "unit", "DocumentItem[update][unit][$v->documentItemId]", $template)) . $form->hiddenField($v, "unit", array(
							"name"=>"DocumentItem[update][oldUnit][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag9 = $this->checkCanEditItemField($model, "description8", $currentWorkflowState);
			}
			if(!isset($flag9))
			{
				$flag9 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "description8", $v->description8, $flag9);
			$itemName = $v->description8;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"description8"));
			if(isset($v->description8) && !empty($v->description8))
			{

				$itemField[$i]['canEdit'][] = $flag9;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description8");
				//$itemField[$i]['fieldValue'][] = ((!$flag9) ? $v->description8 : $form->textField($v, "description8", array('name' => "DocumentItem[update][description8][$v->documentItemId]"))).$form->hiddenField($v, "description8", array("name" => "DocumentItem[update][oldDescription8][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag9) ? $itemName : $this->selectItemControlType($v, $form, "description8", "DocumentItem[update][description8][$v->documentItemId]", $template)) . $form->hiddenField($v, "description8", array(
						"name"=>"DocumentItem[update][oldDescription8][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "description8");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description8");
					//$itemField[$i]['fieldValue'][] = ((!$flag9) ? $v->description8 : $form->textField($v, "description8", array('name' => "DocumentItem[update][description8][$v->documentItemId]"))).$form->hiddenField($v, "description8", array("name" => "DocumentItem[update][oldDescription8][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag9) ? $itemName : $this->selectItemControlType($v, $form, "description8", "DocumentItem[update][description8][$v->documentItemId]", $template)) . $form->hiddenField($v, "description8", array(
							"name"=>"DocumentItem[update][oldDescription8][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag10 = $this->checkCanEditItemField($model, "description9", $currentWorkflowState);
			}
			if(!isset($flag10))
			{
				$flag10 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "description9", $v->description9, $flag10);
			$itemName = $v->description9;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"description9"));
			if(isset($v->description9) && !empty($v->description9))
			{
				$itemField[$i]['canEdit'][] = $flag10;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description9");
				//$itemField[$i]['fieldValue'][] = ((!$flag10) ? $v->description9 : $form->textField($v, "description9", array('name' => "DocumentItem[update][description9][$v->documentItemId]"))).$form->hiddenField($v, "description9", array("name" => "DocumentItem[update][oldDescription9][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag10) ? $itemName : $this->selectItemControlType($v, $form, "description9", "DocumentItem[update][description9][$v->documentItemId]", $template)) . $form->hiddenField($v, "description9", array(
						"name"=>"DocumentItem[update][oldDescription9][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "description9");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description9");
					//itemField[$i]['fieldValue'][] = ((!$flag10) ? $v->description9 : $form->textField($v, "description9", array('name' => "DocumentItem[update][description9][$v->documentItemId]"))).$form->hiddenField($v, "description9", array("name" => "DocumentItem[update][oldDescription9][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag10) ? $itemName : $this->selectItemControlType($v, $form, "description9", "DocumentItem[update][description9][$v->documentItemId]", $template)) . $form->hiddenField($v, "description9", array(
							"name"=>"DocumentItem[update][oldDescription9][$v->documentItemId]"));
				}
			}

			if(!isset($canEdit))
			{
				$flag11 = $this->checkCanEditItemField($model, "description10", $currentWorkflowState);
			}
			if(!isset($flag11))
			{
				$flag11 = $canEdit;
			}
			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId, "description10", $v->description10, $flag11);
			$itemName = $v->description10;
			if(isset($controlDataItem))
			{
				$itemName = $controlDataItem;
			}
			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1", array(
				":documentTypeId"=>$model->documentTypeId,
				":documentItemField"=>"description10"));
			if(isset($v->description10) && !empty($v->description10))
			{
				$itemField[$i]['canEdit'][] = $flag11;
				$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description10");
				//$itemField[$i]['fieldValue'][] = ((!$flag11) ? $v->description10 : $form->textField($v, "description10", array('name' => "DocumentItem[update][description10][$v->documentItemId]"))).$form->hiddenField($v, "description10", array("name" => "DocumentItem[update][oldDescription10][$v->documentItemId]"));
				$itemField[$i]['fieldValue'][] = ((!$flag11) ? $itemName : $this->selectItemControlType($v, $form, "description10", "DocumentItem[update][description10][$v->documentItemId]", $template)) . $form->hiddenField($v, "description10", array(
						"name"=>"DocumentItem[update][oldDescription10][$v->documentItemId]"));
			}
			else
			{
				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "description10");
				if(count($itemTemplate) > 0)
				{
					$itemField[$i]['canEdit'][] = $canEdit;
					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId, "description10");
					//$itemField[$i]['fieldValue'][] = ((!$flag11) ? $v->description10 : $form->textField($v, "description10", array('name' => "DocumentItem[update][description10][$v->documentItemId]"))).$form->hiddenField($v, "description10", array("name" => "DocumentItem[update][oldDescription10][$v->documentItemId]"));
					$itemField[$i]['fieldValue'][] = ((!$flag11) ? $itemName : $this->selectItemControlType($v, $form, "description10", "DocumentItem[update][description10][$v->documentItemId]", $template)) . $form->hiddenField($v, "description10", array(
							"name"=>"DocumentItem[update][oldDescription10][$v->documentItemId]"));
				}
			}
			if(isset($canEdit) && $canEdit)
			{
				$itemField[$i]['delete'][] = CHtml::ajaxLink("ลบรายการ", CController::createUrl("DocumentItem/DisableDocumentItem/$v->documentItemId"), array(
						'type'=>'POST', //request type
						//'url'=>CController::createUrl('DocumentType/GetStateByWorkflowGroup'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						//'update'=>"#DocumentTemplate_editState, #DocumentTemplate_items_editState ", //selector to update
						//'update'=>".editState", //selector to update
						'success'=>"function( data )
								{
								// handle return data
								//alert( data );
								location.reload();
								}",
						//'data'=>array('groupId'=>'js:this.value'),
						//leave out the data key to pass all form values through
						), array(
						'class'=>'input-small btn btn-danger',
						'confirm'=>'คุณต้องการลบรายการนี้ ?',
						'id'=>'deleteItem'
				));
			}
			if(1 == 0)
			{//approve line item
				$itemField[$i]['approve'][] = CHtml::ajaxLink("อนุมัติ", CController::createUrl("DocumentItem/ApproveDocumentItem/$v->documentItemId"), array(
						'type'=>'POST', //request type
						//'url'=>CController::createUrl('DocumentType/GetStateByWorkflowGroup'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						//'update'=>"#DocumentTemplate_editState, #DocumentTemplate_items_editState ", //selector to update
						//'update'=>".editState", //selector to update
						'success'=>"function( data )
								{
								// handle return data
								//alert( data );
								location.reload();
								}",
						//'data'=>array('groupId'=>'js:this.value'),
						//leave out the data key to pass all form values through
						), array(
						'class'=>'input-small btn btn-info',
						'confirm'=>'คุณต้องการอนุมัติรายการนี้ ?',
						'id'=>'approveItem'
				));
				$itemField[$i]['reject'][] = CHtml::ajaxLink("ไม่อนุมัติ", CController::createUrl("DocumentItem/RejectDocumentItem/$v->documentItemId"), array(
						'type'=>'POST', //request type
						//'url'=>CController::createUrl('DocumentType/GetStateByWorkflowGroup'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						//'update'=>"#DocumentTemplate_editState, #DocumentTemplate_items_editState ", //selector to update
						//'update'=>".editState", //selector to update
						'success'=>"function( data )
											{
											// handle return data
											//alert( data );
											location.reload();
											}",
						//'data'=>array('groupId'=>'js:this.value'),
						//leave out the data key to pass all form values through
						), array(
						'class'=>'input-small btn btn-warning',
						'confirm'=>'คุณต้องการไม่อนุมัติรายการนี้ ?',
						'id'=>'rejectItem'
				));
			}
//			if(!isset($canEdit))
//			{
//				$flag12 = $this->checkCanEditItemField($model,"status",$currentWorkflowState);
//			}
//			if(!isset($flag12)){
//				$flag12=$canEdit;
//			}
//			$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId,"status",$v->status,$flag12);
//			$itemName = $v->status;
//			if(isset($controlDataItem))
//			{
//				$itemName = $controlDataItem;
//			}
//			$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1",array(":documentTypeId"=>$model->documentTypeId,":documentItemField"=>"status"));
//			if (isset($v->status) && !empty($v->status))
//			{
//				if($v->status == 1)
//				{
//					if(Yii::app()->user->id == $model->employeeId)
//					{
//						$flag12 = false;
//					}
//					$itemName = "รอการอนุมัติ";
//					$itemField[$i]['canEdit'][] = $flag12;
//					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId , "status");
//					$itemField[$i]['fieldValue'][] = ((!$flag12) ? $itemName : $this->selectItemControlType($v, $form, "status","DocumentItem[update][status][$v->documentItemId]", $template)).$form->hiddenField($v, "status", array("name" => "DocumentItem[update][oldStatus][$v->documentItemId]"));
//				}
//				else if($v->status == 2 || $v->status == 3)
//				{
//					$flag12 = false;
//					$controlDataItem = $this->getDataItemFieldValue($model->documentTypeId,"status",$v->status,$flag12);
//					if($v->status == 2)
//					{
//						$itemName = "อนุมัติ";
//					}
//					else if($v->status == 3)
//					{
//						$itemName = "ไม่อนุมัติ";
//					}
//					$template = DocumentTemplate::model()->find("documentTypeId = :documentTypeId AND documentItemField = :documentItemField AND status = 1",array(":documentTypeId"=>$model->documentTypeId,":documentItemField"=>"status"));
//
//					if (isset($v->status) && !empty($v->status))
//					{
//						$itemField[$i]['canEdit'][] = $flag12;
//						$itemField[$i]['fieldName'][] = "สถานะ";
//						$itemField[$i]['fieldValue'][] = $itemName.$form->hiddenField($v, "status", array("name" => "DocumentItem[update][oldStatus][$v->documentItemId]")) ;
//					}
//				}
//			}
//			else
//			{
//				$itemTemplate = DocumentTemplate::model()->getFieldNameByDocumentTypeIdAndDocumentItemFieldName($model->documentTypeId, "status");
//				if(count($itemTemplate) > 0)
//				{
//					$itemField[$i]['canEdit'][] = $canEdit;
//					$itemField[$i]['fieldName'][] = $this->getFieldName($model->documentTypeId , "status");
//					$itemField[$i]['fieldValue'][] = ((!$flag12) ? $itemName : $this->selectItemControlType($v, $form, "status","DocumentItem[update][status][$v->documentItemId]", $template)).$form->hiddenField($v, "status", array("name" => "DocumentItem[update][oldStatus][$v->documentItemId]"));
//				}
//			}

			$i++;
		}
	}
	echo $this->showItemField($itemField);
	echo '<hr />';
} // show documentItem
// show Add documentItem
if(!isset($currentWorkflowState->workflowCurrent))
{
	if($documentWorkflowModel->isFinished == 1)
	{
		$canAdd = false;
	}
	else
	{
		$canAdd = true;
	}
}
else
{
	$template = DocumentTemplate::model()->find("documentTypeId=:documentTypeId AND documentItemField=:documentItemField AND status = :status", array(
		':documentTypeId'=>$model->documentTypeId,
		':documentItemField'=>'documentItemName',
		':status'=>'1'));
	$canAdd = Workflow::model()->checkCanAddState($currentWorkflowState->workflowCurrent->workflowId, isset($template->addState) ? $template->addState : "", $model->documentId);
}
if($canAdd)
{
	if(!isset($_REQUEST["device"]))
	{
		//if($_REQUEST["device"] != "mobile")
		//{
		$this->renderPartial('_itemForm', array(
			'model'=>$model,
			'documentType'=>$documentType,
			'form'=>$form));
		//}
	}
}
?>
<!-- End Document Items -->

<!-- Stock Summary -->
<?php
if(isset($stockSummary))
{

	echo "</hr><h4 style='color:red'>จำนวนคลังสินค้าคงเหลือ</h4>";
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'stockSummary-grid',
		'dataProvider'=>$stockSummary,
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		//'filter'=>$model,
		'columns'=>array(
			array(
				'name'=>'stockDetailName',
				'type'=>'raw',
				'value'=>'CHtml::encode(isset($data->stockDetailName) ? $data->stockDetailName : "-")',
			),
			array(
				'name'=>'sumQuantity',
				'type'=>'raw',
				'value'=>'CHtml::encode(isset($data->sumQuantity) ? $data->sumQuantity : "0")',
			),
		),
	));
}
?>
<!-- Stock Summary -->

<!-- Log -->
<h3>Document History</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'history-grid',
	'dataProvider'=>$historyLog,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'employeeId',
			'type'=>'raw',
			'value'=>'CHtml::encode($data->employee->fnTh." ".$data->employee->lnTh)',
		),
		array(
			'name'=>'workflowStateId',
			'type'=>'raw',
			//'value' => 'CHtml::encode((isset($data->workflowState->workflowCurrent)) ? $data->workflowState->workflowCurrent->workflowName." (".$data->workflowState->workflowStatus->workflowStatusName.") "  : "แบบร่างเอกสาร")',
			'value'=>'showWorkflowState($data->workflowState,$data->employeeId)',
		),
		'remarks',
		//'createDateTime',
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;'),
			'value'=>'CHtml::encode(($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		),
	),
));
?>
<?php
if($this->getWaitProcess($model) != " ")
{
	echo "<p style='color:red;font-size:16px'><b>รอดำเนินการจาก </b>" . $this->getWaitProcess($model) . "</p>";
}
if(isset($model->documentWorkflow))
{
	if($model->documentWorkflow->isFinished)
		echo "<p style='color:green;font-size:16px'><b>เอกสารฉบับนี้ได้สิ้นสุดการดำเนินการแล้ว </b></p>";
}
?>
<!-- End Log -->
<script type="text/javascript">
// here is the magic
	function cancelDocument()
	{
<?php
echo CHtml::ajax(array(
	'url'=>array(
		'Document/CancelDocument/' . $model->documentId),
	'data'=>"js:$(this).serialize()",
	'type'=>'post',
	'dataType'=>'json',
	'success'=>"function(data)
            {
                if (data.status == 'failed')
                {
                    $('#dialogCancelDocument div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                   $('#dialogCancelDocument div.divForForm form').submit(cancelDocument);
                }
				else if(data.status == 'remark')
				{
					$('#dialogCancelDocument div.divForForm').html(data.div);
                    setTimeout(\"$('#dialogCancelDocument').dialog('close') \",2500);
				}
                else
                {
                    $('#dialogCancelDocument div.divForForm').html(data.div);
                    setTimeout(\"$('#dialogCancelDocument').dialog('close') \",3000);
					location.href='Outbox';
                }

            } ",
))
?>;
		return false;

	}

</script>
<?php
$wfLog = WorkflowLog::model()->findAll("documentId =:documentId AND employeeId NOT IN(:employeeId)", array(
	"documentId"=>$model->documentId,
	":employeeId"=>$model->employeeId));
$wfLog2 = WorkflowLog::model()->CanDeleteDocFromWorkflowLog($model->documentId);
if(!isset($_REQUEST["device"]))
{
	//if($_REQUEST["device"] != "mobile")
	//{
	if(count($wfLog) == 0 && $model->status == 1 && (Yii::app()->user->Id == $model->employeeId) && $wfLog2)
	{
		//echo CHtml::ajaxLink("ลบเอกสาร",CController::createUrl("Document/CancelDocument/$model->documentId"),
		echo CHtml::link("ลบเอกสาร", "", array(
			'type'=>'POST', //request type
			'onclick'=>"{cancelDocument(); $('#dialogCancelDocument').dialog('open');}",
			'class'=>'input-large btn btn-danger',
			'id'=>'deleteDocument'
		));
	}
	//}
}
?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	// the dialog
	'id'=>'dialogCancelDocument',
	'options'=>array(
		'title'=>'ลบเอกสาร',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>550,
		'height'=>200,
	),
));
?>
<div class="divForForm"></div>

<?php $this->endWidget(); ?>


<!-- Action -->

<?php
if(!isset($_REQUEST["device"]))
{
	//if($_REQUEST["device"] != "mobile")
	//{
	if(count($workflowStatus) > 0 && $model->status == 1)
	{
		$this->renderPartial('actionView', array(
			'form'=>$form,
			'workflowStateModel'=>$workflowStateModel,
			'workflowStatus'=>$workflowStatus,
			'workflowLogModel'=>$workflowLogModel,
			'currentWorkflowState'=>$currentWorkflowState,
			'documentWorkflowModel'=>$documentWorkflowModel,));
	}
	//}
}
?>




<!-- End Action -->

<?php $this->endWidget(); ?>
<?php

function showWorkflowState($workflowState, $employeeId = null)
{
	if(isset($workflowState))
	{
		$workflowName = "";
		$workflowStatusName = "";
		if($employeeId == 0)
		{
			return "ระบบ (ยกเลิก)";
		}
		else
		{
			if(isset($workflowState->workflowCurrent))
			{
				$workflowName .= $workflowState->workflowCurrent->workflowName;
			}
			if(isset($workflowState->workflowStatus))
			{
				$workflowStatusName .= "( " . $workflowState->workflowStatus->workflowStatusName . " )";
			}
			return $workflowName . $workflowStatusName;
		}
	}
	else
	{
		if($employeeId == 0)
		{
			return "ระบบ (ยกเลิก)";
		}
		else
		{
			return "ลบเอกสาร";
		}
	}
}
?>
