<?php
class UserController
{
	public function login()
	{

		$loginconnect = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);
	    $passconnect = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
	    if($loginconnect && $passconnect){
			$userManager = new UserManager();
			$result = $userManager->checkLogin($loginconnect, $passconnect);

			if(empty($result)){
				session_destroy();
				return false;
			}
			return $result;
		}	
	}

	public function logout()
	{
		$_SESSION = [];
		session_destroy();
	}
}