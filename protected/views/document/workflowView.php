

<div class="row-fluid copy">
	<div class="span3">
		<?php echo $form->labelEx($documentItem, 'documentItemName'); ?>
		<?php
		echo $form->textField($documentItem, 'documentItemName[]', array(
			'size' => 50,
			'maxlength' => 1000,
			'class' => 'input-medium'));
		?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($documentItem, 'description1'); ?>
		<?php echo CHtml::activeFileField($documentItem, 'description1[]'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($documentItem, 'description2'); ?>
		<?php
		echo $form->textField($documentItem, 'description2[]', array(
			'size' => 50,
			'maxlength' => 1000,
			'class' => 'input-medium'));
		?>
	</div>

	<div class="span2">
		<?php echo $form->labelEx($documentItem, 'description3'); ?>
		<?php
		echo $form->textField($documentItem, 'description3[]', array(
			'size' => 50,
			'maxlength' => 1000,
			'class' => 'input-medium'));
		?>
	</div>

	<a id="copylink" href="#" rel=".copy">+</a>
</div>

