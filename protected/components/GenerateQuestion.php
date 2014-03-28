<?php

class GenerateQuestion //extends Controller
{

	public function generate($questionObj)
	{
		$htmlText = " ";
		$htmlText .= $questionObj->title;
		$htmlText .= "</br>";
		if ($questionObj->questionType == 1)//EXAM_QUESTION_TYPE_MULTI
		{
			
		}
		else if ($questionObj->questionType == 2)//EXAM_QUESTION_TYPE_RANGE
		{
			$w = array(
				);
			for ($i = $questionObj->startRange; $i < $questionObj->stopRange + 1; $i++)
			{
				$w[$i] = $i;
			}

			$htmlText .= CHtml::dropDownList("Exam[SelectChoice][$questionObj->examQuestionId]", "", $w, array(
					'class' => 'input-small'));
		}
		else if ($questionObj->questionType == 3)//EXAM_QUESTION_TYPE_TEXT
		{
			
		}
		else if ($questionObj->questionType == 4)//EXAM_QUESTION_TYPE_TEXT_AREA
		{
			$htmlText .= CHtml::textArea("Exam[SelectChoice][$questionObj->examQuestionId]", "");
		}
		$htmlText .= "</br>";
		return $htmlText;
	}

}