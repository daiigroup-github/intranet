<h2>Product galley</h2>
<?php
$gallery = new Gallery();
$gallery->name = true;
$gallery->description = true;
$gallery->versions = array(
	'small' => array(
		'resize' => array(200, null),
	),
	'medium' => array(
		'resize' => array(800, null),
	)
);
$gallery->save();

// render widget in view
$this->widget('GalleryManager', array(
	'gallery' => $gallery,
	'controllerRoute' => '/gallery', //route to gallery controller
));
?>