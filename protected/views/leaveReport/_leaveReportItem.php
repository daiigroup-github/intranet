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
<?php foreach ($employeeModels as $employee): ?>
	<div class="alert alert-info" style='min-width: 600px'>
		<h3 align="right"><?php echo $employee->fnTh . ' ' . $employee->lnTh . ' - ' . $employee->employeeCode; ?></h3>
		<table class="table table-striped table-bordered" >
			<tr>
				<td>เลขที่ใบลา</td>
				<td>วันที่ทำเอกสาร</td>
				<td>วันที่ ผจก.ฝ่าย อนุมัติ</td>
				<td>วันที่ขอลา</td>
				<td>ประเภทการลา</td>
				<td>เวลาที่ลา</td>
				<td>Action</td>
			</tr>
			<?php foreach (LeaveItem::model()->getAllApprovedLeaveItemByEmployeeId($employee->employeeId, $leaveModel->startDate, $leaveModel->endDate, $leaveModel->inAround) as $leaveItemModel): ?>
				<?php
				$isShow = true;
				if (Yii::app()->user->name != "kpu" && Yii::app()->user->name != "npr" && Yii::app()->user->name != "psd" && Yii::app()->user->name != "pth")
				{
					if ($leaveItemModel->leaveTimeType == 0)
					{
						$isShow = false;
					}
				}
				if ($isShow)
				{
					switch ($leaveItemModel->status)
					{
						case 0:
							$rowColor = 'warning';
							break;
						case 1:
							$rowColor = 'success';
							break;
						case 2:
							$rowColor = 'error';
							break;
					}
					if ($leaveItemModel->leaveTimeType == 0)
					{
						$rowColor = 'error';
					}
					?>
					<tr class="<?php echo $rowColor; ?>">
						<td><?php
							echo $leaveItemModel->leave->document->documentCode;
							if (isset($leaveItemModel->leave->filePath))
							{
								$filePath = Yii::app()->baseUrl . $leaveItemModel->leave->filePath;
								if (strpos($leaveItemModel->leave->filePath, ".pdf")) //ถ้าเป็น pdf ให้ fancy box โหลด class pdf แทน
								{
									echo "  " . "<a class='pdf' Title='' href=$filePath><i class='icon-file'></i></a> ";
								}
								else
								{
									echo "  " . "<a class='fancyFrame' Title='' href='$filePath'><i class='icon-file'></i></a> ";
								}
							}
							?></td>
						<td>
							<?php //echo $leaveItemModel->leave->document->createDateTime;  ?>
							<?php
							$date = explode(' ', $leaveItemModel->leave->document->createDateTime);
							echo $this->dateThai($date[0], 3);
							?>			
						</td>
						<td><?php echo $this->dateThai(isset(WorkflowLog::model()->findLeaveApproveLogByDocumentId($leaveItemModel->leave->documentId)->createDateTime) ? WorkflowLog::model()->findLeaveApproveLogByDocumentId($leaveItemModel->leave->documentId)->createDateTime : "0000-00-00", 3); ?></td>
						<td><?php echo $this->dateThai($leaveItemModel->leaveDate, 3); ?></td>
						<td><?php echo Leave::model()->leaveTypeText($leaveItemModel->leave->leaveType); ?></td>
						<td><?php echo $leaveItemModel->leaveItemTimeTypeText($leaveItemModel->leaveTimeType); ?></td>
						<td>
							<?php
							if (!$leaveItemModel->status && (Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "ssd"))
							{
								if ($leaveItemModel->leaveTimeType != 0)
								{
									echo CHtml::ajaxLink('<i class="icon-ok icon-white"></i>', 'leaveReport/updateLeaveItemStatus/' . $leaveItemModel->leaveItemId, array(
										'update' => '',
										'beforeSend' => 'function(){}',
										'complete' => 'function(){
								$("#updateBtn' . $leaveItemModel->leaveItemId . '").hide();
								$("#updateBtn' . $leaveItemModel->leaveItemId . '").parent().parent().removeClass();
								$("#updateBtn' . $leaveItemModel->leaveItemId . '").parent().parent().addClass("success");
								$("#wrongBtn' . $leaveItemModel->leaveItemId . '").hide();
							}',
										), array(
										'class' => 'btn btn-warning btn-success',
										'id' => 'updateBtn' . $leaveItemModel->leaveItemId
									));
									if ($leaveItemModel->leave->leaveType == 1)
									{
										echo CHtml::ajaxLink('<i class="icon-remove icon-white"></i>', 'leaveReport/UpdateLeaveItemWrongStatus/' . $leaveItemModel->leaveItemId, array(
											'update' => '',
											'beforeSend' => 'function(){}',
											'complete' => 'function(){
									$("#updateBtn' . $leaveItemModel->leaveItemId . '").hide();
									$("#wrongBtn' . $leaveItemModel->leaveItemId . '").hide();
									$("#updateBtn' . $leaveItemModel->leaveItemId . '").parent().parent().removeClass();
									$("#wrongBtn' . $leaveItemModel->leaveItemId . '").parent().parent().addClass("error");
													}',
											), array(
											'class' => 'btn btn-danger btn-small',
											'id' => 'wrongBtn' . $leaveItemModel->leaveItemId
										));
									}
								}
							}
							?>
						</td>
					</tr>
					<?php
				}
			endforeach;
			?>
		</table>
	</div>
<?php endforeach; ?>