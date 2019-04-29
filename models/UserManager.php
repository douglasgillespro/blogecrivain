<?php
class UserManager extends Model
{

	public function checkLogin($login, $password)
	{
		$req = $this->getBdd()->prepare('SELECT login, password FROM users WHERE login = :user_login');
		$req->bindValue(':user_login',$login ,PDO::PARAM_STR);
		$req->execute();
		$admin = $req->fetch(PDO::FETCH_ASSOC);
		if(password_verify($password, $admin['password'])) {
			$adminInfo = array('user_login' => $admin['login'],);
			return $adminInfo;
		} else {
			return false;
		}
	}

}