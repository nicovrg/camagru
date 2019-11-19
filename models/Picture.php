<?php
class Picture
{
	private $_picture_id;
	private $_picture_name;

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
	public function setPicture_id($picture_id)
	{
		$picture_id = (int)$picture_id;
		
		if ($picture_id > 0)
			$this->_picture_id = $picture_id;
	}
	
	public function setPicture_name($picture_name)
	{
		if (is_string($picture_name))
			$this->_picture_name = $picture_name;
	}

	//GETTERS	
	public function picture_id()
	{
		return $this->_picture_id;
	}
	
	public function name()
	{
		return $this->_picture_name;
	}
}

?>