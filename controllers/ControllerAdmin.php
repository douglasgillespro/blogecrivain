<?php 
require_once('views/View.php');

class ControllerAdmin
{
	protected $_articleManager;
	protected $_commentManager;
	protected $_postController;
	protected $_commentController;
	private $_view; 
	protected $_news;
	protected $_postComments;
	protected $_message;
	protected $_erreurs;
	protected $_errorMessage;
	protected $_url;

	public function __construct($url)
	{
		$this->_url = $url;
		if (isset($url) && count($url) != 2)
		{
			throw new Exception("Page introuvable");
		}
		else
		{   
// Action possible si la session User existe 
			if(isset($_SESSION['user'])){
				if(isset($_POST['author'])){
					$safeInputPost = filter_input_array(INPUT_POST, [
						'author' => FILTER_SANITIZE_STRING,
						'title' => FILTER_SANITIZE_STRING,
						'content' => FILTER_SANITIZE_STRING,
						'id' => FILTER_SANITIZE_NUMBER_INT
					]);


		  			$news = new Article(
					    [
					      'author' => $safeInputPost['author'],
					      'title' => $safeInputPost['title'],
					      'content' => $safeInputPost['content']]
					);
					$news->setSlug($safeInputPost['title']);
					if (!is_null($safeInputPost['id'])) {
					    $news->setId($safeInputPost['id']);
					} 
					if ($news->isValid()) {
					  	$articleManager = new ArticleManager();
					    $articleManager->save($news);
					    
					    $this->_message = $news->isNew() ? 'L\'article a bien été ajouté !' : 'L\'article a bien été mis à jour !';
					    $news = null;
				    }
					else {
				    	$erreurs = $news->errors();
					}
				}
				if (isset($erreurs) && in_array(Article::AUTEUR_INVALIDE, $erreurs))
					$this->_errorMessage = 'L\'auteur est invalide.';
				if (isset($erreurs) && in_array(Article::TITRE_INVALIDE, $erreurs)) 
					$this->_errorMessage = 'Le titre est invalide.';
				if (isset($erreurs) && in_array(Article::CONTENU_INVALIDE, $erreurs)) 
					$this->_errorMessage = 'Le contenu est invalide.';

				if(isset($url[1])){
					$todo = explode("=", $url[1]);
					$postController = new PostController();
					$commentController = new CommentController();
					switch ($todo[0]){
						case "delete":
						$postController->deletePost($todo[1]);
						break;
						case "edit":
						$this->_news = $postController->onePost($todo[1]);
						break;
						case "deleteComment":
						$commentController->deleteComment($todo[1]);
						break;
						case "moderateComment":
						$commentController->moderateComment($todo[1]);
						break;
						case "com":
						$this->_postComments = $commentController->listPostComments($todo[1]);
						break;
						case "logout":
						$userController = new UserController();
						$userController->logout();
						break;
					}
				}
				if($url[0] == 'admin' && $url[1] != 'logout') {
					$this->generateViewPost($url);
				}
			}
// Formulaire d'identification si il n'y a pas de session User
			if ($url[1] == 'login' OR $url[1] == 'logout' ){
				require_once('ControllerLogin.php');
				$controller = new controllerLogin($url);
			}
			if($url[0] == 'admin' && !isset($_SESSION['user']) && empty($url[1])){
				require_once('ControllerLogin.php');
				$controller = new controllerLogin($url);
			}

		}
	}


	private function generateViewPost()
	{
		$this->_postController = new PostController();
		$this->_commentController = new CommentController();
		$this->_view = new View('Admin');
		$this->_view->setUrl($this->_url);
		$this->_view->generate(array('articles' => $this->articles(), 'reportedComments' => $this->reportedComments(), 'news' => $this->_news, 'postComments' => $this->_postComments, 'message' => $this->_message, 'errorMessage' => $this->_errorMessage, ));
	}

	private function articles()
	{
		return $this->_postController->listPosts();
	}
	
	private function reportedComments()
	{
		return $this->_commentController->getReported();		
	}
	
}