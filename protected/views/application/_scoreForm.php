<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'customer-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
		'style' => "overflow:scroll;height:450px")
	));
?>
<?php
//HiddenFiled
echo $form->hiddenField($exam, "examId");
?>
<div class="control-group">
	<label class="control-label"></label>
	<div class="controls">
		<?php
		echo "<h4>" . $exam->title . "</h4>";
		?></div>
</div>
<?php
if (!isset($appInter->score))
{
	foreach ($exam->examQuesitons as $question)
	{
		$genQuestion = new GenerateQuestion();
		echo $genQuestion->generate($question);
	}
}
else
{
	foreach ($exam->examQuesitons as $question)
	{
		echo $question->title;
		if (count($appInter->appInterviewScore) > 0)
		{
			foreach ($appInter->appInterviewScore as $item)
			{
				if ($item->questionId == $question->examQuestionId)
				{
					echo "<br>";
					echo "คะแนน : ";
					echo $item->choiceValue;
					echo "<br>";
				}
			}
		}
		echo "<br>";
	}
}
?>
<?php
if (!isset($appInter->score))
{
	?>
	<div class="control-group">
		<?php echo CHtml::submitButton('ประเมิน'); ?>
	</div>
<?php } ?>
<?php $this->endWidget(); ?>