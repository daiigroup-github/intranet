<?php

class EmployeeResignCommand extends CConsoleCommand
{

	public function run()
	{
		date_default_timezone_set('Asia/Bangkok');
		//$nextyear = mktime(0, 0, 0, date("m"), date("d"), date("Y") - 1);
		//$date = date('Y-m-d', $nextyear);

		$employeeModels = Employee::model()->findAll("(endDate < :endDate AND endDate <> '0000-00-00') and status = 1", array(
			":endDate" => date("Y-m-d")));

		foreach ($employeeModels as $employeeModel)
		{
			$employeeModel->status = 2;
			if ($employeeModel->save())
			{
				$emailController = new EmailSend();
				$website = "http://" . Yii::app()->baseUrl . "/index.php/Employee/View/" . $employeeModel->employeeId;
				$toEmails = array(
					array(
						'email' => 'kamon.p@daiigroup.com',
						'canView' => true),
					array(
						'email' => 'daii-its@daiigroup.com',
						'canView' => true),
					array(
						'email' => 'daiichi-hr@daiigroup.com',
						'canView' => true),
					array(
						'email' => 'daiichi-administration@daiigroup.com',
						'canView' => true),
				);

				$nameThai = "คุณ" . $employeeModel->fnTh . "  " . $employeeModel->lnTh;
				$nameEng = $employeeModel->fnEn . "  " . $employeeModel->lnEn;
				foreach ($toEmails as $toEmail)
				{
					$emailController->mailResignEmployee($employeeModel->employeeCode, $nameThai, $nameEng, $employeeModel->position, $employeeModel->company->companyNameTh, $website, $toEmail["canView"], $toEmail["email"], $employeeModel->endDate, $employeeModel->username);
				}
			}
		}
	}

}

?>
