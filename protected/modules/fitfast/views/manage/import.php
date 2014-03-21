<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */
/* @var $form CActiveForm */
$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> Import</li>';

$this->pageHeader = 'Import FitAndFast';
?>

<div class="row-fluid">
	<div class="span112">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'fit-and-fast-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
				'class'=>'well',
				'enctype'=>'multipart/form-data'),
		));
		?>

		<label>File</label>
		<?php echo CHtml::fileField('file'); ?>

		<div class="form-actions">
			<?php
			echo CHtml::submitButton('Import', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
	<!-- form -->
