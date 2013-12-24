<?php
/* @var $this ElearningExamQuestionController */
/* @var $model ElearningExamQuestion */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elearning-exam-question-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('class'=>'input-block-level')); ?>
<?php echo $form->error($model,'title'); ?>

<?php echo $form->labelEx($model, 'description'); ?>
<?php
$this->widget('ext.editMe.widgets.ExtEditMe', array(
	'model'=>$model,
	'attribute'=>'description',
	'value'=>$model->description,
));
?>
<?php echo $form->error($model, 'description'); ?>

<?php echo $form->labelEx($model,'elearningId'); ?>
<?php echo $form->dropDownList($model,'elearningId', CHtml::listData(Elearning::model()->findAll(array('order'=>'title')), 'elearningId', 'title'), array('class'=>'input-block-level', 'prompt'=>'--- Select Elearning ---')); ?>
<?php echo $form->error($model,'elearningId'); ?>

<div class="page-header"><h3>Choices</h3></div>

<?php if(!$choiceModels):?>
	<?php for($i=1;$i<=4;$i++):?>
		<h4>Choice <?php echo $i;?></h4>
		<p class="alert alert-info">
			<label class="radio">
				<?php echo CHtml::radioButton('isCorrect', false, array('value'=>$i));?>
				<?php echo $choiceModel->getAttributeLabel('isCorrect');?>
			</label>
			<br />

			<?php echo $form->labelEx($choiceModel,'title'); ?>
			<?php echo $form->textField($choiceModel,'['.$i.']title',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($choiceModel,'title'); ?>

			<?php echo $form->labelEx($choiceModel, 'description'); ?>
			<?php
			$this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model'=>$choiceModel,
				'attribute'=>'['.$i.']description',
				'value'=>$choiceModel->description,
				'id'=>'c'.$i
			));
			?>
			<?php echo $form->error($choiceModel, 'description'); ?>
		</p>
	<?php endfor;?>
<?php else:?>
	<?php foreach($choiceModels as $key => $choiceModel):?>
		<?php $choiceId = !empty($choiceModel->choiceId) ? $choiceModel->choiceId : $key;?>

		<?php echo $form->errorSummary($choiceModel); ?>

		<h4>Choice <?php echo ($choiceModel->choiceId) ? $choiceModel->choiceId : $choiceId;?></h4>
		<p class="alert alert-info">
			<label class="radio">
				<?php //echo $form->radioButton($choiceModel,'isCorrect', array('value'=>$choiceId, 'checked'=>($choiceModel->isCorrect) ? 'checked' : '')); ?>
				<?php echo CHtml::radioButton('isCorrect', ($choiceModel->isCorrect) ? true :false, array('value'=>$choiceId));?>
				<?php echo $choiceModel->getAttributeLabel('isCorrect');?>
			</label>
			<br />

			<?php echo $form->labelEx($choiceModel,'title'); ?>
			<?php echo $form->textField($choiceModel,'['.$choiceId.']title',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($choiceModel,'title'); ?>

			<?php echo $form->labelEx($choiceModel, 'description'); ?>
			<?php
			$this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model'=>$choiceModel,
				'attribute'=>'['.$choiceId.']description',
				'value'=>$choiceModel->description,
				'id'=>'c'.$choiceId
			));
			?>
			<?php echo $form->error($choiceModel, 'description'); ?>
		</p>
	<?php endforeach;?>
<?php endif;?>

<div class="form-actions">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
</div>

<?php $this->endWidget(); ?>