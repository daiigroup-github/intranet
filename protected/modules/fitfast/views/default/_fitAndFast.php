<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2', CClientScript::POS_HEAD);
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2', CClientScript::POS_HEAD);
?>
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
											'class'=>'fancyFrame'));
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
<?php
endforeach;
