<?php 
class PostController
{
	public function listPosts()
	{
		$postManager = new ArticleManager();
		return $postManager->getArticles();
	}

	public function onePost($id)
	{
		$postManager = new ArticleManager();
		return $postManager->getArticle($id);
	}

	public function getOnePostWithSlug($id, $slug)
	{
		$postManager = new ArticleManager();
		return $postManager->getPostWithSlug($id, $slug);
	}
	public function deletePost($id)
	{
		$commentController = new CommentController();
		$commentController->deleteAllComments($id);
		$postManager = new ArticleManager();
		return $postManager->delete($id);
	}

	public function existPost($id, $slug) 
	{
		$postManager = new ArticleManager();
		return $postManager->existPost($id, $slug);
	}
}