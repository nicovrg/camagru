<?php
class User
{
	private $_id;
	private $_username;
	private $_email;
	private $_password;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		var_dump($data);
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			echo "</br>";			
			echo "key = ";			
			echo $key;
			echo "</br>";
			echo "method = ";			
			echo $method;
			echo "</br>";
			echo "value = ";			
			echo $value;
			echo "</br>";
			if (method_exists($this, $method))
				$this->method($value);
			// $this->method($value);
		}
	}

	//SETTERS
	public function setId($id)
	{
		$id = (int)$id;

		if ($id > 0)
			$this->_id = $id;
	}
	
	public function setUsername($username)
	{
		echo "inside setUsername";
		if (is_string($username))
			$this->_username = $username;
	}
	
	public function setEmail($email)
	{
		if (is_string($email))
			$this->_email = $email;
	}

	public function setPassword($password)
	{
		if (is_string($password))
			$this->_password = $password;
	}

	//GETTERS	
	public function id()
	{
		return $this->_id;
	}
	
	public function username()
	{
		return $this->_username;
	}
	
	public function email()
	{
		return $this->_email;
	}

	public function password()
	{
		return $this->_password;
	}
}

?>