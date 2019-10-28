<?php
class User
{
	private $_id;
	private $_username;
	private $_email;
	private $_password;
	private $_reg_time;

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
				$this->method($value);
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
        if (is_string($username))
            $this->_username = $username;
    }
	
	public function setPic($pic)
    {
        if (is_string($pic))
            $this->_pic = $pic;
    }
	
	public function setBio($bio)
    {
        if (is_string($bio))
            $this->_bio = $bio;
    }
	
	public function setEmail($email)
    {
        if (is_string($email))
            $this->_email = $email;
    }
	
	public function setAuth($bool)
    {
        if (is_bool($bool))
            $this->_authenticated = $bool;
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
	
	public function pic()
    {
        return $this->_pic;
    }
	
	public function bio()
    {
        return $this->_bio;
    }
	
	public function email()
    {
        return $this->_email;
    }
	
	public function isAuthenticated()
    {
        return $this->_authenticated;
    }
}

?>