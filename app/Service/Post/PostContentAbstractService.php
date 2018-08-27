<?php
namespace App\Service\Post;

abstract class PostContentAbstractService
{

	protected $id;
	protected $postId;
	protected $postContentMarkdownDoc;
	protected $postContentHtmlCode;


	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPostId($postId)
	{
		$this->postId = $postId;
	}

	public function setPostContentMarkdownDoc($postContentMarkdownDoc)
	{
		$this->postContentMarkdownDoc = $postContentMarkdownDoc;
	}

	public function setPostContentHtmlCode($postContentHtmlCode)
	{
		$this->postContentHtmlCode = $postContentHtmlCode;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPostId()
	{
		return $this->postId;
	}

	public function getPostContentMarkdownDoc()
	{
		return $this->postContentMarkdownDoc;
	}

	public function getPostContentHtmlCode()
	{
		return $this->postContentHtmlCode;
	}




}
