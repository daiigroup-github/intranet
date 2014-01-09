<?php
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
$this->renderPartial('_searchFormFixTime', array(
	'documentItem'=>$documentItem));
?>
<?php
if(count($employeeModels) > 0)
{
	foreach($employeeModels as $employee):
		?>
		<div class="alert alert-info">
			<h3><?php echo $employee->fnTh . ' ' . $employee->lnTh; ?></h3>

			<table class="table table-striped table-bordered">
				<tr>
					<td>เลขที่ใบแก้ไขเวลา</td>
					<td>ว.ด.ป. ที่สร้างเอกสาร</td>
					<td>ว.ด.ป. ที่ขอแก้ไข</td>
					<td>แก้ไขเวลาเข้า</td>
					<td>เหตุผล</td>
					<td>แก้ไขเวลาออก</td>
					<td>เหตุผล</td>
					<td>Action</td>
				</tr>
				<?php foreach(DocumentItem::model()->getWaitApprovedFixTimeItemByEmployeeId($employee->employeeId, $documentItem->startDate, $documentItem->endDate) as $documentItemModel): ?>

					<?php
					if($documentItemModel->status == 2)
					{
						$tableClass = "warning";
					}
					else if($documentItemModel->status == 3)
					{
						$tableClass = "error";
					}
					else if($documentItemModel->status == 4)
					{
						$tableClass = "success";
					}
					else
					{
						$tableClass = "";
					}
					?>
					<tr class="<?php echo $tableClass; ?>">
						<td><?php echo $documentItemModel->document->documentCode; ?></td>
						<td><?php
							$date = explode(' ', $documentItemModel->document->createDateTime);
							echo $this->dateThai($date[0], 3);
							?>
						</td>
						<td><?php echo $this->dateThai($documentItemModel->documentItemName, 3); ?></td>
						<td><?php echo $documentItemModel->description; ?></td>
						<td><?php echo $documentItemModel->remark; ?></td>
						<td><?php echo $documentItemModel->id; ?></td>
						<td><?php echo $documentItemModel->value; ?></td>
						<td>
							<?php
							if($documentItemModel->status == 1)
							{
								if($documentItemModel->document->documentWorkflow->employeeId == Yii::app()->user->id)
								{
									echo CHtml::ajaxLink('<i class="icon-ok icon-white"></i>', CController::createUrl("Document/approveFixTimeItemStatus/$documentItemModel->documentItemId"), array(
										'update'=>'',
										'dataType'=>'json',
										'success'=>'function(data){
								if(data.status)
								{
									$("#updateApprove' . $documentItemModel->documentItemId . '").hide();
									$("#updateReject' . $documentItemModel->documentItemId . '").hide();
									$("#updateApprove' . $documentItemModel->documentItemId . '").parent().parent().addClass("alert");
								}
								else if(data.status == 2)
								{
									alert("ท่านดำเนินการกับรายการนี้ไปแล้ว!!");
									window.location.reload();
								}
								else
								{
									alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");
								}
							}',
										), array(
										'class'=>'btn btn-success btn-small',
										'id'=>'updateApprove' . $documentItemModel->documentItemId,
										'confirm'=>'คุณต้องการ อนุมัติ รายการแก้ไขเวลา ?',
									));

									echo CHtml::ajaxLink('<i class="icon-remove icon-white"></i>', CController::createUrl("Document/rejectFixTimeItemStatus/$documentItemModel->documentItemId"), array(
										'update'=>'',
										'dataType'=>'json',
										'success'=>'function(data){
								if(data.status)
								{
									$("#updateApprove' . $documentItemModel->documentItemId . '").hide();
									$("#updateReject' . $documentItemModel->documentItemId . '").hide();
									$("#updateApprove' . $documentItemModel->documentItemId . '").parent().parent().addClass("alert");
								}
								else if(data.status == 2)
								{
									alert("ท่านดำเนินการกับรายการนี้ไปแล้ว!!");
									window.location.reload();
								}
								else
								{
									alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");
								}
							}',
										), array(
										'class'=>'btn btn-danger btn-small',
										'id'=>'updateReject' . $documentItemModel->documentItemId,
										'confirm'=>'คุณต้องการ ไม่อนุมัติ รายการแก้ไขเวลา ?',
									));
								}
								else
								{
									echo "รออนุมัติ";
								}
							}
							else if($documentItemModel->status == 2)
								echo "อนุมัติ";
							else if($documentItemModel->status == 3)
								echo "ไม่อนุมัติ";
							else if($documentItemModel->status == 4)
								echo "ฝ่ายบุคคลรับทร้าบแล้ว";
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<?php
	endforeach;
}?>