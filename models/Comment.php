<?php
class Comment
{
	private $_picture_id;
	private $_comment_id;
	private $_comment_content;
	private $_comment_time;
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
	public function setComment_id($comment_id)
	{
		$comment_id = (int)$comment_id;
		if ($comment_id > 0)
			$this->_comment_id = $comment_id;
	}

	public function setPicture_id($picture_id)
	{
		$picture_id = (int)$picture_id;
		if ($picture_id > 0)
			$this->_picture_id = $picture_id;
	}
	
	public function setComment_content($comment_content)
	{
		if (is_string($comment_content))
			$this->_comment_content = $comment_content;
	}

	public function setComment_time($comment_time)
	{
		$this->_comment_time = $comment_time;
	}

	public function setOwner_account_id($owner_account_id)
	{
		$owner_account_id = (int)$owner_account_id;
		if ($owner_account_id > 0)
			$this->_owner_account_id = $owner_account_id;
	}

	//GETTERS
	public function comment_id()
	{
		return $this->_comment_id;
	}

	public function picture_id()
	{
		return $this->_picture_id;
	}

	public function comment_content()
	{
		return $this->_comment_content;
	}

	public function commentTime()
	{
		return $this->_comment_time;
	}

	public function ownerAccountId()
	{
		return $this->_owner_account_id;
	}
}

