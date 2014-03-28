<h2><?php echo $model->title ?></h2>
<blockquote><?php echo $model->description ?></blockquote>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'exam-form',
	//'enableAjaxValidation' => true,
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,),
	));

$i = 1;
?>

<?php foreach ($model->examQuesitons as $examQuestionModel): ?>
	<div class="row-fluid">
		<div class="offset1 span10 well">
			<h4><?php echo $i . ' : ' . $examQuestionModel->title; ?><small>(<?php echo ExamQuestion::model()->examQuesitonText($examQuestionModel->questionType); ?>)</small></h4>
			<blockquote><?php echo $examQuestionModel->description ?></blockquote>

			<ul>
				<?php
				if ($examQuestionModel->questionType == 1)
				{
					foreach ($examQuestionModel->examChoices as $examChoiceModel)
					{
						echo '<label class="radio">';
						echo $form->radioButton($examChoiceModel, '[' . $examQuestionModel->examQuestionId . ']title', array(
							'value' => $examChoiceModel->examChoiceId));
						echo $examChoiceModel->title;
						echo '</label>';
					}
				}
				else
				{
					echo $form->dropDownList($examQuestionModel, 'selectedRange', range($examQuestionModel->startRange, $examQuestionModel->stopRange), array(
						'class' => 'input-small',
						'prompt' => '---'));
				}

				$i++;
				?>
			</ul>	
		</div>
	</div>

<?php endforeach; ?>

<div class="form-actions">
	<?php
	echo CHtml::submitButton('Submit', array(
		'class' => 'btn btn-primary'));
	?>
</div>
<?php $this->endWidget(); ?>