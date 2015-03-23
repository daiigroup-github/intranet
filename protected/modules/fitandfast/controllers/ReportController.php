<?php

class ReportController extends FitandfastMasterController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    public function actionEmployee()
    {
        $companyModels = Company::model()->findAll();
        $companyDivisionModels = CompanyDivision::model()->findAll();
        $sumPercent = 0;

        $i = 0;
        $k = 0;
        foreach ($companyModels as $companyModel) {
            $data[$i]['companyName'] = $companyModel->companyNameTh;
            $data[$i]['companyId'] = $companyModel->companyId;

            $j = 0;
            foreach ($companyDivisionModels as $companyDivisionModel) {
                if (null == (Employee::model()->find('status=1 AND companyId=:companyId AND companyDivisionId=:companyDivisionId', array(
                        ':companyId' => $companyModel->companyId,
                        ':companyDivisionId' => $companyDivisionModel->companyDivisionId
                    )))
                ) {
                    continue;
                }

                $data[$i]['division'][$j]['companyDivisionId'] = $companyDivisionModel->companyDivisionId;
                $data[$i]['division'][$j]['description'] = $companyDivisionModel->description;
                $data[$i]['division'][$j]['percent'] = FitfastEmployee::model()->calculatePercentByDivisionId($companyModel->companyId, $companyDivisionModel->companyDivisionId, date('Y'));
                $sumPercent += $data[$i]['division'][$j]['percent'];
                $j++;
                $k++;
            }
            $i++;
        }

        $this->render('employee', array(
            'data' => $data,
            'sumPercent' => number_format($sumPercent / $k, 2)
        ));
    }

    public function actionManager()
    {
        $data = array();
        $i = 0;
        $sumPercent = 0;

        $employeeModels = Employee::model()->findAll('status=1 AND isManager=1');

        foreach ($employeeModels as $employeeModel) {
            $data['employee'][$i]['name'] = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
            $data['employee'][$i]['employeeId'] = $employeeModel->employeeId;
            $grade = FitfastEmployee::model()->calculatePercentByEmployeeIdAndYear($employeeModel->employeeId, date('Y'));
            $data['employee'][$i]['percent'] = $grade['percent'];
            $data['employee'][$i]['grades'] = $grade['grades'];

            $sumPercent += $grade['percent'];

            $i++;
        }
        $this->render('manager', array(
            'data' => $data,
            'percent' => number_format($sumPercent / $i, 2)
        ));
    }
}