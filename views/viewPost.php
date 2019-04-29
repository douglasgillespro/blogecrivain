<?php 
$this->_t = 'Blog de Jean Forteroche';
?>

	<article>
		<h1><?= $article->title(); ?></h1>
		<div  id="post">
			<p><?= $article->content(); ?></p>
			<br />
			<em>
				Publié par <strong><?= $article->author(); ?></strong> le <time><?= $article->creation_date()->format('d/m/Y') ?></time>
			</em>
		</div>
	</article>
	<br />
	<div id="comments">
		<h2>Commentaires</h2>
		<?php if(isset($message)){ ?>
			<p class="message"> <?= $message; ?></p>
		<?php } ?>
		<hr>
		<form id="newComment" action="#comments" method="post">
	            <p>
	                <input id="pseudo" type="text"  name="pseudo" placeholder="Entrez votre pseudo" maxlength="100" required />
	            </p>
	            <p>
	                <textarea id="comment" name="comment" placeholder="Entrez votre commentaire" cols="50" rows="5" required></textarea>
	            </p>
	            <?php  if(isset($errors)){echo $errors;} ?>
	            <p>
	                <input class="button" type="submit" value="Poster" name="addComment"/>
	            </p>
	            <input type="hidden" id="post_id" name="post_id" value="<?= $article->id(); ?>" >
	    </form>
	<div id="listcomments">
		<?php 
		foreach($comments as $comment) :
		?>

		<div class="comment">
			<b><?= ucfirst($comment->pseudo()); ?></b>
			<span>-</span>
			<span>Le <?= $comment->comment_date()->format('d/m/Y à H\hi'); ?></span>
			<a class="linkreport" href="report=<?= $comment->id() ?>#comments">Signaler</a>
			<div><?= $comment->comment() ?></div>
		</div>

		<?php endforeach; ?>
	</div>
</div>

	