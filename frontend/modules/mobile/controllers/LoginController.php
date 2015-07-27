<?php
namespace frontend\modules\mobile\controllers;

use frontend\models\Employee;
use common\models\LoginForm;
use Yii;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}

class LoginController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new LoginForm();

        if(isset($_POST['username']) && isset($_POST['password'])) {
            $model->username = $_POST['username'];
            $model->password = $_POST['password'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $employeeModel = Employee::findOne(ßYii::$app->user->identity->id);

            echo json_encode([
                'result'=>true,
                'employeeId'=>$employeeModel->employeeId,
                'name'=>$employeeModel->fullThName,
                'isManager'=>$employeeModel->isManager,
                'username'=>$employeeModel->username,
            ]);
        } else {
            echo json_encode([
                'result'=>false,
            ]);
        }
    }

}
