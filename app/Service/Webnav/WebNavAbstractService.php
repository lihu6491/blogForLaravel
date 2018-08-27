<?php
namespace App\Service\Webnav;

abstract class WebNavAbstractService
{

	protected $id;
	protected $classId;
	protected $name;
	protected $urls;
	protected $cover;


	public function setId($id)
	{
		$this->id = $id;
	}

	public function setClassId($classId)
	{
		$this->classId = $classId;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setUrls($urls)
	{
		$this->urls = $urls;
	}

	public function setCover($cover)
	{
		$this->cover = $cover;
	}



	public function getId()
	{
		return $this->id;
	}

	public function getClassId()
	{
		return $this->classId;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getUrls()
	{
		return $this->urls;
	}

	public function getCover()
	{
		return $this->cover;
	}




}
