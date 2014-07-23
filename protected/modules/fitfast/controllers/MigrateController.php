<?php

class MigrateController extends Controller
{
	public function actionIndex()
	{
		$forYear = 2014;
		$flag = false;
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$criteria = new CDbCriteria();
			$criteria->select = 'distinct employeeId';
			$criteria->condition = 'forYear=' . $forYear;
			$criteria->order = 'employeeId';

			$employees = FitAndFast::model()->findAll($criteria);
			foreach($employees as $emp)
			{
				echo 'EmployeeId : ' . $emp->employeeId . '<br />';

				$fitFastEmployee = new FitfastEmployee();
				$fitFastEmployee->employeeId = $emp->employeeId;
				$fitFastEmployee->createDateTime = new CDbExpression('NOW()');
				$fitFastEmployee->updateDateTime = new CDbExpression('NOW()');
				$fitFastEmployee->forYear = $forYear;

				if($fitFastEmployee->save())
				{
					$cri2 = new CDbCriteria();
					$cri2->condition = 'forYear=:forYear AND employeeId=:employeeId';
					$cri2->params = array(
						':forYear' => $forYear,
						':employeeId' => $emp->employeeId
					);

					$fitandfasts = FitAndFast::model()->findAll($cri2);

					foreach($fitandfasts as $fitandfast)
					{
						$fitfast = new Fitfast();
						$fitfast->createDateTime = new CDbExpression('NOW()');
						$fitfast->updateDateTime = new CDbExpression('NOW()');
						$fitfast->fitfastEmployeeId = Yii::app()->db->lastInsertID;
						$fitfast->employeeId = $emp->employeeId;
						$fitfast->title = $fitandfast->title;
						$fitfast->description = $fitandfast->description;
						$fitfast->forYear = $fitandfast->forYear;

						echo $fitfast->title . '<br />';
					}
					echo '<hr />';
				}
			}

			if($flag)
				$transaction->commit();
			else
				$transaction->rollback();
		}
		catch(Exception $e)
		{
			$transaction->rollback();
			throw new Exception($e->getMessage());
		}
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
}