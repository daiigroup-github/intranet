<?php

class ChangePasswordController extends Controller
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$model = new ChangePassword();

		if (isset($_POST['ChangePassword']))
		{
			if ($model->validatePasswordFormat($_POST['ChangePassword']['password']))
			{
				$employeeModel = Employee::model()->findByPk(Yii::app()->user->id);

				$emp['password'] = $employeeModel->hashPassword($employeeModel->username, $_POST['ChangePassword']['password']);

                //find last 3 passwordLog
                $passwordLogs = PasswordLog::model()->findAll(array(
                    'condition'=>'employeeId=:employeeId',
                    'params'=>array(
                        ':employeeId'=>Yii::app()->user->id,
                    ),
                    'order'=>'createDateTime DESC',
                    'limit'=>3
                ));

                $i=0;
                foreach ($passwordLogs as $passwordLog) {
                    if($passwordLog->password == $emp['password']){
                        $i++;
                        break;
                    }
                }


                if($i > 0) {
                    $model->addError('password', 'รหัสผ่านซ้ำกับ 3 ครั้งหลังล่าสุด กรุณากำหนดรหัสผ่านใหม่');
                } else {
                    $emp['isFirstLogin'] = 1;

                    $employeeModel->attributes = $emp;
                    $employeeModel->lastChangePasswordDateTime = new CDbExpression('NOW()');

                    $passwordLogModel = new PasswordLog();
                    $passwordLogModel->employeeId = $employeeModel->employeeId;
                    $passwordLogModel->createDateTime = new CDbExpression('NOW()');


                    if ($employeeModel->save(false)) {

                        //echo '<script>alert("เปลี่ยนรหัสผ่านเรียบร้อยแล้ว");</script>';
                        $this->redirect(Yii::app()->createUrl('/home'));
                    } else {
                        $model->addError('oldPassword', 'ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่');
                    }
                }
			}
			else
			{
				$model->addError('password', 'รหัสผ่านจะต้องมีตัวอักษรพิมพ์ใหญ่อย่างน้อย 1 ตัว ตัวอักษรพิมพ์เล็กอย่างน้อย 1 ตัว  ตัวเลขอย่างน้อย 1 ตัว และความยาวอย่างน้อย 8 ตัวอักษร');
			}
		}

		$this->render('index', array(
			'model' => $model));
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