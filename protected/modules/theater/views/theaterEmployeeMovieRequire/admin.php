<?php
/* @var $this TheaterEmployeeMovieRequireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Theater Employee Movie Requires',
);

$this->menu=array(
	array('label'=>'Create TheaterEmployeeMovieRequire', 'url'=>array('create')),
	array('label'=>'Manage TheaterEmployeeMovieRequire', 'url'=>array('index')),
);
?>

<h1>Theater Employee Movie Requires</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
