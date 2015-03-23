<?php
/* @var $this ManageController */
/* @var $model Fitfast */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'search-form',
)); ?>
<div class="input-prepend">
    <button class="btn btn-default" type="submit">Search</button>
    <?php echo $form->textField($model, 'searchText', array('class' => '')); ?>
</div>
<?php $this->endWidget(); ?>
