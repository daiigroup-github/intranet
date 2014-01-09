<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>


	<p>
		<?php echo $form->label($model, 'subject'); ?>
		<?php
		echo $form->textField($model, 'subject', array(
			'size'=>60,
			'maxlength'=>1000));
		?>
	</p>

	<p>
		<?php echo $form->label($model, 'detail'); ?>
		<?php
		echo $form->textField($model, 'detail', array(
			'size'=>60,
			'maxlength'=>3000));
		?>
	</p>

	<p>
		<?php //echo $form->label($model,'createBy');  ?>
		<?php //echo $form->textField($model,'createBy',array('size'=>20,'maxlength'=>20));  ?>
	</p>

	<p>
		<?php //echo $form->label($model,'createDateTime');   ?>
		<?php //echo $form->textField($model,'createDateTime');  ?>
	</p>

	<p>
		<?php echo CHtml::submitButton('Search'); ?>
	</p>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->