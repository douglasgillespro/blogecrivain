<?php 
require_once('views/View.php');

class ControllerAccueil
{
	protected $_articleManager;
	private $_view; 
	protected $_url;

	public function __construct($url)
	{	
		$this->_url = $url;
		if (isset($url) && count($url) > 1) {
			throw new Exception("Page introuvable");
		}
		else {
			$this->generateViewAccueil();
		}
	}

	private function generateViewAccueil()
	{
		$this->_view = new View('Accueil');
		$this->_view->setUrl($this->_url);
		$this->_view->generate(array('articles' => $this->articles()));
	}

	private function articles()
	{
		$postController = new PostController();
		$articles = $postController->listPosts();
		
		foreach($articles as $article) { 

			if (strlen($article->content()) <= 200) {
		  	$article->content();
			}
			else {
		  	$debut = substr($article->content(), 0, 200);
		  	$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
		  	$article->setContent($debut);
			}

		}
			return $articles;
	}

}