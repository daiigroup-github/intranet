<div class="row-fluid well">
	<div class="span12" style="text-align: center">
		<h2 style="background-color: greenyellow;color:black">ยกเลิกการจอง !!!</h2>
		<?php if(isset($reserve)): ?>
			<div class="row-fluid">
				<div class='span12 ' style="text-align: center">
					<h3><?php echo $reserve->showtime->movie->title; ?></h3>
				</div>
			</div>
			<div class="row-fluid">
				<div class='span4 ' style="text-align: center">
					<h3><?php
						echo CHtml::image(Yii::app()->baseUrl . $reserve->showtime->movie->image, "", array(
							"style"=>"width:250px"));
						?></h3>
				</div>
				<div class="span8">
					<div class="row-fluid">
						<div class='span12' style="text-align: center">
							<h2 style="color: red">รอบวันที่ : <?php echo $this->dateThai($reserve->showtime->showDate, 2, false) ?></h2>
						</div>
					</div>
					<?php if(!$flag): ?>
						<?php
						$form = $this->beginWidget('CActiveForm', array(
							'id'=>'theater-movie-form',
							'enableAjaxValidation'=>false,
							'htmlOptions'=>array(
								'class'=>'form-horizontal',
								'enctype'=>'multipart/form-data',),
						));
						?>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<h4>เหตุผลที่ยกเลิกการจอง</h4>
								<?php
								$this->widget('ext.editMe.widgets.ExtEditMe', array(
									'model'=>$reserve,
									'attribute'=>'cancelRemark',
									'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files',
								));
								?>
								<?php echo $form->error($reserve, 'cancelRemark'); ?>
							</div>
						</div>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<?php
								echo CHtml::submitButton('ยกเลิกการจอง', array(
									'class'=>'btn btn-primary'));
								?>
							</div>
						</div>
						<?php $this->endWidget(); ?>
					<?php else: ?>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<h2 style="color: red">ยกเลิกการจองเสร็จสมบูรณ์</h2>
							</div>
						</div>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<h3 style="background-color: yellow;color:black">ขอบคุณที่ใช้บริการ พบกันคราวหน้านะค่ะ</h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class='span12' style="text-align: center">
								<?php
								echo CHtml::link("<< กลับไปหน้ารายการจองของตัวเอง", Yii::app()->createUrl("theater/reserve/myReservedList"), array(
									'class'=>'btn btn-success'));
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

		<?php endif; ?>

	</div>

</div>