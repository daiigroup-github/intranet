<?php
namespace common\controllers;

use frontend\models\Employee;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class MasterController extends Controller
{
    public $breadcrumbs = [];
    public $layout = '/content';

    public function init()
    {
        if(Yii::$app->user->id) {
            $employee = Employee::findOne(Yii::$app->user->id);
            Yii::$app->view->params['name'] = $employee->fnTh.' '.$employee->lnTh;
        } else {
            $this->redirect(Url::base());
        }
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
                'rules' => [
                    [
//                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function writeToFile($fileName, $string, $mode='w+')
    {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }
}
