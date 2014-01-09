<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ChangePassword extends CFormModel
{

	public $oldPassword;
	public $password;
	public $password_repeat;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array(
				'oldPassword, password',
				'required'),
			// password needs to be authenticated
			array(
				'password',
				'compare'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>'รหัสผ่านเดิม',
			'password'=>'รหัสผ่านใหม่',
			'password_repeat'=>'ยืนยันรหัสผ่านใหม่',
		);
	}

	public function validatePasswordFormat($password)
	{
		//Password complexity
		//Tests if the input consists of 8 or more characters.
		//The input must contain at least one upper case letter, one lower case letter and one digit.
		if(preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
