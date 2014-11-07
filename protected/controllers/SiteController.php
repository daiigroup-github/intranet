<?php

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public $layout = '//layouts/cl1';
	public $redirectUrl = null;

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if (isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate())
			{
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array(
			'model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest)
		{
			$this->redirect(Yii::app()->createUrl('home'));
		}

		$model = new LoginForm;
		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		$this->redirectUrl = Yii::app()->user->returnUrl;
		// collect user input data
		if (isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid

			if ($model->validate() && $model->login())
			{
				//echo Yii::app()->user->returnUrl;
				//$this->redirect(Yii::app()->user->returnUrl);

                $employeeModel = Employee::model()->findByPk(Yii::app()->user->id);
				$name = Yii::app()->user->name;

                //reset loginFailed
                $employeeModel->loginFailed = 0;
                $employeeModel->save(false);

                /**
                 * @Todo
                 * check Employee.lastChangePassword :: if > 90 days redirect to change password
                 */
                $last90days = date('Y-m-d', strtotime('-90 days'));
                $passwordLog = PasswordLog::model()->find(array(
                    'condition'=>'createDateTime >= :last90days',
                    'params'=>array(
                        ':last90days'=>$last90days,
                    ),
                ));

				if (!$employeeModel->isFirstLogin || !isset($passwordLog))
				{
					$this->redirect(Yii::app()->createUrl('/changePassword'));
				}
				else
				{
					if (isset($_POST['LoginForm']['device']) && $_POST['LoginForm']['device'] == 'mobile')
					{
						$res['result'] = true;
						// Select use in mobile documentType
						//$documentTypeList = DocumentType::model()->find();
						// Select use in mobile documentType
						/*
						  $res['document'][0]["documentTypeName"] = "Sale Report";
						  $res['document'][0]["documentCodePrefix"] = "SRE";

						  $res['document'][1]["documentTypeName"] = "Mileage Report";
						  $res['document'][1]["documentCodePrefix"] = "MRE";
						 */

						$this->jsonEncode($res);
					}
					else
					{
						if (substr($this->redirectUrl, -9, 9) != 'index.php')
						{
							$this->redirect($this->redirectUrl);
						}
						else
						{
							$this->redirect(Yii::app()->createUrl('/home'));
						}
					}
				}
			} else {
                /**
                 * count login failed
                 * if >= 5 lock user
                 */
                $employeeModel = Employee::model()->find(array(
                    'condition'=>'username=:username',
                    'params'=>array(
                        ':username'=>$_POST['LoginForm']['username'],
                    ),
                ));
                if($employeeModel->loginFailed >=5) {
                    //lock user
                    $employeeModel->status = Employee::STATUS_LOCK;
                    echo "<script>alert('User ถูกห้ามใช้ กรุณาติดต่อฝ่าย IT')</script>";
                } else {
                    $employeeModel->loginFailed += 1;
                }

                $employeeModel->save(false);
            }
		}

		//login failed
		if (isset($_POST['LoginForm']['device']) && $_POST['LoginForm']['device'] == 'mobile')
		{
			$res['result'] = false;
			$this->jsonEncode($res);
		}

		// display the login form
		$this->render('login', array(
			'model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();

		if (!isset($_POST['LoginForm']['device']))
			$this->redirect(Yii::app()->homeUrl);
		else
		{
			$res['result'] = true;
			$this->jsonEncode($res);
		}
	}

	public function actionResetPassword()
	{
		$model = new Employee();
		if (isset($_POST["Employee"]))
		{
			$username = $_POST["Employee"]["username"];
			$employee = $model->find("username =:username", array(
				':username' => $username));
			if (count($employee) == 1)
			{
				$emailController = new EmailSend();
				$emailName = $employee->fnTh . "  " . $employee->lnTh;
				$emailEmail = $employee->email . "@daiigroup.com";
				$newPassword = rand(00000, 99999);
				$website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/";
				$employee->password = $model->hashPassword($username, $newPassword);
				$employee->isFirstLogin = 0;
				if ($employee->save(true))
				{
					$emailController->mailResetPassword($emailName, $newPassword, $emailEmail, $website);
					$this->redirect(array(
						"Login",
						'resetMessage' => "reset"));
				}
			}
			else
			{
				$model->addError("resetPwdError", "ไม่มี username นี้อยู่ในระบบ");
				$this->render("resetPassword", array(
					'model' => $model));
			}
		}
		else
		{
			$this->render("resetPassword", array(
				'model' => $model));
		}
	}

    public function actionCreatePasswordLog()
    {
        $employees = Employee::model()->findAll('status=1');
        $i=1;
        foreach ($employees as $employee) {
            $passwordLog = new PasswordLog();
            echo $employee->employeeId.'<br />';
            $passwordLog->id = $i;
            $passwordLog->employeeId = $employee->employeeId;
            $passwordLog->password = $employee->password;
            $passwordLog->createDateTime = new CDbExpression('NOW()');
            if(!$passwordLog->save()) {
                print_r($passwordLog->errors);exit();
            }
            $i++;
        }

    }

}
