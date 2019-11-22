<?php
class Like
{
	private $_picture_id;
	private $_like_id;
	private $_like_time;
	private $_owner_account_id;

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
	public function setLike_id($like_id)
	{
		$like_id = (int)$like_id;
		if ($like_id > 0)
			$this->_like_id = $like_id;
	}

	public function setPicture_id($picture_id)
	{
		$picture_id = (int)$picture_id;
		if ($picture_id > 0)
			$this->_picture_id = $picture_id;
	}
	
	public function setLike_time($like_time)
	{
		$this->_like_time = $like_time;
	}

	public function setOwner_account_id($owner_account_id)
	{
		$owner_account_id = (int)$owner_account_id;
		if ($owner_account_id > 0)
			$this->_owner_account_id = $owner_account_id;
	}

	//GETTERS	
	public function like_id()
	{
		return $this->_id;
	}

	public function picture_id()
	{
		return $this->_id;
	}

	public function likeTime()
	{
		return $this->_upload_time;
	}

	public function ownerAccountId()
	{
		return $this->_owner_id;
	}
}

