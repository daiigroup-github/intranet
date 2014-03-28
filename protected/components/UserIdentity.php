<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	const ERROR_STATUS_WRONG = 5;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;

	/* public function authenticate()
	  {
	  $users=array(
	  // username => password
	  'demo'=>'demo',
	  'admin'=>'admin',
	  );
	  if(!isset($users[$this->username]))
	  $this->errorCode=self::ERROR_USERNAME_INVALID;
	  else if($users[$this->username]!==$this->password)
	  $this->errorCode=self::ERROR_PASSWORD_INVALID;
	  else
	  $this->_id = 1;
	  $this->username = "Admin";
	  $this->errorCode=self::ERROR_NONE;
	  return !$this->errorCode;
	  } */

	public function authenticate()
	{
		$username = strtolower($this->username);
		$employee = Employee::model()->find('username=?', array(
			$username));

		if ($employee === NULL)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (!$employee->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else if ($employee->status == 2 || $employee->status == 3)
		{
			$this->errorCode = self::ERROR_STATUS_WRONG;
		}
		else
		{
			$this->_id = $employee->employeeId;
			$this->username = $employee->username;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode === self::ERROR_NONE;
	}

	public function getId()
	{
		return $this->_id;
	}

}

