<?php
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	//the id of the 'Copy' link in the view, see below.
	'id' => 'copylink',
	//add a icon image tag instead of the text
	//leave empty to disable removing
	//'removeText' => '<i class="icon-minus icon-white"></i>',
	'removeText' => '-',
	//htmlOptions of the remove link
	'removeHtmlOptions' => array(
		'style' => 'color:red'),
	//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
	'options' => array(
		//A class to attach to each copy
		'copyClass' => 'newcopy',
		// The number of allowed copies. Default: 0 is unlimited
		'limit' => 0,
		//Option to clear each copies text input fields or textarea
		'clearInputs' => true,
		//A jQuery selector used to exclude an element and its children
		'excludeSelector' => '.skipcopy',
	//Additional HTML to attach at the end of each copy.
	//'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
	)
));
?>

<h3>Images</h3>
<div class="row copy">
	<div class="span3 offset1">
		<label>Image</label>
		<?php
		echo $form->fileField($documentItemModel, 'input[]', array(
			'class' => 'input-medium'));
		?>
	</div>

	<a id="copylink" href="#" rel=".copy">+</a>
</div>