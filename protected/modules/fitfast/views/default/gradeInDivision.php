<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

$this->pageHeader = 'รายการรอให้เกรดของพนักงานในฝ่าย';

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6', CClientScript::POS_HEAD);
?>

<div class="row">
	<!-- block -->
	<div class="span9">
		<ul class="thumbnails">
			<?php foreach($res as $employee): ?>
				<li class="span3">
					<div class="thumbnail">
						<h4><?php echo $employee['name']; ?></h4>

						<?php foreach($employee['fitAndFast'] as $fitAndFastId=> $fitAndFast): ?>
							<div>
								<strong><?php echo $fitAndFast['title']; ?></strong>
								<?php foreach($fitAndFast['data'] as $data): ?>
									<div class="alert">
										<?php
										echo 'เป้าหมาย : ' . $data['target'] . ' ';

										$this->renderPartial('_updateGrade', array(
											'grade'=>NULL,
											'fitAndFastId'=>$fitAndFastId,
											'field'=>$data['gradeMonth'],
											'type'=>$data['type'],
											'btnId'=>ucfirst($data['gradeMonth']) . $fitAndFastId,
										));
										echo '<br />';
										echo 'ไฟล์งาน : ' . CHtml::link('<i class="icon-file"></i>' . $data['fileDateTime'], Yii::app()->baseUrl . '/' . $data['fileName'], array(
											'class'=>'pdf'));
										?>
									</div>
								<?php endforeach; ?>
							</div>
							<hr />
						<?php endforeach; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<!-- /block -->
</div>
