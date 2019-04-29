<?php 
class User
{
	public function checkUser(){
		

	}

	private $_id;
	private $_login;
	private $_password;
	private $_pseudo;

	public function __construct($data = [])
	{
		if (!empty($data))
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
	public function setLogin($login)
	{
		if (is_string($login))
		{
			$this->_login = $login;
		}
	}
	public function setPassword($password)
	{
		if (is_string($password))
		{
			$this->_password = $password;
		}
	}
	public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}
	}

	//GETTERS
	public function id()
	{
		return $this->_id;
	}
	public function login()
	{
		return $this->_login;
	}
	public function password()
	{
		return $this->_password;
	}
	public function pseudo()
	{
		return $this->_pseudo;
	}
}