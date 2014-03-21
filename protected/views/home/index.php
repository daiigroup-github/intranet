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
<div class="hero-unit" style="text-align: center">
	<h1><image  style="margin-top:-70px;"  height="150px" src="<?php echo Yii::app()->baseUrl . "/images/logo/daii-logo.png" ?>"/> Intranet</h1>
	<p style="margin-bottom: -50px">ระบบเอกสารภายในสำนักงาน</p>
</div>
<?php
// $basePath = Yii::getPathOfAlias("images");
//$path =$basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'activities';
//throw new Exception($basePath);
//if( file_exists($path)===true )
//{
//	$controllerDirectory = scandir($path);
//	foreach( $controllerDirectory as $entry )
//	{
/* if( $entry{0} =='s' && $entry{1} =='u' && $entry{2} =='b')
  { */

//			$entryPath = $path.DIRECTORY_SEPARATOR.$entry;
//			if( strpos(strtolower($entry), 'sub')!==false )
//			{
//				$name = substr($entry, 3 , -4);
/* $subViews[ strtolower($name) ] = array(
  'name'=>$name,
  'file'=>$entry,
  'path'=>$entryPath,
  ); */
//$subViews[ strtolower($name) ] = $name;
//				$subViews[ "sub".$name ] = $name;
//			}

/* if( is_dir($entryPath)===true )
  foreach( $this->getAllSubViewInPath($entryPath) as $subViewName=>$subview )
  $subViews[ $subViewName ] = $subview; */
/* } */
//	}
//}
//else
//{
//	throw new Exception("File exist..");
//}
?>

<?php
/**
 * Elearning Exam
 */
if ($elearningExamModel):
	?>
	<div class="alert">
		<a href="<?php echo Yii::app()->createUrl('elearningExam/' . $elearningExamModel->elearningExamId); ?>">
			คลิกที่นี่เพื่อเข้าสอบ :: หลังจากคลิกเข้าสอบแล้วไม่สามารถสอบซ้ำได้
		</a>
	</div>
<?php endif; ?>

<div class="alert alert-danger ">
	<a href="<?php echo Yii::app()->createUrl('home/showroom'); ?>"><image src="<?php echo Yii::app()->baseUrl . "/images/logo/new.png" ?>" width="50px" /><strong> Daii Group Sport Day << Click </strong></a>
</div>

<div class="row-fluid">

	<div class="span4">
		<h2>ข่าวสาร & กิจกรรม</h2>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("A");
		$i = 0;
		foreach ($notices as $notice) {
			?>
			<hr>
			<h4 style="color:blue"><a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a></h4>
			<p>
				<?php
				//if ($i < 3) {
				if (1 == 1) {
					if (isset($notice->headline) && !empty($notice->headline)) {
						echo $notice->headline;
					}
					?>
				</p>
				<?php
				if (!empty($notice->imageUrl)) {
					if (strpos($notice->imageUrl, ".pdf")) {
						echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'>ดูไฟล์แนบ</a></p>";
					} else {
						echo "<p><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='100px' alt='' /></a></p>";
					}
				}
				?>
																																																				<!--  <p><a class="btn btn-info" target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>">รายละเอียด »</a></p>-->

				<?php
			}
			$i++;
		}
		?>
	</div>
	<div class="span4">
		<h2>นโยบาย</h2>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("B");
		$i = 0;
		foreach ($notices as $notice) {
			?>
			<hr>
			<h4 style="color:blue"><a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a></h4>
			<p><?php
				//if ($i < 3) {
				if (1 == 1) {
					if (isset($notice->headline) && !empty($notice->headline)) {
						echo $notice->headline;
					}
					?></p>
				<?php
				if (!empty($notice->imageUrl)) {
					if (strpos($notice->imageUrl, ".pdf")) {
						echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'>ดูไฟล์แนบ</a></p>";
					} else {
						echo "<p><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='100px' alt='' /></a></p>";
					}
				}
				?>
																																																				<!--  <p><a class="btn btn-success" target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>">รายละเอียด »</a></p>-->

				<?php
			}
			$i++;
		}
		?>
	</div>

	<div class="span4">
		<h2>ช่วยเหลือ & สนับสนุน</h2>
		<?php
		$notices = Notice::model()->findNoticeByNoticeTypeCode("C");
		$i = 0;
		foreach ($notices as $notice) {
			?>
			<hr>
			<h4 style="color:blue"><a  target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>"><?php echo $notice->title; ?></a></h4>
			<p><?php
				//if ($i < 3) {
				if (1 == 1) {
					if (isset($notice->headline) && !empty($notice->headline)) {
						echo $notice->headline;
					}
					?></p>
				<?php
				if (!empty($notice->imageUrl)) {
					if (strpos($notice->imageUrl, ".pdf")) {
						echo "<p><a class='pdf' Title='$notice->title' href='$notice->imageUrl'>ดูไฟล์แนบ</a></p>";
					} else {
						echo "<p><a class='fancyFrame' Title='$notice->title' href='$notice->imageUrl'><img src='$notice->imageUrl' width='100px' alt='' /></a></p>";
					}
				}
				?>
																																																				<!--  <p><a class="btn btn-primary" target="_blank" href="<?php echo Yii::app()->createUrl("/notice/view/$notice->noticeId"); ?>">รายละเอียด »</a></p>-->

				<?php
			}
			$i++;
		}
		?>
	</div>
</div>
<?php
/* $user = "kamyjap@gmail.com";
  $pass =	"kamyjapkung";
  Yii::app()->CALENDAR->login($user, $pass); */
?>

<?php
/*
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
 */?>