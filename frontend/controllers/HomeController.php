<?php

namespace frontend\controllers;

use common\controllers\MasterController;
use common\models\DemoData;
use frontend\models\Fitfast;
use frontend\models\FitfastEmployee;
use frontend\models\FitfastTarget;
class HomeController extends MasterController
{
    public function actionIndex()
    {
        $demoData = new DemoData();
        $fitandfastSummary = $demoData->getFitAndFastSummary();
        $fitandfastDivision = $demoData->getFitAndFastDivision();
        $fitandfastEmployee = FitfastEmployee::summaryByEmployeeId();

        $i=0;
        foreach (FitfastEmployee::cummulateGrade() as $month=>$grade) {
            $fitfastStat[$i] = ['xkey'=>'2015-'.$month.'-01', 'ykey'=>number_format($grade['percent'], 2)];
            $i++;
        }


        return $this->render('index', compact('fitandfastSummary', 'fitandfastDivision', 'fitandfastEmployee', 'cummulateGrade', 'fitfastStat'));
    }

}
