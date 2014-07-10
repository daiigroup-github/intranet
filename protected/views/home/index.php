<?php
//$this->pageHeader = "Home";
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
//$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
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
<style>
	body
	{
		padding-top:64px;
	}

	.hero-unit{
		background-color:darkgreen;
	}
	.hero-unit, .hero-unit h1{
		color:#ffffff;
	}

</style>
<?php
/*
  <div class="hero-unit" style="text-align: center">
  <h1><image  style="margin-top:-70px;"  height="150px" src="<?php echo Yii::app()->baseUrl . "/images/logo/daii-logo.png" ?>"/> Intranet</h1>
  <p style="margin-bottom: -50px">ระบบเอกสารภายในสำนักงาน</p>
  </div>
 */
?>

<?php
//Fit And Fast
?>
<div class="page-header">
	<h3>Fit And Fast</h3>
</div>
<div class="row">
	<?php if(Employee::model()->isManager()): ?>
		<div class="span3">
			<h4>ภาพรวมฝ่าย</h4>
			<?php
			$this->renderPartial('fitfast.views.default._chart', array(
				'percent'=>$divisionFitAndFastPercent, 'id'=>'div'));
			?>
		</div>
	<?php endif; ?>

	<div class="span3">
		<h4>Fit And Fast</h4>
		<?php
		$this->renderPartial('fitfast.views.default._chart', array(
			'percent'=>$summary['percent'], 'id'=>'emp'));
		?>
	</div>

	<div class = "<?php echo (Employee::model()->isManager() ? 'span3' : 'span6'); ?>">
		<h4>รายการรอส่ง</h4>
		<?php
		////show รายการที่รอ upload ของเดือน ปัจจุบัน ย้อนหลังกลับไป
		foreach(FitAndFast::model()->findAllWaitingForUpload() as $fitAndFastId=> $fitAndFast):
			?>
			<div class="alert">
				<strong><?php echo $fitAndFast['title']; ?></strong>
				<ul>
					<?php foreach($fitAndFast['data'] as $month=> $target): ?>
						<li>
							<?php echo $target . ' ' . CHtml::link('<i class="icon-upload-alt"></i>', $this->createUrl('fitfast/default/upload/' . $fitAndFastId . '/' . $month)); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php
		endforeach;
		?>
	</div>
</div>
<hr />

<?php
/**
 * Elearning Exam
 */
if($elearningExamModel):
	?>
	<div class="alert">
		<a href="<?php echo Yii::app()->createUrl('elearningExam/' . $elearningExamModel->elearningExamId); ?>">
			คลิกที่นี่เพื่อเข้าสอบ :: หลังจากคลิกเข้าสอบแล้วไม่สามารถสอบซ้ำได้
		</a>
	</div>
<?php endif; ?>

<?php
/*
  <div class="alert alert-danger ">
  <a href="<?php echo Yii::app()->createUrl('home/showroom'); ?>"><image src="<?php echo Yii::app()->baseUrl . "/images/logo/new.png" ?>" width="50px" /><strong> Daii Group Sport Day << Click </strong></a>
  </div>
 */
?>

<div class="row-fluid">

	<div class="span4">
		<h3 class="">ข่าวสาร & กิจกรรม</h3>
		<?php
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=A"), array(
			'class'=>'btn btn-primary'))
		?>
		<hr>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("A");
		$i = 0;
		foreach($notices as $notice)
		{
			?>
			<div class="row-fluid img-polaroid" >
				<div class="span12 " >
					<div style="text-align: center">
						<?php
						if(!empty($notice->imageUrl))
						{
							if(strpos($notice->imageUrl, ".pdf"))
							{
								$imgUrl = Yii::app()->baseUrl . "/images/ico/pdf_icon.png";
								echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
							}
							else
							{
								echo "<p><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='80%' alt='' /></a></p>";
							}
						}
						else
						{
							$imgUrl = Yii::app()->baseUrl . "/images/ico/news_icon.jpg";
							echo "<p class='text-center'><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
						}
						?>
					</div>
					<h4 style="color:blue"><a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a></h4>
					<p><?php
						//if ($i < 3) {
						if(1 == 1)
						{
							if(isset($notice->headline) && !empty($notice->headline))
							{
								echo $notice->headline;
							}
							?></p>
						<?php
						echo CHtml::link("รายละเอียด", Yii::app()->createUrl("/notice/view/$notice->noticeId"), array(
							'class'=>'btn'));
						?>
					</div>
				</div>
				<br>																																														<!--  <p><a class="btn btn-success" target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>">รายละเอียด »</a></p>-->
				<?php
			}
			?>
			<?php
			$i++;
			if($i == 3)
			{
				break;
			}
		}
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=A"), array(
			'class'=>'btn btn-primary'))
		?>
	</div>
	<div class="span4">
		<h3>นโยบาย</h3>
		<?php
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=B"), array(
			'class'=>'btn btn-primary'))
		?>
		<hr>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("B");
		$i = 0;
		foreach($notices as $notice)
		{
			?>
			<div class="row-fluid img-polaroid" >
				<div class="span12 " >
					<div style="text-align: center">
						<?php
						if(!empty($notice->imageUrl))
						{
							if(strpos($notice->imageUrl, ".pdf"))
							{
								$imgUrl = Yii::app()->baseUrl . "/images/ico/pdf_icon.png";
								echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
							}
							else
							{
								echo "<p><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='80%' alt='' /></a></p>";
							}
						}
						else
						{
							$imgUrl = Yii::app()->baseUrl . "/images/ico/policy_icon.gif";
							echo "<p class='text-center'><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
						}
						?>
					</div>
					<h4 style="color:blue"><a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a></h4>
					<p><?php
						//if ($i < 3) {
						if(1 == 1)
						{
							if(isset($notice->headline) && !empty($notice->headline))
							{
								echo $notice->headline;
							}
							?></p>
						<?php
						echo CHtml::link("รายละเอียด", Yii::app()->createUrl("/notice/view/$notice->noticeId"), array(
							'class'=>'btn'));
						?>
					</div>
				</div>
				<br>																																														<!--  <p><a class="btn btn-success" target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>">รายละเอียด »</a></p>-->
				<?php
			}
			?>
			<?php
			$i++;
			if($i == 3)
			{
				break;
			}
		}
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=B"), array(
			'class'=>'btn btn-primary'))
		?>
	</div>

	<div class="span4">
		<h3>ช่วยเหลือ & สนับสนุน</h3>
		<?php
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=C"), array(
			'class'=>'btn btn-primary'))
		?>
		<hr>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("C");
		$i = 0;
		foreach($notices as $notice)
		{
			?>
			<div class="row-fluid img-polaroid" >
				<div class="span12 " >
					<div style="text-align:center">
						<?php
						if(!empty($notice->imageUrl))
						{
							if(strpos($notice->imageUrl, ".pdf"))
							{
								$imgUrl = Yii::app()->baseUrl . "/images/ico/pdf_icon.png";
								echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
							}
							else
							{
								echo "<p class='text-center'><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='80%' alt='' /></a></p>";
							}
						}
						else
						{
							$imgUrl = Yii::app()->baseUrl . "/images/ico/support_icon.png";
							echo "<p class='text-center'><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$imgUrl' width='80%' alt='' /></a></p>";
						}
						?>
					</div>
					<div class="" >
						<h4 >
							<a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a>
						</h4>
						<p><?php
							if(1 == 1)
							{
								if(isset($notice->headline) && !empty($notice->headline))
								{
									echo $notice->headline;
								}
								?>

								<?php
							}
							?>
						</p>
						<?php
						echo CHtml::link("รายละเอียด", Yii::app()->createUrl("/notice/view/$notice->noticeId"), array(
							'class'=>'btn'));
						?>
					</div>
				</div>
			</div>
			<br>
			<?php
			$i++;
			if($i == 3)
			{
				break;
			}
		}
		echo CHtml::link("ดูทั้งหมด >>", Yii::app()->createUrl("home/notice?noticeType=C"), array(
			'class'=>'btn btn-primary'))
		?>

	</div>
</div>
<hr>
<?php
/* $user = "kamyjap@gmail.com";
  $pass =	"kamyjapkung";
  Yii::app()->CALENDAR->login($user, $pass); */
?>

<?php /*
  <div class="row-fluid">

  <div class="span4">
  <h2>Heading</h2>
  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
  <p><a class="btn" href="#">View details »</a></p>
  </div><!--/span-->

  <div class="span4">
  <h2>Heading</h2>
  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
  <p><a class="btn" href="#">View details »</a></p>
  </div><!--/span-->

  <div class="span4">
  <h2>Heading</h2>
  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
  <p><a class="btn" href="#">View details »</a></p>
  </div><!--/span-->

  </div>

 */ ?>

