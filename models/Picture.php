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
	public function setId($id)
	{
		$id = (int)$id;
		if ($id > 0)
			$this->_id = $id;
	}
	
	public function setName($name)
	{
		if (is_string($name))
			$this->_name = $name;
	}

	public function setUploadTime($upload_time)
	{
		if (is_string($upload_time))
			$this->_upload_time = $upload_time;
	}

	public function setOwnerId($owner_id)
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
		return $this->_picture_name;
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

?>