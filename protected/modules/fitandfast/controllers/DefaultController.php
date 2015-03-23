<?php

class DefaultController extends Controller
{
	public function actionIndex($id = null, $forYear = null)
	{
        $employeeId = isset($id) ? $id : Yii::app()->user->id;
        $forYear = isset($forYear) ? $forYear : date('Y');

        $fitfastModels = Fitfast::model()->findAll(array(
            'condition'=>'employeeId=:employeeId AND status=1',
            'params'=>array(
                ':employeeId'=>$employeeId
            )
        ));

        $fitfastEmployeeModel = FitfastEmployee::model()->find(array(
            'condition'=>'employeeId=:employeeId AND forYear=:forYear',
            'params'=>array(
                ':employeeId'=>$employeeId,
                ':forYear'=>$forYear
            )
        ));

		$this->render('index', array(
            'fitfastModels'=>$fitfastModels,
            'fitfastEmployeeModel'=>$fitfastEmployeeModel
        ));
	}
}