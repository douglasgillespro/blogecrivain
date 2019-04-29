<?php
class Comment
{
	private $_id;
	private $_post_id;
	private $_pseudo;
	private $_comment;
	private $_comment_date;
	private $_nbr_report;

	public function __construct($data = [])
	{
		if (!empty($data)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
	    {
	      $this->hydrate($data);
	    }
	}

	public function hydrate($data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);

			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	// SETTERS
	public function setId($id)
	{
		$id = (int) $id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}
	public function setPost_id($post_id)
	{
		$post_id = (int) $post_id;
		if($post_id > 0)
		{
			$this->_post_id = $post_id;
		}
	}
	public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}
	}
	public function setComment($comment)
	{
		if (is_string($comment))
		{
			$this->_comment = $comment;
		}
	}
	public function setComment_date($date)
	{
		$this->_comment_date = new DateTime($date);
	}
	public function setNbr_report($report)
	{
		$report = (int) $report;
		if($report >= 0)
		{
			$this->_nbr_report = $report;
		}
	}


	// GETTERS
	public function id()
	{
		return $this->_id;
	}
	public function post_id()
	{
		return $this->_post_id;
	}
	public function pseudo()
	{
		return $this->_pseudo;
	}
	public function comment()
	{
		return $this->_comment;
	}
	public function comment_date()
	{
		return $this->_comment_date;
	}
	public function nbr_report()
	{
		return $this->_nbr_report;
	}

	
}