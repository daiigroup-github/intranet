<style>
	table
	{
		font-size:14pt;
	}

	table td
	{
		width:650px;
	}
</style>

<h1>ส่งให้นาย</h1>

<div class="row">

	<div class="page-header">
		<h1>ประวัติส่วนตัวผู้สมัคร</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			array(
				'name' => 'ชื่อ',
				'value' => CHtml::encode(Employee::model()->employeePrefixTh($model->prefix) . $model->fnTh . ' ' . $model->lnTh . ' / ' . Employee::model()->employeePrefixEN($model->prefix) . $model->fnEn . ' ' . $model->lnEn),
			),
			'appliedPosition',
			'appliedSalary',
			'address',
			'tumbol',
			'aumper',
			array(
				'name' => 'province',
				'value' => Province::model()->getProvinceName($model->province),
			),
			'postcode',
			'otherEmail',
			array(
				'name' => 'livingWith',
				'value' => $model->liveingWithText($model->livingWith),
			),
			array(
				'name' => 'birthDate',
				'value' => $this->dateThai($model->birthDate, 1) . ' (' . floor((strtotime(date('Y-m-d')) - strtotime($model->birthDate)) / 31556926) . ')',
			),
			'race',
			'nationality',
			'religion',
			'height',
			'weight',
			array(
				'name' => 'militaryStatus',
				'value' => $model->militaryStatusText($model->militaryStatus),
			),
			array(
				'name' => 'maritalStatus',
				'value' => $model->maritalStatusText($model->maritalStatus),
			),
		),
	));
	?>

	<div class="page-header">
		<h1>ประวัติครอบครัว</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'dadName',
			'dadAge',
			'dadOccupation',
			'momName',
			'momAge',
			'momOccupation',
			'husbandName',
			'husbandWork',
			'husbandPosition',
			'noOfChildren',
			'noOfMemberFamily',
			'noOfMaleMemberFamily',
			'noOfFemaleMemberFamily',
			'youAreTheChildOfTheFamily',
		),
	));
	?>

	<div class="page-header">
		<h1>การศึกษา</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'EducationHighest',
			'EducationHighestInstitution',
			'EducationHighestMajor',
			'EducationHighestYearEnd',
			'EducationHighSchool',
			'EducationVocational',
			'EducationDiploma',
			'EducationBechelorDegree',
			'EducationOther',
		),
	));
	?>

	<div class="page-header">
		<h1>ประสบการณ์ทำงาน</h1>
	</div>

	<?php $exp = false; ?>

	<?php if ($model->WorkExp1At): ?>
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'htmlOptions' => array(
				'class' => 'table table-bordered table-striped'),
			'attributes' => array(
				'WorkExp1StartEnd',
				'WorkExp1At',
				'WorkExp1Position',
				'WorkExp1ReasonLeaving',
				'WorkExp1SalaryStartEnd',
			),
		));
		?>
		<?php $exp = true; ?>
	<?php endif; ?>

	<?php if ($model->WorkExp2At): ?>
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'htmlOptions' => array(
				'class' => 'table table-bordered table-striped'),
			'attributes' => array(
				array(
					'name' => 'WorkExp1StartEnd',
					'value' => $model->WorkExp2StartEnd,
				),
				array(
					'name' => 'WorkExp1At',
					'value' => $model->WorkExp2At,
				),
				array(
					'name' => 'WorkExp1Position',
					'value' => $model->WorkExp2Position,
				),
				array(
					'name' => 'WorkExp1ReasonLeaving',
					'value' => $model->WorkExp2ReasonLeaving,
				),
				array(
					'name' => 'WorkExp1SalaryStartEnd',
					'value' => $model->WorkExp2SalaryStartEnd,
				),
			),
		));
		?>
		<?php $exp = true; ?>
	<?php endif; ?>

	<?php if ($model->WorkExp3At): ?>
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'htmlOptions' => array(
				'class' => 'table table-bordered table-striped'),
			'attributes' => array(
				'WorkExp3StartEnd',
				'WorkExp3At',
				'WorkExp3Position',
				'WorkExp3ReasonLeaving',
				'WorkExp3SalaryStartEnd',
				array(
					'name' => 'WorkExp1StartEnd',
					'value' => $model->WorkExp3StartEnd,
				),
				array(
					'name' => 'WorkExp1At',
					'value' => $model->WorkExp3At,
				),
				array(
					'name' => 'WorkExp1Position',
					'value' => $model->WorkExp3Position,
				),
				array(
					'name' => 'WorkExp1ReasonLeaving',
					'value' => $model->WorkExp3ReasonLeaving,
				),
				array(
					'name' => 'WorkExp1SalaryStartEnd',
					'value' => $model->WorkExp3SalaryStartEnd,
				),
			),
		));
		?>
		<?php $exp = true; ?>
	<?php endif; ?>

	<?php if ($model->WorkExp4At): ?>
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'htmlOptions' => array(
				'class' => 'table table-bordered table-striped'),
			'attributes' => array(
				array(
					'name' => 'WorkExp1StartEnd',
					'value' => $model->WorkExp4StartEnd,
				),
				array(
					'name' => 'WorkExp1At',
					'value' => $model->WorkExp4At,
				),
				array(
					'name' => 'WorkExp1Position',
					'value' => $model->WorkExp4Position,
				),
				array(
					'name' => 'WorkExp1ReasonLeaving',
					'value' => $model->WorkExp4ReasonLeaving,
				),
				array(
					'name' => 'WorkExp1SalaryStartEnd',
					'value' => $model->WorkExp4SalaryStartEnd,
				),
			),
		));
		?>
		<?php $exp = true; ?>
	<?php endif; ?>

	<?php if ($model->WorkExp5At): ?>
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'htmlOptions' => array(
				'class' => 'table table-bordered table-striped'),
			'attributes' => array(
				array(
					'name' => 'WorkExp1StartEnd',
					'value' => $model->WorkExp5StartEnd,
				),
				array(
					'name' => 'WorkExp1At',
					'value' => $model->WorkExp5At,
				),
				array(
					'name' => 'WorkExp1Position',
					'value' => $model->WorkExp5Position,
				),
				array(
					'name' => 'WorkExp1ReasonLeaving',
					'value' => $model->WorkExp5ReasonLeaving,
				),
				array(
					'name' => 'WorkExp1SalaryStartEnd',
					'value' => $model->WorkExp5SalaryStartEnd,
				),
			),
		));
		?>
		<?php $exp = true; ?>
	<?php endif; ?>

	<?php
	if (!$exp)
		echo "<blockquote><p>ไม่มีประสบการณ์ทำงาน</p></blockquote>";
	?>

	<div class="page-header">
		<h1>ความสามารถพิเศษ</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			array(
				'name' => 'typing',
				'value' => $model->statusText($model->typing),
			),
			'speedTypingTh',
			'speedTypingEn',
			'computerSkill',
			array(
				'name' => 'driving',
				'value' => $model->statusText($model->driving),
			),
			'drivingLicenseNo',
			'officeMachine',
			'hobbies',
			'favouriteSport',
			'spacialKnowledge',
			'other',
			array(
				'name' => 'canWorkUpCountry',
				'value' => $model->statusText($model->canWorkUpCountry),
			),
		),
	));
	?>

	<div class="page-header">
		<h1>ผู้ที่สามารถติดต่อฉุกเฉินได้</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'personAtEmergencyName',
			'personAtEmergencyRelated',
			'personAtEmergencyAddress',
			'personAtEmergencyTel',
			'sourceOfJobInfo',
			array(
				'name' => 'hasBeenSeriouslyOrContractedSick',
				'value' => $model->usedToText($model->hasBeenSeriouslyOrContractedSick),
			),
			'whatSick',
			array(
				'name' => 'everAppliedBefore',
				'value' => $model->usedToText($model->everAppliedBefore),
			),
			'appliedWhen',
		),
	));
	?>

	<div class="page-header">
		<h1>ความสามารถทางภาษา</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			array(
				'name' => 'ภาษาไทย',
				'type' => 'html',
				'value' => '<strong>พูด : </strong>' . $model->langLevelText($model->langThSpeaking) . ', <strong>เขียน : </strong>' . $model->langLevelText($model->langThWriting) . ', <strong>อ่าน : </strong>' . $model->langLevelText($model->langThReading),
			),
			array(
				'name' => 'ภาษาอังกฤษ',
				'type' => 'html',
				'value' => '<strong>พูด : </strong>' . $model->langLevelText($model->langEnSpeaking) . ', <strong>เขียน : </strong>' . $model->langLevelText($model->langEnWriting) . ', <strong>อ่าน : </strong>' . $model->langLevelText($model->langEnReading),
			),
			'langOther',
		),
	));
	?>

	<div class="page-header">
		<h1>ญาติ / เพื่อน ที่ทำงานในบริษัทฯ ที่ท่านรู้จักดี</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'uKnowEmployeeInOffice',
		),
	));
	?>

	<div class="page-header">
		<h1>บุคคลอ้างอิง 2 คน ที่รู้จักคุ้นเคยตัวท่านดี ซึ่งไม่ใช่ญาติ หรือเจ้านายเก่า</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'NameAddressOfRelatedPeople1',
			'NameAddressOfRelatedPeople2',
		),
	));
	?>

	<div class="page-header">
		<h1>แนะนำตัวท่านเอง เพื่อให้บริษัทรู้จักตัวท่านดีขึ้น</h1>
	</div>

	<?php
	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'htmlOptions' => array(
			'class' => 'table table-bordered table-striped'),
		'attributes' => array(
			'introductionOfU',
		),
	));
	?>

	<?php
	echo $this->renderPartial('_scoreSummaryForm', array(
		'model' => $model,
		'exam' => $exam,
		'appInter' => $appInter));
	?>

</div>