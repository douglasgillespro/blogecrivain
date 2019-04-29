<?php
class ArticleManager extends Model
{
	
	public function getArticles()
	{
		$field = 'id, author, title, content, creation_date, slug ';
		$articles = $this->getAll($field, 'posts', 'Article', 'id DESC');
		foreach ($articles as $article)
		{
			$commentManager = new CommentManager();
			$article->setNbrComments($commentManager->countComments($article->id()));
		}
		return $articles;
	}

	public function getArticle($id)
	{
		$field = 'id, author, title, content, creation_date, slug';
		 return $this->getOne($field, 'posts', 'Article', $id);
	}

	public function getPostWithSlug($id, $slug)
	{
		$var = "";
		$req = $this->getBdd()->prepare('SELECT id, author, title, content, creation_date, slug FROM posts WHERE id = :id AND slug = :slug');
		$req->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$req->bindValue(':slug',$slug, PDO::PARAM_STR);
		$req->execute();
		$data = $req->fetch(PDO::FETCH_ASSOC);
		$var = new Article($data);
		$req->closeCursor();
		return $var;
	}

	protected function add($news)
	{
	    $req = $this->getBdd()->prepare('INSERT INTO posts(author, title, content, slug, creation_date, update_date) VALUES(:author, :title, :content, :slug, NOW(), NOW())');
	    
	    $req->bindValue(':title', $news->title());
	    $req->bindValue(':author', $news->author());
	    $req->bindValue(':content', $news->content());
	    $req->bindValue(':slug', $news->slug());
	    
	    $req->execute();
	}

	 protected function update($news)
	 {
	    $req = $this->getBdd()->prepare('UPDATE posts SET author = :author, title = :title, content = :content, slug = :slug, update_date = NOW() WHERE id = :id');
	    
	    $req->bindValue(':title', $news->title());
	    $req->bindValue(':author', $news->author());
	    $req->bindValue(':content', $news->content());
	    $req->bindValue(':slug', $news->slug());
	    $req->bindValue(':id', $news->id(), PDO::PARAM_INT);
	    
	    $req->execute();
	 }

	public function save($article)
	{
	    if ($article->isValid())
	    {
	      	$article->isNew() ? $this->add($article) : $this->update($article);
	    }
	    else
	    {
	      	throw new RuntimeException('L\'article doit être valide pour être enregistré');
	    }
	}

	public function delete($id)
	{
		$this->getBdd()->exec('DELETE FROM posts WHERE id = '.(int) $id);
	}

	public function existPost($id, $slug) {
		$req = $this->getBdd()->prepare('SELECT COUNT(*) FROM posts WHERE id= :id AND slug = :slug');
		$req->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$req->bindValue(':slug',$slug, PDO::PARAM_STR);
		$req->execute();
		$check = $req->fetchColumn();
        if($check == 0) {
        	return false;
        } else { 
        	return true; }
    }

}