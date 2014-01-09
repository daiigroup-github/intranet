<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui/js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery/jquery.ui.all.css" />

<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfofo */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('birthDatePicker', "
	$(function(){
		$('#birthDatePicker').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
		});
	});
");
?>

<script type="text/javascript">
	function enableSubmitBtn(element)
	{
		var checked = $(element).is(':checked');

		if(!checked)
		{
			$('#submitBtn').attr('disabled', 'disabled');
		}
		else
		{
			$('#submitBtn').removeAttr('disabled');
		}
	}
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'employee-info-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal'),
	));
?>

<p class="note">กรอกข้อมูลที่มี <span class="required">*</span> ให้ครบถ้วน</p>
<?php
echo $form->errorSummary($model, 'โปรดแก้ไขข้อผิดพลาดทางด้านล่าง :', '', array(
	'class'=>'alert alert-danger'));
?>
<?php //echo $form->errorSummary($model, 'โปรดแก้ไขข้อผิดพลาดทางด้านล่าง :', '', array('class'=>'alert alert-danger')); ?>
<?php echo $form->error($model, 'fnTh'); ?>

<?php $form->error($model, 'appliedPosition'); ?>
<?php $form->error($model, 'appliedSalary'); ?>
<?php $form->error($model, 'address'); ?>
<?php $form->error($model, 'tumbol'); ?>
<?php $form->error($model, 'aumper'); ?>
<?php $form->error($model, 'province'); ?>
<?php $form->error($model, 'postcode'); ?>
<?php $form->error($model, 'otherEmail'); ?>
<?php $form->error($model, 'livingWith'); ?>
<?php $form->error($model, 'birthDate'); ?>
<?php $form->error($model, 'race'); ?>
<?php $form->error($model, 'nationality'); ?>
<?php $form->error($model, 'religion'); ?>
<?php $form->error($model, 'height'); ?>
<?php $form->error($model, 'weight'); ?>
<?php $form->error($model, 'militaryStatus'); ?>
<?php $form->error($model, 'maritalStatus'); ?>
<?php $form->error($model, 'dadName'); ?>
<?php $form->error($model, 'dadAge'); ?>
<?php $form->error($model, 'dadOccupation'); ?>
<?php $form->error($model, 'momName'); ?>
<?php $form->error($model, 'momAge'); ?>
<?php $form->error($model, 'momOccupation'); ?>
<?php $form->error($model, 'husbandName'); ?>
<?php $form->error($model, 'husbandWork'); ?>
<?php $form->error($model, 'husbandPosition'); ?>
<?php $form->error($model, 'noOfChildren'); ?>
<?php $form->error($model, 'noOfMemberFamily'); ?>
<?php $form->error($model, 'noOfMaleMemberFamily'); ?>
<?php $form->error($model, 'noOfFemaleMemberFamily'); ?>
<?php $form->error($model, 'youAreTheChildOfTheFamily'); ?>
<?php $form->error($model, 'EducationHighest'); ?>
<?php $form->error($model, 'EducationHighestInstitution'); ?>
<?php $form->error($model, 'EducationHighestMajor'); ?>
<?php $form->error($model, 'EducationHighestYearEnd'); ?>
<?php $form->error($model, 'EducationHighSchool'); ?>
<?php $form->error($model, 'EducationVocational'); ?>
<?php $form->error($model, 'EducationDiploma'); ?>
<?php $form->error($model, 'EducationBechelorDegree'); ?>
<?php $form->error($model, 'EducationOther'); ?>
<?php $form->error($model, 'WorkExp1StartEnd'); ?>
<?php $form->error($model, 'WorkExp1At'); ?>
<?php $form->error($model, 'WorkExp1Position'); ?>
<?php $form->error($model, 'WorkExp1ReasonLeaving'); ?>
<?php $form->error($model, 'WorkExp1SalaryStartEnd'); ?>
<?php $form->error($model, 'WorkExp2StartEnd'); ?>
<?php $form->error($model, 'WorkExp2At'); ?>
<?php $form->error($model, 'WorkExp2Position'); ?>
<?php $form->error($model, 'WorkExp2ReasonLeaving'); ?>
<?php $form->error($model, 'WorkExp2SalaryStartEnd'); ?>
<?php $form->error($model, 'WorkExp3StartEnd'); ?>
<?php $form->error($model, 'WorkExp3At'); ?>
<?php $form->error($model, 'WorkExp3Position'); ?>
<?php $form->error($model, 'WorkExp3ReasonLeaving'); ?>
<?php $form->error($model, 'WorkExp3SalaryStartEnd'); ?>
<?php $form->error($model, 'WorkExp4StartEnd'); ?>
<?php $form->error($model, 'WorkExp4At'); ?>
<?php $form->error($model, 'WorkExp4Position'); ?>
<?php $form->error($model, 'WorkExp4ReasonLeaving'); ?>
<?php $form->error($model, 'WorkExp4SalaryStartEnd'); ?>
<?php $form->error($model, 'WorkExp5StartEnd'); ?>
<?php $form->error($model, 'WorkExp5At'); ?>
<?php $form->error($model, 'WorkExp5Position'); ?>
<?php $form->error($model, 'WorkExp5ReasonLeaving'); ?>
<?php $form->error($model, 'WorkExp5SalaryStartEnd'); ?>
<?php $form->error($model, 'typing'); ?>
<?php $form->error($model, 'speedTypingTh'); ?>
<?php $form->error($model, 'speedTypingEn'); ?>
<?php $form->error($model, 'computerSkill'); ?>
<?php $form->error($model, 'driving'); ?>
<?php $form->error($model, 'drivingLicenseNo'); ?>
<?php $form->error($model, 'officeMachine'); ?>
<?php $form->error($model, 'hobbies'); ?>
<?php $form->error($model, 'favouriteSport'); ?>
<?php $form->error($model, 'spacialKnowledge'); ?>
<?php $form->error($model, 'other'); ?>
<?php $form->error($model, 'canWorkUpCountry'); ?>
<?php $form->error($model, 'personAtEmergencyName'); ?>
<?php $form->error($model, 'personAtEmergencyRelated'); ?>
<?php $form->error($model, 'personAtEmergencyAddress'); ?>
<?php $form->error($model, 'personAtEmergencyTel'); ?>
<?php $form->error($model, 'sourceOfJobInfo'); ?>
<?php $form->error($model, 'hasBeenSeriouslyOrContractedSick'); ?>
<?php $form->error($model, 'whatSick'); ?>
<?php $form->error($model, 'everAppliedBefore'); ?>
<?php $form->error($model, 'appliedWhen'); ?>
<?php $form->error($model, 'langThSpeaking'); ?>
<?php $form->error($model, 'langThWriting'); ?>
<?php $form->error($model, 'langThReading'); ?>
<?php $form->error($model, 'langEnSpeaking'); ?>
<?php $form->error($model, 'langEnWriting'); ?>
<?php $form->error($model, 'langEnReading'); ?>
<?php $form->error($model, 'langOther'); ?>
<?php $form->error($model, 'uKnowEmployeeInfoOffice'); ?>
<?php $form->error($model, 'NameAddressOfRelatedPeople1'); ?>
<?php $form->error($model, 'NameAddressOfRelatedPeople2'); ?>
<?php $form->error($model, 'introductionOfU'); ?>

<fieldset>

	<legend>ประวัติส่วนตัว</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'prefix'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'prefix', Employee::model()->getEmployeePrefix(), array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'gender'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'gender', Employee::model()->getEmployeeGender(), array(
				'class'=>'input-small'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fnTh'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'fnTh', array(
				'placeholder'=>'ชื่อ',
				'class'=>'input-medium'));
			?>
			<?php
			echo $form->textField($model, 'lnTh', array(
				'placeholder'=>'นามสกุล',
				'class'=>'input-medium'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'fnEn'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'fnEn', array(
				'placeholder'=>'First Name',
				'class'=>'input-medium'));
			?>
			<?php
			echo $form->textField($model, 'lnEn', array(
				'placeholder'=>'Last Name',
				'class'=>'input-medium'));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'nickName'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'nickName', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'citizenId'); ?></label>
		<div class="controls"><?php
			//echo $form->textField($model,'citizenId');
			echo $form->hiddenField($model, 'citizenId');
			echo $model->citizenId;
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'mobile'); ?></label>
		<div class="controls"><?php echo $form->textField($model, 'mobile'); ?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'appliedPosition'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'appliedPosition', array(
				'size'=>60,
				'maxlength'=>200));
			?> <span class="help-block">ตัวอย่าง : ตำแหน่งที่ 1, ตำแหน่งที่ 2, ...</span></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'appliedSalary'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'appliedSalary', array(
				'size'=>16,
				'maxlength'=>16));
			?> <span class="help-block">ตัวอย่าง : 10,000 หรือ 10,000 - 20,000</span></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'address'); ?></label>
		<div class="controls"><?php
			echo $form->textArea($model, 'address', array(
				'size'=>60,
				'maxlength'=>1000));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'tumbol'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'tumbol', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'aumper'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'aumper', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'province'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'province', Province::model()->getAllProvince(), array(
				'prompt'=>'-'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'postcode'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'postcode', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'otherEmail'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'otherEmail', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'birthDate'); ?></label>
		<div class="controls"><?php
			//echo $form->textField($model,'birthDate', array('class'=>'input-small'));
			echo $form->textField($model, 'birthDate', array(
				'id'=>'birthDatePicker'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'race'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'race', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'nationality'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'nationality', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'religion'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'religion', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'height'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'height', array(
				'class'=>'input-mini'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'weight'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'weight', array(
				'class'=>'input-mini'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'militaryStatus'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'militaryStatus', $model->getEmployeeInfoMilitaryStatus(), array(
				'prompt'=>'-',
				'class'=>'input-medium'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'maritalStatus'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'maritalStatus', $model->getEmployeeInfoMaritalStatus(), array(
				'prompt'=>'-',
				'class'=>'input-medium'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'livingWith'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'livingWith', $model->getEmployeeInfoLivingWith(), array(
				'prompt'=>'-',
				'class'=>'input-medium'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'sourceOfJobInfo'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'sourceOfJobInfo', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'hasBeenSeriouslyOrContractedSick'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'hasBeenSeriouslyOrContractedSick', $model->getEmployeeInfoUsedTo(), array(
				'prompt'=>'-',
				'class'=>'input-mini'));
			?>&nbsp;&nbsp;
			ถ้าเคยโปรดระบุ <?php
			echo $form->textField($model, 'whatSick', array(
				'size'=>60,
				'maxlength'=>300));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'everAppliedBefore'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'everAppliedBefore', $model->getEmployeeInfoUsedTo(), array(
				'prompt'=>'-',
				'class'=>'input-mini'));
			?>&nbsp;&nbsp;
			ถ้าเคย เมื่อไร <?php
			echo $form->textField($model, 'appliedWhen', array(
				'class'=>'input-small'));
			?>
		</div>
	</div>

	<?php
	/**
	 *
	 */
	?>
	<legend>ประวัติครอบครัว</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'dadName'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'dadName', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'dadAge'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'dadAge', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'dadOccupation'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'dadOccupation', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'momName'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'momName', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'momAge'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'momAge', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'momOccupation'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'momOccupation', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'husbandName'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'husbandName', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'husbandWork'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'husbandWork', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'husbandPosition'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'husbandPosition', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'noOfChildren'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'noOfChildren', array(
				'class'=>'input-small',
				'value'=>''));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'noOfMemberFamily'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'noOfMemberFamily', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'noOfMaleMemberFamily'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'noOfMaleMemberFamily', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'noOfFemaleMemberFamily'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'noOfFemaleMemberFamily', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'youAreTheChildOfTheFamily'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'youAreTheChildOfTheFamily', array(
				'class'=>'input-small'));
			?></div>
	</div>

	<legend>การศึกษา</legend>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'EducationHighest'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'EducationHighest', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'EducationHighestInstitution'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'EducationHighestInstitution', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'EducationHighestMajor'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'EducationHighestMajor', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'EducationHighestYearEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'EducationHighestYearEnd', array(
					'size'=>45,
					'maxlength'=>45));
				?></div>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'EducationBechelorDegree'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'EducationBechelorDegree', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'EducationHighSchool'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'EducationHighSchool', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'EducationVocational'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'EducationVocational', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'EducationDiploma'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'EducationDiploma', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'EducationOther'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'EducationOther', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<legend>ประสบการณ์ทำงาน</legend>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1StartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp1StartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?> <span class="help-block">ตัวอย่าง : มิ.ย. 2550 - มิ.ย. 2555</span></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1At'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp1At', array(
					'size'=>60,
					'maxlength'=>200));
				?> <span class="help-block">ตัวอย่าง : บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</span></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1Position'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp1Position', array(
					'size'=>60,
					'maxlength'=>200));
				?> <span class="help-block">ตัวอย่าง : ประสานงาน</span></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1ReasonLeaving'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp1ReasonLeaving', array(
					'size'=>60,
					'maxlength'=>500));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1SalaryStartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp1SalaryStartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?> <span class="help-block">ตัวอย่าง : 8,000 - 18,000</span></div>
		</div>
	</div>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1StartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp2StartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1At'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp2At', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1Position'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp2Position', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1ReasonLeaving'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp2ReasonLeaving', array(
					'size'=>60,
					'maxlength'=>500));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1SalaryStartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp2SalaryStartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>
	</div>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1StartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp3StartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1At'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp3At', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1Position'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp3Position', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1ReasonLeaving'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp3ReasonLeaving', array(
					'size'=>60,
					'maxlength'=>500));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1SalaryStartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp3SalaryStartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>
	</div>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1StartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp4StartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1At'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp4At', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1Position'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp4Position', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1ReasonLeaving'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp4ReasonLeaving', array(
					'size'=>60,
					'maxlength'=>500));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1SalaryStartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp4SalaryStartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>
	</div>

	<div class="well">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1StartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp5StartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1At'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp5At', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1Position'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp5Position', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1ReasonLeaving'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp5ReasonLeaving', array(
					'size'=>60,
					'maxlength'=>500));
				?></div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'WorkExp1SalaryStartEnd'); ?></label>
			<div class="controls"><?php
				echo $form->textField($model, 'WorkExp5SalaryStartEnd', array(
					'size'=>60,
					'maxlength'=>200));
				?></div>
		</div>
	</div>

	<legend>ความสามารถ</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'typing'); ?></label>
		<div class="controls">
			<?php
			echo $form->dropDownList($model, 'typing', $model->getEmployeeInfoStatus(), array(
				'prompt'=>'-',
				'class'=>'input-mini'));
			?>&nbsp;&nbsp;
			ไทย <?php
			echo $form->textField($model, 'speedTypingTh', array(
				'class'=>'input-mini'));
			?> คำ/นาที&nbsp;&nbsp;
			อังกฤษ <?php
			echo $form->textField($model, 'speedTypingEn', array(
				'class'=>'input-mini'));
			?> คำ/นาที
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'computerSkill'); ?></label>
		<div class="controls"><?php echo $form->textField($model, 'computerSkill'); ?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'driving'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'driving', $model->getEmployeeInfoStatus(), array(
				'prompt'=>'-',
				'class'=>'input-mini'));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'drivingLicenseNo'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'drivingLicenseNo', array(
				'size'=>45,
				'maxlength'=>45));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'officeMachine'); ?></label>
		<div class="controls"><?php echo $form->textField($model, 'officeMachine'); ?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'hobbies'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'hobbies', array(
				'size'=>60,
				'maxlength'=>300));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'favouriteSport'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'favouriteSport', array(
				'size'=>60,
				'maxlength'=>300));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'spacialKnowledge'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'spacialKnowledge', array(
				'size'=>60,
				'maxlength'=>300));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'other'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'other', array(
				'size'=>60,
				'maxlength'=>300));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'canWorkUpCountry'); ?></label>
		<div class="controls"><?php
			echo $form->dropDownList($model, 'canWorkUpCountry', $model->getEmployeeInfoStatus(), array(
				'prompt'=>'-',
				'class'=>'input-mini'));
			?></div>
	</div>

	<legend>ผู้ที่สามารถติดต่อฉุกเฉินได้</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'personAtEmergencyName'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'personAtEmergencyName', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'personAtEmergencyRelated'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'personAtEmergencyRelated', array(
				'size'=>60,
				'maxlength'=>100));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'personAtEmergencyAddress'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'personAtEmergencyAddress', array(
				'size'=>60,
				'maxlength'=>1000));
			?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'personAtEmergencyTel'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'personAtEmergencyTel', array(
				'size'=>20,
				'maxlength'=>20));
			?></div>
	</div>

	<legend>ความสามารถทางภาษา</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'langTh'); ?></label>
		<div class="controls">
			พูด : <?php
			echo $form->dropDownList($model, 'langThSpeaking', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
			อ่าน : <?php
			echo $form->dropDownList($model, 'langThReading', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
			เขียน : <?php
			echo $form->dropDownList($model, 'langThWriting', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'langEn'); ?></label>
		<div class="controls">
			พูด : <?php
			echo $form->dropDownList($model, 'langEnSpeaking', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
			อ่าน : <?php
			echo $form->dropDownList($model, 'langEnReading', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
			เขียน : <?php
			echo $form->dropDownList($model, 'langEnWriting', $model->getEmployeeInfoLangLevel(), array(
				'prompt'=>'-',
				'class'=>'input-small'))
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'langOther'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'langOther', array(
				'size'=>60,
				'maxlength'=>500));
			?></div>
	</div>

	<legend>ญาติ / เพื่อน ที่ทำงานในบริษัทฯ ที่ท่านรู้จักดี</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'uKnowEmployeeInOffice'); ?></label>
		<div class="controls"><?php
			echo $form->textField($model, 'uKnowEmployeeInOffice', array(
				'size'=>60,
				'maxlength'=>200));
			?></div>
	</div>

	<legend>บุคคลอ้างอิง 2 คน ที่รู้จักคุ้นเคยตัวท่านดี ซึ่งไม่ใช่ญาติ หรือเจ้านายเก่า</legend>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'NameAddressOfRelatedPeople1'); ?></label>
		<div class="controls"><?php echo $form->textArea($model, 'NameAddressOfRelatedPeople1'); ?></div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'NameAddressOfRelatedPeople2'); ?></label>
		<div class="controls"><?php echo $form->textArea($model, 'NameAddressOfRelatedPeople2'); ?></div>
	</div>

	<legend>แนะนำตัวท่านเอง เพื่อให้บริษัทรู้จักตัวท่านดีขึ้น</legend>

	<div class="control-group">
		<div class="controls">
			<?php echo $form->textArea($model, 'introductionOfU'); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<?php
				echo $form->checkBox($model, 'accept', array(
					'onchange'=>'enableSubmitBtn(this);'));
				?> <?php echo $form->labelEx($model, 'accept'); ?>
			</label>
		</div>
	</div>

	<div class="form-actions">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class'=>'btn btn-primary',
			'id'=>'submitBtn',
			'disabled'=>'disabled'));
		?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>