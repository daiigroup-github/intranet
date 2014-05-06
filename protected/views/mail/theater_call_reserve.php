<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบ โรงหนังฝ่ายบุคคล</p>

		<p>เรียน คุณ <b><?php echo $toName; ?></b></p>
		<?php if(!$isCancel): ?>
			<p>มีรายการจองดูหนังเรื่อง <b><?php echo $movieName; ?></b>  </p>
		<?php else: ?>
			<p>มีรายการยกเลิกการจองดูหนังเรื่อง <b><?php echo $movieName; ?></b>  </p>
		<?php endif; ?>

		<p>รอบวันที่ : <b><?php echo $showDate; ?></b></p>

		<?php if($isManager): ?>
			<p>ของ พนักงาน : <b><?php echo $creatorName; ?></b> </p>
		<?php endif; ?>
		<?php if(isset($cancelRemark)): ?>
			<p>เหตุผล : <b><?php echo $cancelRemark; ?></b> </p>
		<?php endif; ?>


		<p><b>กรุณากด</b> <a href="<?php echo $reservedUrl ?>"><?php echo $reservedUrl ?></a> เพื่อดูรายการจองของท่าน <?php echo ($isManager) ? "และหนักงาน" : ""; ?></p>

		<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
	</body>
</html>
