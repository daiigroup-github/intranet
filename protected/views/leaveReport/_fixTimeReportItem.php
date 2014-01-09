<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
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
<?php foreach($employeeModels as $employee): ?>
	<div class="alert alert-info" style='min-width: 750px'>
		<h3 align="right"><?php echo $employee->fnTh . ' ' . $employee->lnTh . ' - ' . $employee->employeeCode; ?></h3>

		<table class="table table-striped table-bordered">
			<tr>
				<td>เลขที่ใบแก้ไขเวลา</td>
				<td>ว.ด.ป. ที่สร้างเอกสาร</td>
				<td>วันที่ ผจก.ฝ่าย อนุมัติ</td>
				<td>ว.ด.ป. ที่ขอแก้ไข</td>
				<td>แก้ไขเวลาเข้า</td>
				<td>เหตุผล</td>
				<td>แก้ไขเวลาออก</td>
				<td>เหตุผล</td>
				<td>Action</td>
			</tr>
			<?php foreach(DocumentItem::model()->getAllApprovedFixTimeItemByEmployeeId($employee->employeeId, $documentItem->startDate, $documentItem->endDate, $documentItem->inAround) as $documentItemModel): ?>
				<tr class="<?php echo ($documentItemModel->status == 4) ? 'success' : ''; ?>">
					<td><?php echo $documentItemModel->document->documentCode; ?></td>
					<td><?php
						$date = explode(' ', $documentItemModel->document->createDateTime);
						echo $this->dateThai($date[0], 3);
						?>
					</td>
					<td><?php echo $this->dateThai(isset(WorkflowLog::model()->findFixtimeApproveLogByDocumentId($documentItemModel->documentId)->createDateTime) ? WorkflowLog::model()->findFixtimeApproveLogByDocumentId($documentItemModel->documentId)->createDateTime : "0000-00-00", 3); ?></td>
					<td><?php echo $this->dateThai($documentItemModel->documentItemName, 3); ?></td>
					<td><?php echo $documentItemModel->description; ?></td>
					<td><?php echo $documentItemModel->remark; ?></td>
					<td><?php echo $documentItemModel->id; ?></td>
					<td><?php echo $documentItemModel->value; ?></td>
					<td>
						<?php
						if($documentItemModel->status == 2)
						{
							echo CHtml::ajaxLink('<i class="icon-ok icon-white"></i>', 'updateFixTimeItemStatus/' . $documentItemModel->documentItemId, array(
								'update'=>'',
								'beforeSend'=>'function(){}',
								'complete'=>'function(){
								$("#updateBtn' . $documentItemModel->documentItemId . '").hide();
								$("#updateBtn' . $documentItemModel->documentItemId . '").parent().parent().addClass("alert");
							}',
								), array(
								'class'=>'btn btn-warning btn-small',
								'id'=>'updateBtn' . $documentItemModel->documentItemId
							));
						}
						else if($documentItemModel->status == 1)
						{
							echo "รอดำเนินการ";
						}
						else if($documentItemModel->status == 3)
						{
							echo "ไม่อนุมัติ";
						}
						?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php endforeach; ?>