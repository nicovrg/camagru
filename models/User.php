<?php
class User
{
	private $_account_id;
	private $_username;
	private $_email;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))
				$this->$method($value);
		}
	}

	//SETTERS
	public function setAccount_id($account_id)
	{
		$account_id = (int)$account_id;
		
		if ($account_id > 0)
			$this->_account_id = $account_id;
	}
	
	public function setUsername($username)
	{
		if (is_string($username))
			$this->_username = $username;
	}
	
	public function setEmail($email)
	{
		if (is_string($email))
			$this->_email = $email;
	}

	//GETTERS	
	public function getAccount_id()
	{
		return $this->_account_id;
	}
	
	public function getUsername()
	{
		return $this->_username;
	}
	
	public function getEmail()
	{
		return $this->_email;
	}
}

?>