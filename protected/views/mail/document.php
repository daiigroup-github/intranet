<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบ Intranet</p>

		<p>เรียน คุณ <b><?php echo $name; ?></b></p>

		<p>มีเอกสาร <b><?php echo $documentTypeName; ?></b> &nbsp; เลขที่ <b><?php echo $documentNo; ?></b> </p>

		<p>จาก : <b><?php echo $creator; ?></b> ถึงคุณ</p>

		<p>สถานะ : <b><?php echo $action; ?></b> &nbsp; เหตุผล : <b><?php echo $remarks; ?></b></p>


		<p><b>กรุณากด</b> <a href="<?php echo $documentUrl ?>"><?php echo $documentUrl ?></a> เพื่อดำเนินการ</p>

		<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
	</body>
</html>
