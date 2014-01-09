
<?php
//echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	//the id of the 'Copy' link in the view, see below.
	'id'=>'copylink',
	//add a icon image tag instead of the text
	//leave empty to disable removing
	//'removeText' => '<i class="icon-minus icon-white"></i>',
	'removeText'=>'-',
	//htmlOptions of the remove link
	'removeHtmlOptions'=>array(
		'style'=>'color:red'),
	//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
	'options'=>array(
		//A class to attach to each copy
		'copyClass'=>'newcopy',
		// The number of allowed copies. Default: 0 is unlimited
		'limit'=>0,
		//Option to clear each copies text input fields or textarea
		'clearInputs'=>true,
		//A jQuery selector used to exclude an element and its children
		'excludeSelector'=>'.skipcopy',
	//Additional HTML to attach at the end of each copy.
	//'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
	)
));
?>

<div class="row-fluid copy">
	<div class="span3">
		<?php echo $form->labelEx($documentItem, 'documentItemName'); ?>
		<?php
		echo $form->textField($documentItem, 'documentItemName[]', array(
			'size'=>50,
			'maxlength'=>1000,
			'class'=>'input-medium'));
		?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($documentItem, 'description1'); ?>
		<?php echo CHtml::activeFileField($documentItem, 'description1[]'); ?>
	</div>

	<a id="copylink" href="#" rel=".copy">+</a>
</div>

