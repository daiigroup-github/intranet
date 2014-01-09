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
		'class'=>'form-horizontal',)));
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
<h3>
	สร้างโดย :
	<?php echo $model->employee->fnTh . ' ' . $model->employee->lnTh . '(' . $model->employee->username . ')'; ?>
	<small><?php echo $this->dateThai($model->createDateTime, 1); ?> </small>
</h3>
<?php
echo $form->hiddenField($documentWorkflowModel, "currentState", array(
	'name'=>'previousState'));

//Leave
?>
<div class="alert alert-info">
	<div class="control-group">
		<label class="control-label">ประเภทการลา</label>
		<div class="controls">
			<?php echo $leaveModel->leaveTypeText($leaveModel->leaveType); ?>

		</div>
	</div>

	<div class="control-group">
		<label class="control-label">เอกสารประกอบการลา</label>
		<div class="controls">
			<?php
			if(strpos($leaveModel->filePath, ".pdf")) //ถ้าเป็น pdf ให้ fancy box โหลด class pdf แทน
			{
				echo "<a class='pdf' Title='$leaveModel->filePath' href='$leaveModel->filePath'>ดูไฟล์แนบ</a> ";
			}
			else
			{
				echo "<a class='fancyFrame' Title='$leaveModel->filePath' href='$leaveModel->filePath'><img src='$leaveModel->filePath' width='50px' alt='' /></a> ";
			}
			?>
			<?php
			if($leaveModel->document->employeeId == Yii::app()->user->id)
			{
				echo $form->fileField($leaveModel, 'filePath');
			}
			else
			{
				echo "รออัพโหลดเอกสารยืนยันการลาจากผู้สร้างเอกสาร";
			}
			?>
		</div>
	</div>

</div>
<?php
echo "<h3>รายการของเอกสาร</h3>"; //.LeaveItem::model()->sumLeaveTimeByLeaveId($leaveModel->leaveId);
//LeaveItem
foreach($leaveModel->leaveItem as $leaveItem):
	?>
	<div class="well">
		<div class="control-group">
			<label class="control-label">วันที่ต้องการลา</label>
			<div class="controls">
				<?php echo $this->dateThai($leaveItem->leaveDate, 3); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">เวลาที่ต้องการลา</label>
			<div class="controls">
				<?php echo $leaveItem->leaveItemTimeTypeText($leaveItem->leaveTimeType); ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<!-- End Document Items -->

<!-- Log -->
<h3>Document History</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'history-grid',
	'dataProvider'=>$workflowLogModel->findAllByDocumentId($model->documentId),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	//'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'employeeId',
			'type'=>'raw',
			'value'=>'CHtml::encode($data->employee->fnTh." ".$data->employee->lnTh)',),
		array(
			'name'=>'workflowStateId',
			'type'=>'raw',
			//'value' => 'CHtml::encode((isset($data->workflowState->workflowCurrent)) ? $data->workflowState->workflowCurrent->workflowName." (".$data->workflowState->workflowStatus->workflowStatusName.") "  : "แบบร่างเอกสาร")',
			'value'=>'showWorkflowState($data->workflowState)',),
		'remarks',
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:left;width:17%'),
			'value'=>'CHtml::encode(isset($data->createDateTime) ? Controller::dateThai($data->createDateTime,3) : "-")',
		)
	,),));
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
		'Document/cancelLeaveDocument/' . $model->documentId),
	'data'=>"js:$(this).serialize()",
	'type'=>'post',
	'dataType'=>'json',
	'success'=>"function(data){
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
				location.href='../outbox';
			}
		}",));
?>
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
	if(count($wfLog) == 0 && $model->status == 1 && (Yii::app()->user->Id == $model->employeeId) && $wfLog2)
	{
		echo CHtml::link(($leaveModel->status == 0) ? "ลบเอกสาร" : 'ยกเลิกเอกสาร', "", array(
			'type'=>'POST',
			//request type
			'onclick'=>"{cancelDocument(); $('#dialogCancelDocument').dialog('open');}",
			'class'=>'input-large btn btn-danger',
			'id'=>'deleteDocument'));
	}
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
		'height'=>200,),));
?>
<div class="divForForm"></div>
<?php $this->endWidget(); ?>

<!-- Action -->
<?php
if(!isset($_REQUEST["device"]))
{
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
}
?>
<!-- End Action -->
<?php $this->endWidget(); ?>

<?php

function showWorkflowState($workflowState)
{
	if(isset($workflowState))
	{
		$workflowName = "";
		$workflowStatusName = "";
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
	else
	{
		return "ลบเอกสาร";
	}
}
?>
