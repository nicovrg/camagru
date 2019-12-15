<?php
class Picture
{
	private $_id;
	private $_path;
	private $_upload_time;
	private $_picture_owner_id;

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
	public function setPicture_id($id)
	{
		$id = (int)$id;
		if ($id > 0)
			$this->_id = $id;
	}
	
	public function setPicture_path($picture_path)
	{
		if (is_string($picture_path))
			$this->_path = $picture_path;
	}

	public function setUpload_time($upload_time)
	{
		$this->_upload_time = $upload_time;
	}

	public function setPicture_owner_id($picture_owner_id)
	{
		$picture_owner_id = (int)$picture_owner_id;
		echo ("<script type='text/javascript'>console.log('here " . $this->picture_owner_id . "')</script>");
		if ($picture_owner_id > 0)
			$this->_picture_owner_id = $picture_owner_id;
	}

	//GETTERS	
	public function id()
	{
		return $this->_id;
	}
	
	public function path()
	{
		return $this->_path;
	}

	public function uploadTime()
	{
		return $this->_upload_time;
	}

	public function ownerAccountId()
	{
		echo ("<script type='text/javascript'>console.log('here " . $this->_picture_owner_id . "')</script>");
		return $this->_picture_owner_id;
	}
}

