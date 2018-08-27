<?php
namespace App\Service\Post;

abstract class PostAbstractService
{

	protected $id;
	protected $title;
	protected $abstracts;
	protected $slightly;
	protected $auth;
	protected $isOriginal;
	protected $classify;
	protected $tags;
	protected $topOrder;
	protected $commentsNum;
	protected $zanNum;
	protected $readNum;
	protected $status;
	protected $isTop;
	protected $isHide;
	protected $isDel;
	protected $updatedAt;
	protected $createdAt;
	protected $deletedAt;

    const POST_STATUS_TODO = 1;
    const POST_STATUS_COMPLETE = 2;
    const POST_STATUS_DELETE = 3;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setAbstracts($abstracts)
	{
		$this->abstracts = $abstracts;
	}

	public function setSlightly($slightly)
	{
		$this->slightly = $slightly;
	}

	public function setAuth($auth)
	{
		$this->auth = $auth;
	}

	public function setIsOriginal($isOriginal)
	{
		$this->isOriginal = $isOriginal;
	}

	public function setClassify($classify)
	{
		$this->classify = $classify;
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}

	public function setTopOrder($topOrder)
	{
		$this->topOrder = $topOrder;
	}

	public function setCommentsNum($commentsNum)
	{
		$this->commentsNum = $commentsNum;
	}

	public function setZanNum($zanNum)
	{
		$this->zanNum = $zanNum;
	}

	public function setReadNum($readNum)
	{
		$this->readNum = $readNum;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function setIsTop($isTop)
	{
		$this->isTop = $isTop;
	}

	public function setIsHide($isHide)
	{
		$this->isHide = $isHide;
	}

	public function setIsDel($isDel)
	{
		$this->isDel = $isDel;
	}

	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function setDeletedAt($deletedAt)
	{
		$this->deletedAt = $deletedAt;
	}



	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getAbstracts()
	{
		return $this->abstracts;
	}

	public function getSlightly()
	{
		return $this->slightly;
	}

	public function getAuth()
	{
		return $this->auth;
	}

	public function getIsOriginal()
	{
		return $this->isOriginal;
	}

	public function getClassify()
	{
		return $this->classify;
	}

	public function getTags()
	{
		return $this->tags;
	}

	public function getTopOrder()
	{
		return $this->topOrder;
	}

	public function getCommentsNum()
	{
		return $this->commentsNum;
	}

	public function getZanNum()
	{
		return $this->zanNum;
	}

	public function getReadNum()
	{
		return $this->readNum;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getIsTop()
	{
		return $this->isTop;
	}

	public function getIsHide()
	{
		return $this->isHide;
	}

	public function getIsDel()
	{
		return $this->isDel;
	}

	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function getDeletedAt()
	{
		return $this->deletedAt;
	}




}
