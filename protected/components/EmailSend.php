<?php

class EmailSend //extends Controller
{

	// Example for send Email
	//$this->mailsend("Tong","Tong","kamy_jap@hotmail.com","TEst Test Test","Test Test","SSSSSSSS");
	//private $website = Yii::app()->getParams()->websiteUrl;
	//private $website = "http://192.168.100.33/intranet-yii";
	//private $website = "http://intranet-test.dcorp.co.th"; //
	private $adminEmail = "No-Reply@daiigroup.com";
	private $subject = "No-Reply : ";

	public function mailsend($name, $documentTypeName, $documentNo, $email, $documentId, $website, $action = "", $remarks = "", $creator = null)
	{

		$message = new YiiMailMessage();
		$message->view = 'document';
		$message->setBody(array(
			"name"=>$name,
			"documentTypeName"=>$documentTypeName,
			"documentNo"=>$documentNo,
			"documentUrl"=>$website . $documentId,
			"action"=>$action,
			"remarks"=>$remarks,
			"creator"=>$creator), 'text/html', 'utf-8');

		//$message->message->setBody($body, 'text/html');
		//$message->message->setBody($body, 'text/plain','utf-8');

		$message->subject = $this->subject . " " . $documentTypeName . " " . $documentNo;
		$message->addTo($email);
		//$message->from   = ($this->adminEmail);
		$message->setFrom(array(
			'No-Reply@daiigroup.com'=>'เอกสาร Intranet'));

		if(Yii::app()->getParams()->sendEmail)
		{
			Yii::app()->mail->send($message);
		}

		/* Yii::app()->user->setFlash('contact',
		  'Emails sent:'.$email.'\n'.
		  'Thank you for contacting us. We will respond to you as
		  soon as possible.');
		  //$this->refresh(); */
	}

	public function mailResetPassword($name, $newPassword, $email, $website)
	{

		$message = new YiiMailMessage();
		$message->view = 'resetPassword';
		$message->setBody(array(
			"name"=>$name,
			"newPassword"=>$newPassword,
			"documentUrl"=>$website), 'text/html', 'utf-8');

		//$message->message->setBody($body, 'text/html');
		//$message->message->setBody($body, 'text/plain','utf-8');

		$message->subject = "จดหมายแจ้งเตือนการ ขอรหัสผ่านใหม่ Intranet";
		$message->addTo($email);
		//$message->from   = ($this->adminEmail);
		$message->setFrom(array(
			'No-Reply@daiigroup.com'=>'แจ้งเตือน Intranet'));
		if(Yii::app()->getParams()->sendEmail)
		{
			Yii::app()->mail->send($message);
		}
		/* Yii::app()->user->setFlash('contact',
		  'Emails sent:'.$email.'\n'.
		  'Thank you for contacting us. We will respond to you as
		  soon as possible.');
		  //$this->refresh(); */
	}

	public function mailNewEmployee($empCode, $nameThai, $nameEng, $position, $company, $website, $canView, $toEmail, $empUseName)
	{

		$message = new YiiMailMessage();
		$message->view = 'newEmployee';
		$message->setBody(array(
			"empCode"=>$empCode,
			"nameThai"=>$nameThai,
			"nameEng"=>$nameEng,
			"position"=>$position,
			"company"=>$company,
			"website"=>$website,
			"canView"=>$canView,
			'empUserName'=>$empUseName), 'text/html', 'utf-8');

		//$message->message->setBody($body, 'text/html');
		//$message->message->setBody($body, 'text/plain','utf-8');

		$message->subject = "จดหมายแจ้ง พนักงานใหม่ " . $company . " Intranet";
		$message->addTo($toEmail);
		//$message->from   = ($this->adminEmail);
		$message->setFrom(array(
			'No-Reply@daiigroup.com'=>'แจ้งเตือน Intranet'));
		if(Yii::app()->getParams()->sendEmail)
		{
			Yii::app()->mail->send($message);
		}
		/* Yii::app()->user->setFlash('contact',
		  'Emails sent:'.$email.'\n'.
		  'Thank you for contacting us. We will respond to you as
		  soon as possible.');
		  //$this->refresh(); */
	}

	public function mailNewMemo($createBy, $website, $toEmail)
	{

		$message = new YiiMailMessage();
		$message->view = 'newMemo';
		$message->setBody(array(
			"createBy"=>$createBy,
			"website"=>$website,
			"toEmail"=>$toEmail), 'text/html', 'utf-8');

		//$message->message->setBody($body, 'text/html');
		//$message->message->setBody($body, 'text/plain','utf-8');

		$message->subject = "จดหมายแจ้ง มี Memo ใหม่ Intranet";
		$message->addTo($toEmail);
		//$message->from   = ($this->adminEmail);
		$message->setFrom(array(
			'No-Reply@daiigroup.com'=>'แจ้งเตือน Intranet'));
		if(Yii::app()->getParams()->sendEmail)
		{
			Yii::app()->mail->send($message);
		}
		/* Yii::app()->user->setFlash('contact',
		  'Emails sent:'.$email.'\n'.
		  'Thank you for contacting us. We will respond to you as
		  soon as possible.');
		  //$this->refresh(); */
	}

	public function mailResignEmployee($empCode, $nameThai, $nameEng, $position, $company, $website, $canView, $toEmail, $leaveDate, $empUserName)
	{

		$message = new YiiMailMessage();
		$message->view = 'resignEmployee';
		$message->setBody(array(
			"empCode"=>$empCode,
			"nameThai"=>$nameThai,
			"nameEng"=>$nameEng,
			"position"=>$position,
			"company"=>$company,
			"website"=>$website,
			"canView"=>$canView,
			"leaveDate"=>$leaveDate,
			'empUserName'=>$empUserName), 'text/html', 'utf-8');

		//$message->message->setBody($body, 'text/html');
		//$message->message->setBody($body, 'text/plain','utf-8');

		$message->subject = "จดหมายแจ้ง พนักงานลาออก Intranet";
		$message->addTo($toEmail);
		//$message->from   = ($this->adminEmail);
		$message->setFrom(array(
			'No-Reply@daiigroup.com'=>'แจ้งเตือน Intranet'));
		if(Yii::app()->getParams()->sendEmail)
		{
			Yii::app()->mail->send($message);
		}
		/* Yii::app()->user->setFlash('contact',
		  'Emails sent:'.$email.'\n'.
		  'Thank you for contacting us. We will respond to you as
		  soon as possible.');
		  //$this->refresh(); */
	}

}
