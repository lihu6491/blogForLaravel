<?php
namespace App\Service\Share;

abstract class ShareAbstractService
{

	protected $id;
	protected $classId;
	protected $title;
	protected $abstracts;
	protected $cover;
	protected $urls;
	protected $downInfo;
	protected $createdAt;
	protected $updatedAt;


	public function setId($id)
	{
		$this->id = $id;
	}

	public function setClassId($classId)
	{
		$this->classId = $classId;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setAbstracts($abstracts)
	{
		$this->abstracts = $abstracts;
	}

	public function setCover($cover)
	{
		$this->cover = $cover;
	}

	public function setUrls($urls)
	{
		$this->urls = $urls;
	}

	public function setDownInfo($downInfo)
	{
		$this->downInfo = $downInfo;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}



	public function getId()
	{
		return $this->id;
	}

	public function getClassId()
	{
		return $this->classId;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getAbstracts()
	{
		return $this->abstracts;
	}

	public function getCover()
	{
		return $this->cover;
	}

	public function getUrls()
	{
		return $this->urls;
	}

	public function getDownInfo()
	{
		return $this->downInfo;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}




}
