<?php
/* @var $this TheaterMovieController */
/* @var $model TheaterMovie */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-search search-form')
	));
?>


<?php
echo $form->textField($model, 'searchText', array(
	'class'=>'input-medium search-query'));
?>
<?php
echo Select2::activeDropDownList($model, "theaterCategoryId", TheaterCategory::model()->findAllTheaterCategoryArray(), array(
	'prompt'=>'-- เลือกหมวดหมู่ --',
	'class'=>'input-medium search-query',
	'select2Options'=>array(
		'maximumSelectionSize'=>1,
	),
));
?>
<?php
echo CHtml::button('Search', array(
	'class'=>'btn',
	'type'=>'submit'));
?>

<?php $this->endWidget(); ?>
