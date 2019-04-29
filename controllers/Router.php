<?php
require_once('views/View.php');
class Router
{
	private $_ctrl;
	private $_view;

	public function routeReq()
	{
		try
		{                      
			// CHARGEMENT AUTOMATIQUE DES CLASSES
			spl_autoload_register ( function($class) {

				$sources = array("controllers/$class.php", "models/$class.php" );

    			foreach ($sources as $source) {
        			if (file_exists($source)) {
            			require_once $source;
            		} 
    			} 
			});

			
$array = explode ( "/", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL  , FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW));
$url = array_slice($array, 3);

			if($url[0] != null && !empty($url))  {

				$controller = ucfirst(strtolower($url[0]));
				$controllerClass = "Controller".$controller;
				$controllerFile = "controllers/" .$controllerClass. ".php";

				if(file_exists($controllerFile)) {
					require_once($controllerFile);
					$this->_ctrl = new $controllerClass($url);
				}
				else {
					throw new Exception('Page introuvable');
				}
			}
			else {
				require_once('controllers/ControllerAccueil.php');
				$this->_ctrl = new ControllerAccueil($url);
			}
		}
		// GESTION DES ERREURS
		catch(Exception $e)
		{
			$errorMessage = $e->getMessage();
			$this->_view = new View('Error');
			$this->_view->generate(array('errorMessage' => $errorMessage));
		}
	}
}
