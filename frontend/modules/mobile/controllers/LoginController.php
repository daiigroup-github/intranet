<?php
namespace frontend\modules\mobile\controllers;

use frontend\models\Employee;
use common\models\LoginForm;
use Yii;

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
//header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
//if ("OPTIONS" === $_SERVER['REQUEST_METHOD']) {
//    die();
//}


class LoginController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', ],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => null,
                    'Access-Control-Max-Age' => 3600,
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            $model = new LoginForm();

            $model->username = $_REQUEST['username'];
            $model->password = $_REQUEST['password'];

            if ($model->login()) {
                $employeeModel = Employee::findOne(Yii::$app->user->identity->id);

                echo json_encode([
                    'result' => true,
                    'employeeId' => $employeeModel->employeeId,
                    'name' => $employeeModel->fullThName,
                    'isManager' => $employeeModel->isManager,
                    'username' => $employeeModel->username,
                ]);
            } else {
                echo json_encode([
                    'result' => false,
                ]);
            }
        }
    }
}
