<?php
$this->pageHeader = 'แบบทดสอบ';
$this->breadcrumb = '<li>' . CHtml::link('แบบทดสอบ', Yii::app()->createUrl('/exam')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>แบบทดสอบ</li>';
?>

<p class="lead"><?php echo $model->title ?></p>
<blockquote><?php echo $model->description ?></blockquote>
<?php foreach ($model->examQuesitons as $examQuestionModel): ?>
	<div class="row-fluid">
		<div class="offset1 span10 well">
			<h4><?php echo $examQuestionModel->title; ?><small>(<?php echo ExamQuestion::model()->examQuesitonText($examQuestionModel->questionType); ?>)</small></h4>
			<blockquote><?php echo $examQuestionModel->description ?></blockquote>
			<ul>
				<?php
				if ($examQuestionModel->questionType == 1)
				{
					foreach ($examQuestionModel->examChoices as $examChoiceModel)
					{
						echo '<li>' . $examChoiceModel->title . '</li>';
					}
				}
				else
				{
					echo '<li>Start : ' . $examQuestionModel->startRange . '</li>';
					echo '<li>Stop : ' . $examQuestionModel->stopRange . '</li>';
				}
				?>
			</ul>
		</div>
	</div>
<?php endforeach; ?>
