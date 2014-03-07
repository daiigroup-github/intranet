<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */
/* @var $form CActiveForm */
?>
<div class="row-fluid">
	<div class="span12">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
			'htmlOptions'=>array(
				'class'=>'form-search well',
				'id'=>'fitAndFastSearch'
			),
		));
		?>
		<?php
		echo $form->textField($model, 'searchText', array(
			'class'=>'input-medium search-query'));
		echo '&nbsp;';
		echo CHtml::submitButton('Search', array(
			'class'=>'btn'));
		?>

<?php $this->endWidget(); ?>
	</div>
</div>