<?php
/* @var $this ApplicationController */
/* @var $data EmployeeInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->ID), array(
		'view',
		'id'=>$data->ID));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appliedProsition')); ?>:</b>
	<?php echo CHtml::encode($data->appliedProsition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appliedSalary')); ?>:</b>
	<?php echo CHtml::encode($data->appliedSalary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tumbol')); ?>:</b>
	<?php echo CHtml::encode($data->tumbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aumper')); ?>:</b>
	<?php echo CHtml::encode($data->aumper); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
	  <?php echo CHtml::encode($data->province); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('postcode')); ?>:</b>
	  <?php echo CHtml::encode($data->postcode); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('otherEmail')); ?>:</b>
	  <?php echo CHtml::encode($data->otherEmail); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('livingWith')); ?>:</b>
	  <?php echo CHtml::encode($data->livingWith); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('age')); ?>:</b>
	  <?php echo CHtml::encode($data->age); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('race')); ?>:</b>
	  <?php echo CHtml::encode($data->race); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('nationality')); ?>:</b>
	  <?php echo CHtml::encode($data->nationality); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('religion')); ?>:</b>
	  <?php echo CHtml::encode($data->religion); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	  <?php echo CHtml::encode($data->height); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	  <?php echo CHtml::encode($data->weight); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('militaryStatus')); ?>:</b>
	  <?php echo CHtml::encode($data->militaryStatus); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('maritalStatus')); ?>:</b>
	  <?php echo CHtml::encode($data->maritalStatus); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('dadName')); ?>:</b>
	  <?php echo CHtml::encode($data->dadName); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('dadAge')); ?>:</b>
	  <?php echo CHtml::encode($data->dadAge); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('dadOccupation')); ?>:</b>
	  <?php echo CHtml::encode($data->dadOccupation); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('momName')); ?>:</b>
	  <?php echo CHtml::encode($data->momName); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('momAge')); ?>:</b>
	  <?php echo CHtml::encode($data->momAge); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('momOccupation')); ?>:</b>
	  <?php echo CHtml::encode($data->momOccupation); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('husbandName')); ?>:</b>
	  <?php echo CHtml::encode($data->husbandName); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('husbandWork')); ?>:</b>
	  <?php echo CHtml::encode($data->husbandWork); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('husbandPosition')); ?>:</b>
	  <?php echo CHtml::encode($data->husbandPosition); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('noOfChildren')); ?>:</b>
	  <?php echo CHtml::encode($data->noOfChildren); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('noOfMemberFamily')); ?>:</b>
	  <?php echo CHtml::encode($data->noOfMemberFamily); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('noOfMaleMemberFamily')); ?>:</b>
	  <?php echo CHtml::encode($data->noOfMaleMemberFamily); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('noOfFemaleMemberFamily')); ?>:</b>
	  <?php echo CHtml::encode($data->noOfFemaleMemberFamily); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('youAreTheChildOfTheFamily')); ?>:</b>
	  <?php echo CHtml::encode($data->youAreTheChildOfTheFamily); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationHighest')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationHighest); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationHighestInstitution')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationHighestInstitution); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationHighestMajor')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationHighestMajor); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationHighestYearEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationHighestYearEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationHighSchool')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationHighSchool); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationVocational')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationVocational); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationDiploma')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationDiploma); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationBechelorDegree')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationBechelorDegree); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('EducationOther')); ?>:</b>
	  <?php echo CHtml::encode($data->EducationOther); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp1StartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp1StartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp1At')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp1At); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp1Position')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp1Position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp1ReasonLeaving')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp1ReasonLeaving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp1SalaryStartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp1SalaryStartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp2StartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp2StartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp2At')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp2At); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp2Position')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp2Position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp2ReasonLeaving')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp2ReasonLeaving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp2SalaryStartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp2SalaryStartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp3StartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp3StartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp3At')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp3At); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp3Position')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp3Position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp3ReasonLeaving')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp3ReasonLeaving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp3SalaryStartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp3SalaryStartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp4StartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp4StartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp4At')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp4At); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp4Position')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp4Position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp4ReasonLeaving')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp4ReasonLeaving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp4SalaryStartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp4SalaryStartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp5StartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp5StartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp5At')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp5At); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp5Position')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp5Position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp5ReasonLeaving')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp5ReasonLeaving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('WorkExp5SalaryStartEnd')); ?>:</b>
	  <?php echo CHtml::encode($data->WorkExp5SalaryStartEnd); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('typing')); ?>:</b>
	  <?php echo CHtml::encode($data->typing); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('speedTypingTh')); ?>:</b>
	  <?php echo CHtml::encode($data->speedTypingTh); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('speedTypingEn')); ?>:</b>
	  <?php echo CHtml::encode($data->speedTypingEn); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('computerSkill')); ?>:</b>
	  <?php echo CHtml::encode($data->computerSkill); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('driving')); ?>:</b>
	  <?php echo CHtml::encode($data->driving); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('drivingLicenseNo')); ?>:</b>
	  <?php echo CHtml::encode($data->drivingLicenseNo); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('officeMachine')); ?>:</b>
	  <?php echo CHtml::encode($data->officeMachine); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('hobbies')); ?>:</b>
	  <?php echo CHtml::encode($data->hobbies); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('favouriteSport')); ?>:</b>
	  <?php echo CHtml::encode($data->favouriteSport); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('spacialKnowledge')); ?>:</b>
	  <?php echo CHtml::encode($data->spacialKnowledge); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	  <?php echo CHtml::encode($data->other); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('canWorkUpCountry')); ?>:</b>
	  <?php echo CHtml::encode($data->canWorkUpCountry); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('personAtEmergencyName')); ?>:</b>
	  <?php echo CHtml::encode($data->personAtEmergencyName); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('personAtEmergencyRelated')); ?>:</b>
	  <?php echo CHtml::encode($data->personAtEmergencyRelated); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('personAtEmergencyAddress')); ?>:</b>
	  <?php echo CHtml::encode($data->personAtEmergencyAddress); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('personAtEmergencyTel')); ?>:</b>
	  <?php echo CHtml::encode($data->personAtEmergencyTel); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('sourceOfJobInfo')); ?>:</b>
	  <?php echo CHtml::encode($data->sourceOfJobInfo); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('hasBeenSeriouslyOrContractedSick')); ?>:</b>
	  <?php echo CHtml::encode($data->hasBeenSeriouslyOrContractedSick); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('whatSick')); ?>:</b>
	  <?php echo CHtml::encode($data->whatSick); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('everAppliedBefore')); ?>:</b>
	  <?php echo CHtml::encode($data->everAppliedBefore); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('appliedWhen')); ?>:</b>
	  <?php echo CHtml::encode($data->appliedWhen); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langThSpeaking')); ?>:</b>
	  <?php echo CHtml::encode($data->langThSpeaking); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langThWriting')); ?>:</b>
	  <?php echo CHtml::encode($data->langThWriting); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langThReading')); ?>:</b>
	  <?php echo CHtml::encode($data->langThReading); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langEnSpeaking')); ?>:</b>
	  <?php echo CHtml::encode($data->langEnSpeaking); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langEnWriting')); ?>:</b>
	  <?php echo CHtml::encode($data->langEnWriting); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langEnReading')); ?>:</b>
	  <?php echo CHtml::encode($data->langEnReading); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('langOther')); ?>:</b>
	  <?php echo CHtml::encode($data->langOther); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('uKnowEmployeeInOffice')); ?>:</b>
	  <?php echo CHtml::encode($data->uKnowEmployeeInOffice); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('NameAddressOfRelatedPeople1')); ?>:</b>
	  <?php echo CHtml::encode($data->NameAddressOfRelatedPeople1); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('NameAddressOfRelatedPeople2')); ?>:</b>
	  <?php echo CHtml::encode($data->NameAddressOfRelatedPeople2); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('introductionOfU')); ?>:</b>
	  <?php echo CHtml::encode($data->introductionOfU); ?>
	  <br />

	 */ ?>

</div>