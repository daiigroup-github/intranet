<?php
use frontend\assets\FancyBoxAsset;

FancyBoxAsset::register($this);
$this->params['pageHeader'] = 'Fit and Fast';
$this->params['breadcrumbs'][] = ['label' => 'Fit and Fast'];

echo $this->render('_fitandfast_employee', compact('fitfastEmployee', 'employeeModel'));
?>
