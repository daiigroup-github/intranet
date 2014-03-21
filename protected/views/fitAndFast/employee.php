<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

$flag = true;

if(Yii::app()->controller->id == 'fitAndFast')
{
	$this->breadcrumbs = array(
		'Fit And Fasts'=>Yii::app()->createUrl('/fitAndFast'),
		'Division'=>Yii::app()->createUrl('/fitAndFast/division/' . $companyId . '/' . $companyDivisionId),
	);

	$flag = false;
}
else
{
	$this->breadcrumbs = array(
		'Fit And Fasts'=>Yii::app()->request->urlReferrer,
		'Division',
	);
}

$actualArray = array(
	'actualJan',
	'actualFeb',
	'actualMar',
	'actualApr',
	'actualMay',
	'actualJun',
	'actualJul',
	'actualAug',
	'actualSep',
	'actualOct',
	'actualNov',
	'actualDec'
);
$gradeArary = array(
	'gradeJan',
	'gradeFeb',
	'gradeMar',
	'gradeApr',
	'gradeMay',
	'gradeJun',
	'gradeJul',
	'gradeAug',
	'gradeSep',
	'gradeOct',
	'gradeNov',
	'gradeDec'
);
$targetArray = array(
	'targetJan',
	'targetFeb',
	'targetMar',
	'targetApr',
	'targetMay',
	'targetJun',
	'targetJul',
	'targetAug',
	'targetSep',
	'targetOct',
	'targetNov',
	'targetDec'
);
?>

<style>
</style>

<div class="row-fluid">
	<div class="span12">
		<h3><?php echo $employeeName; ?></h3>

		<table class="table table-bordered table-striped table-hover" style="font-size:12px;">
			<thead>
				<tr>
					<th colspan="2"></th>
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
				<?php $i = 0; ?>
				<?php foreach($data as $faf): ?>
					<tr>
						<td rowspan="3" style="vertical-align: middle;"><?php echo $faf['title']; ?></td>
						<td>เป้าหมาย</td>
						<?php foreach($targetArray as $target): ?>
							<td>
								<?php echo $faf[$target]; ?>
							</td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<td>ทำได้</td>
						<?php foreach($actualArray as $actual): ?>
							<td>
								<?php
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
						<?php foreach($gradeArary as $grade): ?>
							<td>
								<?php
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
								?>
							</td>
						<?php endforeach; ?>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>