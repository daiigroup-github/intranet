<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php
		echo $form->textField($model, 'id', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'employeeId'); ?>
		<?php
		echo $form->textField($model, 'employeeId', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'appliedPosition'); ?>
		<?php
		echo $form->textField($model, 'appliedPosition', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'appliedSalary'); ?>
		<?php
		echo $form->textField($model, 'appliedSalary', array(
			'size'=>16,
			'maxlength'=>16));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address'); ?>
		<?php
		echo $form->textField($model, 'address', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tumbol'); ?>
		<?php
		echo $form->textField($model, 'tumbol', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'aumper'); ?>
		<?php
		echo $form->textField($model, 'aumper', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'province'); ?>
		<?php
		echo $form->textField($model, 'province', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'postcode'); ?>
		<?php
		echo $form->textField($model, 'postcode', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'otherEmail'); ?>
		<?php
		echo $form->textField($model, 'otherEmail', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'livingWith'); ?>
		<?php echo $form->textField($model, 'livingWith'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'race'); ?>
		<?php
		echo $form->textField($model, 'race', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'nationality'); ?>
		<?php
		echo $form->textField($model, 'nationality', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'religion'); ?>
		<?php
		echo $form->textField($model, 'religion', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'height'); ?>
		<?php
		echo $form->textField($model, 'height', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'weight'); ?>
		<?php
		echo $form->textField($model, 'weight', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'militaryStatus'); ?>
		<?php echo $form->textField($model, 'militaryStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'maritalStatus'); ?>
		<?php echo $form->textField($model, 'maritalStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dadName'); ?>
		<?php
		echo $form->textField($model, 'dadName', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dadAge'); ?>
		<?php
		echo $form->textField($model, 'dadAge', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dadOccupation'); ?>
		<?php
		echo $form->textField($model, 'dadOccupation', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'momName'); ?>
		<?php
		echo $form->textField($model, 'momName', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'momAge'); ?>
		<?php
		echo $form->textField($model, 'momAge', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'momOccupation'); ?>
		<?php
		echo $form->textField($model, 'momOccupation', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'husbandName'); ?>
		<?php
		echo $form->textField($model, 'husbandName', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'husbandWork'); ?>
		<?php
		echo $form->textField($model, 'husbandWork', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'husbandPosition'); ?>
		<?php
		echo $form->textField($model, 'husbandPosition', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noOfChildren'); ?>
		<?php echo $form->textField($model, 'noOfChildren'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noOfMemberFamily'); ?>
		<?php
		echo $form->textField($model, 'noOfMemberFamily', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noOfMaleMemberFamily'); ?>
		<?php
		echo $form->textField($model, 'noOfMaleMemberFamily', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'noOfFemaleMemberFamily'); ?>
		<?php
		echo $form->textField($model, 'noOfFemaleMemberFamily', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'youAreTheChildOfTheFamily'); ?>
		<?php
		echo $form->textField($model, 'youAreTheChildOfTheFamily', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationHighest'); ?>
		<?php
		echo $form->textField($model, 'EducationHighest', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationHighestInstitution'); ?>
		<?php
		echo $form->textField($model, 'EducationHighestInstitution', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationHighestMajor'); ?>
		<?php
		echo $form->textField($model, 'EducationHighestMajor', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationHighestYearEnd'); ?>
		<?php
		echo $form->textField($model, 'EducationHighestYearEnd', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationHighSchool'); ?>
		<?php
		echo $form->textField($model, 'EducationHighSchool', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationVocational'); ?>
		<?php
		echo $form->textField($model, 'EducationVocational', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationDiploma'); ?>
		<?php
		echo $form->textField($model, 'EducationDiploma', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationBechelorDegree'); ?>
		<?php
		echo $form->textField($model, 'EducationBechelorDegree', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'EducationOther'); ?>
		<?php
		echo $form->textField($model, 'EducationOther', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp1StartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp1StartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp1At'); ?>
		<?php
		echo $form->textField($model, 'WorkExp1At', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp1Position'); ?>
		<?php
		echo $form->textField($model, 'WorkExp1Position', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp1ReasonLeaving'); ?>
		<?php
		echo $form->textField($model, 'WorkExp1ReasonLeaving', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp1SalaryStartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp1SalaryStartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp2StartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp2StartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp2At'); ?>
		<?php
		echo $form->textField($model, 'WorkExp2At', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp2Position'); ?>
		<?php
		echo $form->textField($model, 'WorkExp2Position', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp2ReasonLeaving'); ?>
		<?php
		echo $form->textField($model, 'WorkExp2ReasonLeaving', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp2SalaryStartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp2SalaryStartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp3StartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp3StartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp3At'); ?>
		<?php
		echo $form->textField($model, 'WorkExp3At', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp3Position'); ?>
		<?php
		echo $form->textField($model, 'WorkExp3Position', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp3ReasonLeaving'); ?>
		<?php
		echo $form->textField($model, 'WorkExp3ReasonLeaving', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp3SalaryStartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp3SalaryStartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp4StartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp4StartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp4At'); ?>
		<?php
		echo $form->textField($model, 'WorkExp4At', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp4Position'); ?>
		<?php
		echo $form->textField($model, 'WorkExp4Position', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp4ReasonLeaving'); ?>
		<?php
		echo $form->textField($model, 'WorkExp4ReasonLeaving', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp4SalaryStartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp4SalaryStartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp5StartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp5StartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp5At'); ?>
		<?php
		echo $form->textField($model, 'WorkExp5At', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp5Position'); ?>
		<?php
		echo $form->textField($model, 'WorkExp5Position', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp5ReasonLeaving'); ?>
		<?php
		echo $form->textField($model, 'WorkExp5ReasonLeaving', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'WorkExp5SalaryStartEnd'); ?>
		<?php
		echo $form->textField($model, 'WorkExp5SalaryStartEnd', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'typing'); ?>
		<?php echo $form->textField($model, 'typing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'speedTypingTh'); ?>
		<?php
		echo $form->textField($model, 'speedTypingTh', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'speedTypingEn'); ?>
		<?php
		echo $form->textField($model, 'speedTypingEn', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'computerSkill'); ?>
		<?php
		echo $form->textField($model, 'computerSkill', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'driving'); ?>
		<?php echo $form->textField($model, 'driving'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'drivingLicenseNo'); ?>
		<?php
		echo $form->textField($model, 'drivingLicenseNo', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'officeMachine'); ?>
		<?php echo $form->textField($model, 'officeMachine'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hobbies'); ?>
		<?php
		echo $form->textField($model, 'hobbies', array(
			'size'=>60,
			'maxlength'=>300));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'favouriteSport'); ?>
		<?php
		echo $form->textField($model, 'favouriteSport', array(
			'size'=>60,
			'maxlength'=>300));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'spacialKnowledge'); ?>
		<?php
		echo $form->textField($model, 'spacialKnowledge', array(
			'size'=>60,
			'maxlength'=>300));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'other'); ?>
		<?php
		echo $form->textField($model, 'other', array(
			'size'=>60,
			'maxlength'=>300));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'canWorkUpCountry'); ?>
		<?php echo $form->textField($model, 'canWorkUpCountry'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'personAtEmergencyName'); ?>
		<?php
		echo $form->textField($model, 'personAtEmergencyName', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'personAtEmergencyRelated'); ?>
		<?php
		echo $form->textField($model, 'personAtEmergencyRelated', array(
			'size'=>60,
			'maxlength'=>100));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'personAtEmergencyAddress'); ?>
		<?php
		echo $form->textField($model, 'personAtEmergencyAddress', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'personAtEmergencyTel'); ?>
		<?php
		echo $form->textField($model, 'personAtEmergencyTel', array(
			'size'=>20,
			'maxlength'=>20));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sourceOfJobInfo'); ?>
		<?php
		echo $form->textField($model, 'sourceOfJobInfo', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hasBeenSeriouslyOrContractedSick'); ?>
		<?php echo $form->textField($model, 'hasBeenSeriouslyOrContractedSick'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'whatSick'); ?>
		<?php
		echo $form->textField($model, 'whatSick', array(
			'size'=>60,
			'maxlength'=>300));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'everAppliedBefore'); ?>
		<?php echo $form->textField($model, 'everAppliedBefore'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'appliedWhen'); ?>
		<?php
		echo $form->textField($model, 'appliedWhen', array(
			'size'=>45,
			'maxlength'=>45));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langThSpeaking'); ?>
		<?php echo $form->textField($model, 'langThSpeaking'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langThWriting'); ?>
		<?php echo $form->textField($model, 'langThWriting'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langThReading'); ?>
		<?php echo $form->textField($model, 'langThReading'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langEnSpeaking'); ?>
		<?php echo $form->textField($model, 'langEnSpeaking'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langEnWriting'); ?>
		<?php echo $form->textField($model, 'langEnWriting'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langEnReading'); ?>
		<?php echo $form->textField($model, 'langEnReading'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'langOther'); ?>
		<?php
		echo $form->textField($model, 'langOther', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'uKnowEmployeeInOffice'); ?>
		<?php
		echo $form->textField($model, 'uKnowEmployeeInOffice', array(
			'size'=>60,
			'maxlength'=>200));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NameAddressOfRelatedPeople1'); ?>
		<?php
		echo $form->textField($model, 'NameAddressOfRelatedPeople1', array(
			'size'=>60,
			'maxlength'=>2000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'NameAddressOfRelatedPeople2'); ?>
		<?php
		echo $form->textField($model, 'NameAddressOfRelatedPeople2', array(
			'size'=>60,
			'maxlength'=>2000));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'introductionOfU'); ?>
		<?php
		echo $form->textField($model, 'introductionOfU', array(
			'size'=>60,
			'maxlength'=>2000));
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->