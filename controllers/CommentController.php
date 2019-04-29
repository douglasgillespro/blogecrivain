<?php 
class CommentController
{
	protected $_errors;

	public function listPostComments($url)
	{
		if (!empty($url)) {
			$commentManager = new CommentManager();
			return $commentManager->getPostComments($url);
		}
		else {
			header('Location: accueil');
		}
	}

	public function addComment()
  	{			
		$errors = [];

		$safeInput = filter_input_array(INPUT_POST, [
			'pseudo' => FILTER_SANITIZE_STRING,
			'comment' => FILTER_SANITIZE_STRING,
			'post_id' => FILTER_SANITIZE_NUMBER_INT

		]);

		if(is_null($safeInput['pseudo']) || is_null($safeInput['comment']) || empty($safeInput['comment']) || empty($safeInput['pseudo'])) { 
			$errors = "Veuillez remplir tous les champs !";
			$this->_errors = $errors;
		}

		if(!preg_match('`^[[:alnum:]]{3,15}$`',$safeInput['pseudo'])) {
			$errors = "Pseudo incorrect";
			$this->_errors = $errors;
		}

		if(is_null($safeInput['post_id'])) { 
			$errors = "Il n'y a pas d'articles pour ce commentaire";
			$this->_errors = $errors;
		}

		if(empty($errors)) {
			$commentManager = new CommentManager();
			$commentManager->addComments($safeInput['pseudo'], $safeInput['comment'], $safeInput['post_id']);
  		}
  	}

  	public function getReported()
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->getReportComments();
  	}

  	public function reportComment($id)
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->updateNbrReportsComment($id);
  	}

  	public function deleteComment($idComment)
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->deleteComment($idComment);
  	}

  	public function moderateComment($idComment)
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->moderateComment($idComment);
  	}

  	public function deleteAllComments($post_id)
  	{
  		$commentManager = new CommentManager();
  		return $commentManager->deleteAllComments($post_id);
  	}

  	// GETTERS
  	public function errors()
	{
	    return $this->_errors;
	}

}