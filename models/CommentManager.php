<?php
class CommentManager extends Model
{

	public function countComments($post_id)
	{
		$req = $this->getBdd()->query('SELECT COUNT(*) FROM comments WHERE post_id =' .$post_id)->fetchColumn();

	  	return $req;
 	}

 	public function getPostComments($post_id)
 	{
 		$field = 'id, post_id, pseudo, comment, comment_date ';
 		$table = 'comments WHERE post_id ='.$post_id;
 		$order = 'id DESC';
		return $this->getAll($field, $table, 'Comment', $order);
 	}

 	public function addComments($pseudo, $comment, $post_id)
  {
    $req = $this->getBdd()->prepare('INSERT INTO comments (pseudo, comment, post_id, comment_date) VALUES(:pseudo, :comment, :post_id, NOW())');
    
    $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->bindValue(':comment', $comment, PDO::PARAM_STR);
    $req->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    
    $req->execute();
  }

  public function getReportComments()
 	{
 		$field = 'id, post_id, comment, nbr_report';
 		$table = 'comments WHERE nbr_report > 0';
 		$order = 'nbr_report DESC';
 		return $this->getAll($field, $table, 'Comment', $order);
 	}

  public function updateNbrReportsComment($id) 
  {
    $req = $this->getBdd()->prepare('UPDATE comments SET nbr_report = nbr_report+1  WHERE id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
  }

  public function deleteComment($id)
  {
    $this->getBdd()->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  public function deleteAllComments($post_id)
  {
    $this->getBdd()->exec('DELETE FROM comments WHERE post_id = '.(int) $post_id);
  }

  public function moderateComment($id)
  {
    $req = $this->getBdd()->prepare('UPDATE comments SET nbr_report = 0  WHERE id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
  }

}