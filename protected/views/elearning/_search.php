<?php
/* @var $this ElearningController */
/* @var $model Elearning */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'id'=>'search-form',
	'htmlOptions'=>array(
		'class'=>'well form-search'),
	));
?>

<?php
echo $form->textField($model, 'title', array(
	'class'=>'input-medium search-query'));
?>
<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn'));
?>

<?php $this->endWidget(); ?>