<div class="row-fluid well">
	<div class="span12" style="text-align: center">
		<h2 style="background-color: greenyellow;color:black">ผลการจอง !!!</h2>
		<?php if(isset($reserve)): ?>
			<div class="row-fluid">
				<div class='span12 ' style="text-align: center">
					<h3><?php echo $reserve->showtime->movie->title; ?></h3>
				</div>
			</div>
			<div class="row-fluid">
				<div class='span12 ' style="text-align: center">
					<h3><?php
						echo CHtml::image(Yii::app()->baseUrl . $reserve->showtime->movie->image, "", array(
							"style"=>"width:250px"));
						?></h3>
				</div>
			</div>
		<?php endif; ?>
		<?php if(isset($errorCode) && empty($errorCode)): ?>
			<div class="row-fluid">
				<div class='span12' style="text-align: center">
					<h2 style="color: red">การจองเสร็จสมบูรณ์</h2>
				</div>
			</div>
			<div class="row-fluid">
				<div class='span12' style="text-align: center">
					<h3 style="background-color: yellow;color:black">หมายเลขการจองของท่านคือ : <span class="" style='font-size:35px'><?php echo $reserve->reserveCode; ?></span></h3>
				</div>
			</div>
			<div class="row-fluid">
				<div class='span12' style="text-align: center;text-decoration: underline">
					กรณีต้องการยกเลิกการจองกรุณายกเลิกล่วงหน้าอย่างน้อย 3 วัน
				</div>
			</div>
		<?php else: ?>
			<div class="row-fluid">
				<div class='span12' style="text-align: center;">
					<h2 style="color: red">ไม่สามารถทำรายการจองได้</h2>
					<?php if(isset($reserve)): ?>
						<div class="row-fluid">
							<div class='span12' style="text-align: center;color:red">
								<h3>***&nbsp;<?php echo $errorCode; ?>&nbsp;***</h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<h3 style="background-color: yellow;color:black">หมายเลขการจองของท่านคือ : <span class="" style='font-size:35px'><?php echo $reserve->reserveCode; ?></span></h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class='span12' style="text-align: center;text-decoration: underline">
								กรณีต้องการยกเลิกการจองกรุณายกเลิกล่วงหน้าอย่างน้อย 3 วัน
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-actions">
			<?php
			echo CHtml::link("กลับไปหน้ารอบฉาย", Yii::app()->createUrl("theater"), array(
				'class'=>'btn btn-success'));
			?>
		</div>
	</div>

</div>