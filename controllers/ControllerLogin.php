<?php 
require_once('views/View.php');

class ControllerLogin
{
	protected $_errors = false;
	private $_view;
	protected $_url;


	public function __construct($url)
	{
		$this->_url = $url;
		if (isset($url) && count($url) > 2)
		{
			throw new Exception("Page introuvable");
		}
		else
		{
			if(isset($_POST['login']) && isset($_POST['password'])){
				$userController = new UserController();
				$login = $userController->login();
				if ($login != false){ $_SESSION['user'] = $login;
				} else {
					$this->_errors = true;
					
				}
			}
			$this->generateViewPost();
		}
	}

	private function generateViewPost()
	{
		$this->_view = new View('Login');
		$this->_view->setUrl($this->_url);
		$this->_view->generate(array('errors' => $this->_errors));
	}	
}