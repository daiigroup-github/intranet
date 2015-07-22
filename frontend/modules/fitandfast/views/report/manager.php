<?php
use frontend\assets\FancyBoxAsset;

FancyBoxAsset::register($this);
$this->params['pageHeader'] = 'Fit and Fast : '.$employeeModel->fullThName;
$this->params['breadcrumbs'][] = ['label' => 'All Managers', 'url'=>['/fitandfast/report/all-manager']];
$this->params['breadcrumbs'][] = ['label' => 'Fit and Fast'];

echo $this->render('@frontend/modules/fitandfast/views/default/_fitandfast_employee', compact('fitfastEmployee', 'employeeModel'));
?>
