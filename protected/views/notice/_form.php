<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'notice-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array(
			'enctype' => 'multipart/form-data',
		)
	));
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
	$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
	$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
	$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
	$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
	$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, 'Please fix the following input errors', '', array(
		'class' => 'alert alert-error'));
	?>

	<p>
		<?php echo $form->labelEx($model, 'title'); ?>
		<?php
		echo $form->textField($model, 'title', array(
			'size' => 60,
			'maxlength' => 500));
		?>
		<?php echo $form->error($model, 'title'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'headline'); ?>
		<?php
		echo $form->textField($model, 'headline', array(
			'size' => 60,
			'maxlength' => 500));
		?>
		<?php echo $form->error($model, 'headline'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php //echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>2000)); ?>
		<?php
		$this->widget('application.extensions.extckeditor.ExtCKEditor', array(
			'model' => $model,
			'attribute' => 'description', // model atribute
			'language' => 'en', /* default lang, If not declared the language of the project will be used in case of using multiple languages */
			'editorTemplate' => 'full', // Toolbar settings (full, basic, advanced)
		));
		?>
		<?php echo $form->error($model, 'description'); ?>
	</p>


	<p>
		<?php echo $form->labelEx($model, 'imageUrl'); ?>
		<?php
		if (isset($model->imageUrl))
		{
			if (strpos($model->imageUrl, ".pdf"))
			{
				echo "<a class='pdf' Title='$model->title' href='$model->imageUrl'>อ่านไฟล์</a> ";
			}
			else
			{
				echo "<a class='fancyFrame' Title='$model->title' href='$model->imageUrl'><img  src='$model->imageUrl' width='50px' alt='' /></a> ";
			}
		}
		echo $form->hiddenField($model, "imageUrl", array(
			"name" => "oldImage"));
		echo CHtml::activeFileField($model, "imageUrl", array(
			'class' => 'input-small'));
		?>
		<?php echo $form->error($model, 'description'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</p>

	<p>
		<?php echo $form->labelEx($model, 'noticeTypeId'); ?>
		<?php echo $form->dropDownList($model, 'noticeTypeId', NoticeType::model()->getAllNoticeType()); ?>
		<?php echo $form->error($model, 'noticeTypeId'); ?>
	</p>



	<p>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</p>

	<?php $this->endWidget(); ?>

</div><!-- form -->