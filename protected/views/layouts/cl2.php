<?php $this->beginContent('//layouts/main'); ?>
<div class="row">

	<div class="span3">
		<div class="well sidebar-nav">
			<ul class="nav nav-list">
				<li><a href="<?php echo Yii::app()->createUrl('/home'); ?>">หน้าหลัก</a></li>
				<li class="nav-header">ระบบเอกสาร</li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/index'); ?>">สร้างเอกสาร</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/draft'); ?>" title="เอกสารที่สร้างและยังไม่ได้ดำเนินการ">แบบร่าง<?php echo "(" . count(Document::model()->findAll(Document::model()->searchDraft(Yii::app()->user->id)->criteria)) . ")"; ?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/inbox'); ?>" title="เอกสารที่ได้รับ และ รอดำเนินการ">ถาดเข้า<?php echo "(" . count(Document::model()->findAll(Document::model()->searchInbox(Yii::app()->user->id)->criteria)) . ")"; ?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/outbox'); ?>" title="เอกสารที่สร้าง และ ดำเนินการไปแล้ว">ถาดออก<?php echo "(" . count(Document::model()->findAll(Document::model()->searchOutbox(Yii::app()->user->id)->criteria)) . ")"; ?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/history'); ?>" title="เอกสารที่เคยดำเนินการไปแล้ว">ประวัติ<?php echo "(" . count(Document::model()->findAll(Document::model()->searchHistory(Yii::app()->user->id)->criteria)) . ")"; ?></a></li>

				<li class="nav-header">Memo</li>
					<!--<li><a href="<?php echo Yii::app()->createUrl('/memo/create'); ?>" title="เธชเธฃเน�เธฒเธ� memo">เธชเธฃเน�เธฒเธ� Memo</a></li>-->
				<li><a href="<?php echo Yii::app()->createUrl('/memo/inbox'); ?>" title="memo ที่ได้รับ">ถาดเข้า<?php
						echo "(" . count(MemoTo::model()->findAll("status = 1 AND employeeId =:userId", array(
								":userId" => Yii::app()->user->id))) . ")";
						?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/memo/outbox'); ?>" title="memo ที่ส่งไป">ถาดออก<?php echo "(" . count(Memo::model()->findAll(Memo::model()->searchOutbox(Yii::app()->user->id)->criteria)) . ")"; ?></a></li>


				<li class="nav-header">ส่วนตัว</li>
				<li><a href="<?php echo Yii::app()->createUrl('/employee/' . Yii::app()->user->id); ?>">ข้อมูลส่วนตัว</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/employee/changePassword/' . Yii::app()->user->id); ?>">เปลี่ยนรหัสผ่าน</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/leaveReport/leaveReport'); ?>">รายงานใบลา</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('/document/viewFixtime/' . Yii::app()->user->id); ?>">รายงานใบแก้ไขเวลา</a></li>

				<li class="nav-header">ข้อมูลอื่นๆ</li>
				<li><a href="<?php echo Yii::app()->createUrl('/employee/extension'); ?>">เบอร์ต่อภายใน</a></li>
				<?php
				if (Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "ssd" || Yii::app()->user->name == "psa" || Yii::app()->user->name == "ksi") {
					?>
					<li><a href="<?php echo Yii::app()->createUrl('/employee/extensionAdmin'); ?>">จัดการเบอร์ต่อภายใน</a></li>
				<?php } ?>

				<?php
				if (Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "ssd" || Yii::app()->user->name == "kbw") {
					?>
					<li class="nav-header">พนักงาน</li>
					<li><a href="<?php echo Yii::app()->createUrl('/employee'); ?>">ทั้งหมด</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/employee/engineer'); ?>">วิศวกร</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/employee/sale'); ?>">ผู้แทนขาย</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/employee/mileage/' . Yii::app()->user->id); ?>">ระยะทาง</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/leaveReport'); ?>">รายงานใบลา</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/leaveReport/FixTimeReport'); ?>">รายงานแก้ไขเวลา</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/leaveReport/summaryLeaveReport'); ?>">รายงานสรุปวันลา</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/calendar'); ?>">วันตัดรอบเงินเดือน</a></li>
<?php } ?>
				<?php
//if(Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu"){
				if (1 == 2) {
					?>
					<li class="nav-header">ลูกค้า</li>
					<li><a href="<?php echo Yii::app()->createUrl('/customer'); ?>">ทั้งหมด</a></li>

					<li class="nav-header">ระยะทาง</li>
					<li><a href="<?php echo Yii::app()->createUrl('/mileage'); ?>">ระยะทาง</a></li>

					<li class="nav-header">Construction</li>
					<li><a href="<?php echo Yii::app()->createUrl('/qtechProject'); ?>">Qtech Projects</a></li>

					<li class="nav-header">ข้อมูลหลัก</li>
					<li><a href="<?php echo Yii::app()->createUrl('/group'); ?>">กลุ่มพนักงาน</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/documentType/'); ?>">ประเภทเอกสาร</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/documentTemplateField/'); ?>">ฟิลด์ของเอกสาร</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/documentControlType/'); ?>">document Control Type</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/documentControlData/'); ?>">document Control Data</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/workflowGroup/'); ?>">กลุ่มของ Workflow</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/workflow/'); ?>">Workflow</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/workflowStatus/'); ?>">สถานะ Workflow</a></li>

					<li class="nav-header">ผู้ดูแลระบบ</li>
					<li><a href="<?php echo Yii::app()->createUrl('/document/admin'); ?>">การจัดการ เอกสาร</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/noticeType/admin'); ?>">การจัดการ ประเภท ประกาศ</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('rights'); ?>">Rights</a></li>

<?php } ?>

				<?php
				if (Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "ksi" || Yii::app()->user->name == "blk") {
					?>
					<li class="nav-header">คลังอุปกรณ์สำนักงาน</li>
					<li><a href="<?php echo Yii::app()->createUrl('/stock/'); ?>">คลังอุปกรณ์สำนักงาน</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/stockDetail/'); ?>">รายการอุปกรณ์</a></li>

					<li class="nav-header">รายงาน</li>
					<li><a href="<?php echo Yii::app()->createUrl('/report/'); ?>">ออกรายงาน</a></li>

<?php } ?>

<?php
if (Yii::app()->user->name == "npr" || Yii::app()->user->name == "psd" || Yii::app()->user->name == "kpu" || Yii::app()->user->name == "ssd" || Yii::app()->user->name == "psa") {
	?>
					<li class="nav-header">การจัดการประกาศต่างๆ</li>
					<li><a href="<?php echo yii::app()->createurl('/notice/admin'); ?>">การจัดการ ประกาศ</a></li>
					<li><a href="<?php echo yii::app()->createurl('/elearning/generateExam'); ?>">สร้างการสอบ</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="span9">
<?php if (isset($this->breadcrumb)): ?>
			<div class="row">
				<div class="span9">
					<ul class="breadcrumb">
						<li><i class="icon-home"></i><span class="divider">/</span></li>
			<?php if (isset($this->breadcrumb)) echo $this->breadcrumb; ?>
					</ul>
				</div>
			</div>
					<?php endif; ?>

<?php if (isset($this->pageHeader)): ?>
			<div class="page-header">
				<h1><?php echo $this->pageHeader; ?></h1>
			</div>
		<?php endif; ?>

<?php echo $content; ?>
	</div>

</div>
		<?php $this->endContent(); ?>