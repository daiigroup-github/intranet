<?php

class AddLeaveAfterProCommand extends CConsoleCommand
{

	public function run()
	{
		date_default_timezone_set('Asia/Bangkok');
		$nextyear = mktime(0, 0, 0, date("m") + 7, date("d"), date("Y") - 1);
		$date = date('Y-m-d', $nextyear);

		$employeeModels = Employee::model()->findAll('proDate="' . $date . '"');

		foreach ($employeeModels as $employeeModel)
		{
			$employeeModel->leaveRemain = 6;
			$employeeModel->save();
		}
	}

}
