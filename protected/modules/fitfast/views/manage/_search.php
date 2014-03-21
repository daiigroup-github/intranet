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

		echo $form->textField($model, 'searchText', array(
			'class'=>'input-medium search-query'));
		echo '&nbsp;';
		echo CHtml::activeDropDownList($model, 'forYear', CHtml::listData($model->findAll(), 'forYear', 'forYear'), array(
			'class'=>'input-small'));
		echo '&nbsp;';
		echo CHtml::submitButton('Search', array(
			'class'=>'btn'));

		$this->endWidget();
		?>
	</div>
</div>