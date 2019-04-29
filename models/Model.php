<?php
abstract class Model
{
	private static $_bdd;

	private static function setBdd()
	{
		self::$_bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
		self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	protected function getBdd()
	{
		if(self::$_bdd == null)
		{
			self::setBdd();
			return self::$_bdd;
		}
		else
		{
			return self::$_bdd;
		}
	}

	protected function getAll($field, $table, $obj, $order)
	{
		$var = [];
		$req = $this->getBdd()->prepare('SELECT ' .$field. ' FROM ' .$table. ' ORDER BY ' .$order);
		$req->execute();
		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{	
			$var[] = new $obj($data);
		}
		$req->closeCursor();
		return $var;
		
	}

	protected function getOne($field, $table, $obj, $id)
	{
		$var = "";
		$req = $this->getBdd()->prepare('SELECT '.$field.' FROM ' .$table. ' WHERE id = :id');
		$req->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$req->execute();
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$var = new $obj($data);
		$req->closeCursor();
		return $var;
	}

}