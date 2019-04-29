<?php 
require_once('views/View.php');

class ControllerPost
{
	protected $_articleManager;
	protected $_commentManager;
	private $_view; 
	protected $_message = null;
	protected $_url;

	public function __construct($url)
	{
		$this->_url = $url;
		if(isset($url) && count($url) != 4) {
			throw new Exception("Page introuvable");
		} 
		else {
			$postController = new PostController();
			$check = $postController->existPost($url[1], $url[2]);
			if($check == false) {
				throw new Exception("Page introuvable");
			}
			else { 
				if(isset($_POST['addComment'])) {
					$commentController = new CommentController();
					$commentController->addComment();
					if(!empty($commentController->errors())){
						$this->_message = $commentController->errors();
					}
				}
				if(!empty($url[3]))
				{
					$todo = explode("=", $url[3]);
					if($todo[0] == 'report') {
					$commentController = new CommentController();
					$commentController->reportComment($todo[1]);
					$this->_message = "Le commentaire a été signalé";
					} else {
						throw new Exception("Page introuvable");
					}
				}
				if($url[0] == 'post'){
					$this->generateViewPost($url);
				}
			}
		}
	}

	private function generateViewPost($url)
	{
		$this->_view = new View('Post');
		$this->_view->setUrl($this->_url);
		$this->_view->generate(array('article' => $this->article($url), 'comments' => $this->comment($url),'message' => $this->_message ));
	}

	private function article($url)
	{
		$postController = new PostController();
		return $postController->getOnePostWithSlug($url[1],$url[2]);
	}
	
	private function comment($url)
	{
		$commentController = new CommentController();
		return $commentController->listPostComments($url[1]);
	}


}