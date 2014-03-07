<style>
	.chart {
		position: relative;
		display: inline-block;
		width: 265px;
		height: 265px;
		margin-top: 10px;
		margin-bottom: 10px;
		text-align: center;
	}
	.chart canvas {
		position: absolute;
		top: 0;
		left: 0;
	}
	.percent {
		display: inline-block;
		line-height: 265px;
		z-index: 2;
		font-size: 1.8em;
	}
	.percent:after {
		content: '%';
		margin-left: 0.1em;
		font-size: .8em;
	}
</style>
<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

if($summary['percent'] > 80)
{
	$lineColor = '#00aa00';
}
else if($summary['percent'] > 50)
{
	$lineColor = '#ffee00';
}
else
{
	$lineColor = '#ff0000';
}

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/easypiechart/jquery.easypiechart.min.js');
$cs->registerScript('pie', "
$(function() {
    //create instance
    $('.chart').easyPieChart({
        animate: 2000,
		/*onStep: function(from, to, percent) {
			this.el.children[0].innerHTML = Math.round(percent);
		},*/
		size:265,
		barColor:'{$lineColor}',
		lineCap : 'butt',
		lineWidth: 48,
    });
});
");

$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6', CClientScript::POS_HEAD);
$this->pageHeader = $employeeName;
?>

<div class="row-fluid">
	<div class="span3">
		<h3>Summary</h3>
		<div class="chart" data-percent="<?php echo $summary['percent']; ?>">
			<p class="percent"><?php echo $summary['percent']; ?></p>
		</div>
	</div>

	<div class="span9">
		<p class="alert alert-info">
			<i class="icon-upload-alt icon-2x"></i> คลิกเพื่อส่งงาน
		</p>

		<?php foreach($data as $k=> $v): ?>
			<div class="well well-small">
				<h3><?php echo ($k == 1) ? 'Performance' : 'Implement'; ?></h3>

				<?php $i = 0; ?>
				<?php foreach($v as $faf): ?>
					<strong><?php echo $faf['title']; ?></strong>
					<table class="table table-bordered table-striped table-hover" style="font-size:12px;">
						<thead>
							<tr>
								<th></th>
								<th>ม.ค.</th>
								<th>ก.พ.</th>
								<th>มี.ค.</th>
								<th>เม.ย.</th>
								<th>พ.ค.</th>
								<th>มิ.ย.</th>
								<th>ก.ค.</th>
								<th>ส.ค.</th>
								<th>ก.ย.</th>
								<th>ต.ค.</th>
								<th>พ.ย.</th>
								<th>ธ.ค.</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>เป้าหมาย</td>
								<?php foreach($this->targetArray as $target): ?>
									<td>
										<?php echo $faf[$target]; ?>
									</td>
								<?php endforeach; ?>
							</tr>
							<tr>
								<td>ทำได้</td>
								<?php foreach($this->actualArray as $k=> $actual): ?>
									<td>
										<?php
										/*
										  if(!$flag)
										  {
										  if(empty($faf[$actual]) || in_array(Yii::app()->user->getState('username'), array(
										  'kbw',)))
										  {
										  $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
										  'id'=>$actual . 'Dialog' . $i,
										  // additional javascript options for the dialog plugin
										  'options'=>array(
										  'title'=>$actual . 'Dialog' . $i,
										  'autoOpen'=>false,
										  ),
										  ));

										  $this->renderPartial('_updateData', array(
										  'model'=>new FitAndFast,
										  'field'=>$actual,
										  'dialog'=>$actual . 'Dialog' . $i,
										  'span'=>'#' . $actual . $i,
										  'fitAndFastId'=>$faf['fitAndFastId'],
										  'value'=>$faf[$actual],
										  ));

										  $this->endWidget('zii.widgets.jui.CJuiDialog');

										  $randId = uniqid();
										  echo CHtml::link('<i class="icon-pencil"></i>', '#', array(
										  'onclick'=>'$("#' . $actual . 'Dialog' . $i . '").dialog("open"); return false;',
										  'id'=>$randId,
										  ));
										  }
										  }
										 *
										 */
										if(empty($faf[$this->fileArray[$k]]) && !empty($faf[$this->targetArray[$k]]))
										{
											echo CHtml::link('<i class="icon-upload-alt"></i>', $this->createUrl($this->id . '/upload/' . $faf['fitAndFastId'] . '/' . $this->fileArray[$k]), array(
												'class'=>''));
										}
										else
										{
											if($faf[$this->fileArray[$k]])
											{
												echo CHtml::link('<i class="icon-file"></i>', Yii::app()->baseUrl . '/' . $faf[$this->fileArray[$k]], array(
													'class'=>'pdf'));
											}
										}
										?>

										<span id="<?php echo $actual . $i; ?>"><?php echo $faf[$actual]; ?></span>
									</td>
								<?php endforeach; ?>
							</tr>
							<?php
							/*
							 * Grade
							 *
							 */
							?>
							<tr>
								<td>เกรด</td>
								<?php foreach($this->gradeArray as $l=> $grade): ?>
									<td>
										<?php
										/*
										  if(!$flag)
										  {
										  if(empty($faf[$grade]) || in_array(Yii::app()->user->getState('username'), array(
										  'kbw',
										  'npr'
										  )))
										  {
										  $this->renderPartial('_updateGrade', array(
										  'grade'=>$faf[$grade],
										  'sBtnId'=>'s' . ucfirst($grade) . $i,
										  'fBtnId'=>'f' . ucfirst($grade) . $i,
										  'fitAndFastId'=>$faf['fitAndFastId'],
										  'field'=>$grade
										  ));
										  }
										  else
										  {
										  if($faf[$grade] == 'S')
										  echo '<span class="label label-success">S</span>';
										  else
										  echo '<span class="label label-important">F</span>';
										  }
										  }
										  else
										  {
										  if(!empty($faf[$grade]))
										  {
										  if($faf[$grade] == 'S')
										  echo '<span class="label label-success">S</span>';
										  else
										  echo '<span class="label label-important">F</span>';
										  }
										  }
										 */

										if(!empty($faf[$grade]))
										{
											if($faf[$grade] == 'S')
												echo '<span class="label label-success">S</span>';
											else
												echo '<span class="label label-important">F</span>';
										}
										else
										{
											if(!empty($faf[$this->fileArray[$l]]) && !empty($faf[$this->targetArray[$l]]))
											{
												$this->renderPartial('_updateGrade', array(
													'grade'=>$faf[$grade],
													'sBtnId'=>'s' . ucfirst($grade) . $i,
													'fBtnId'=>'f' . ucfirst($grade) . $i,
													'fitAndFastId'=>$faf['fitAndFastId'],
													'field'=>$grade
												));
											}
										}
										?>
									</td>
								<?php endforeach; ?>
							</tr>
							<?php $i++; ?>

						</tbody>
					</table>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>