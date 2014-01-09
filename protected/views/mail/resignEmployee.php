<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบ Intranet</p>


		<p> <b>มีพนักงาน ลาออก วันที่ทำงานวันสุดท้าย คือ <?php echo $leaveDate ?></b></p>


		<p>
		<table width="90%" border="1" cellspaccing="0">
			<tr>
				<td><?php echo $empCode; ?></td>
				<td><?php echo $nameThai; ?></td>
				<td><?php echo $nameEng; ?></td>
				<td><?php echo $position; ?></td>
				<td><?php echo $empUserName; ?></td>
			</tr>
		</table>
	</p>

	<?php
	if($canView)
	{
		?>
		<p><b>กรุณากด</b> <a href="<?php echo $website ?>"><?php echo $website ?></a> เพื่อดูข้อมูล</p>
	<?php } ?>
	<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
</body>
</html>
