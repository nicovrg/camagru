<?php
class Picture
{
	private $_id;
	private $_name;
	private $_upload_time;
	private $_owner_id;

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
	public function setPicture_Id($id)
	{
		$id = (int)$id;
		if ($id > 0)
			$this->_id = $id;
	}
	
	public function setPicture_name($picture_name)
	{
		if (is_string($picture_name))
			$this->_name = $picture_name;
	}

	public function setUpload_time($upload_time)
	{
		if (is_string($upload_time))
			$this->_upload_time = $upload_time;
	}

	public function setOwner_account_id($owner_id)
	{
		if (is_string($owner_id))
			$this->_owner_id = $owner_id;
	}

	//GETTERS	
	public function id()
	{
		return $this->_id;
	}
	
	public function name()
	{
		return $this->_name;
	}

	public function uploadTime()
	{
		return $this->_upload_time;
	}

	public function OwnerId()
	{
		return $this->_owner_id;
	}
}

