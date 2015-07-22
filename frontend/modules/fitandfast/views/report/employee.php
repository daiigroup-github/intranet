<?php
use frontend\assets\FancyBoxAsset;

FancyBoxAsset::register($this);
$this->params['pageHeader'] = 'Fit and Fast : '.$employeeModel->fullThName;
$this->params['breadcrumbs'][] = ['label' => 'Employee all divisoins', 'url'=>['/fitandfast/report/employee-in-division', 'companyId'=>$employeeModel->companyId, 'divisionId'=>$employeeModel->companyDivisionId]];
$this->params['breadcrumbs'][] = ['label' => 'Fit and Fast'];

echo $this->render('@frontend/modules/fitandfast/views/default/_fitandfast_employee', compact('fitfastEmployee', 'employeeModel'));
?>
