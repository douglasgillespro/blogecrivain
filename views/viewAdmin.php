<?php $this->_t = 'Blog de Jean Forteroche';?>

<h1>Administration</h1>
<h2 id="e">Gestion des articles</h2>
<!-- Formulaire pour créer ou Modifier un article -->
<div class="formpost">
	<form action="#e" method="post">
		<p style="text-align:center">

<?php
if (isset($message)) {
  echo $message, '<br />';
} elseif (isset($errorMessage)) { ?>
	<span class="errormessage"><?= $errorMessage; ?></span><br />
<?php } ?>

			Auteur : <input type="text" name="author" value="<?php if(isset($news)) {echo $news->author();}else {echo 'Jean Forteroche';}?>" required /><br />
			Titre : <input type="text" name="title" value="<?php if(isset($news)) echo $news->title(); ?>" required /><br />
			Contenu : <textarea id="post_content" rows="20" cols="80" name="content" ><?php if(isset($news)) echo $news->content(); ?></textarea><br />
<?php
if(isset($news) && !$news->isNew())
{
?>
	        <input type="hidden" name="id" value="<?= $news->id() ?>" />
	        <input class="button primary" type="submit" value="Mettre à jour" name="modifier" />
	        <button style="background-color: #777777"><a href="../admin/#e">Retour</a></button>
<?php
} else{
?>
        	<input class="button primary" type="submit" value="Ajouter" />
<?php
}
?>
      	</p>
	</form>
</div>

<!-- Tableau qui affiche tous les articles -->
<h2 id="t">Liste des articles</h2>
<button id="refreshbutton"><a href="../admin/#t"><i class="fas fa-sync-alt"></i> Raffraichir les articles</a></button>
<table>
	<thead>
		<tr>
			<th>Titre</th>
			<th>Auteur</th>
			<th>Date</th>
			<th>Commentaires</th>
			<th>-</th>
			<th>-</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($articles as $article) : ?>
			<tr>
				<td><?= $article->title() ?></td>
				<td><?= $article->author() ?></td>
				<td><?= $article->creation_date()->format('d/m/Y') ?></td>
				<td><a href="com=<?=$article->id() ?>#c">Commentaires</a></td>
				<td><a href="edit=<?=$article->id() ?>#e">Editer</a></td>
				<td><a href="delete=<?=$article->id() ?>#t">Supprimer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Tableau des commentaires d'un article -->
<div id="c">
<?php if(!empty($postComments)) { ?> 
<h2>Les commentaires</h2>
<table>
	<thead>
		<tr>
			<th>Pseudo</th>
			<th>Commentaires</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($postComments as $postComment) : ?>
			<tr>
				<td><?= $postComment->pseudo() ?></td>
				<td><?= $postComment->comment() ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php } 
	if($postComments !== null && empty($postComments)){?>
		<p style="color:red">Il n'y a pas de commentaire pour cet article</p>
	<?php } ?>
</div>

<!-- Tableau des commentaires signalés -->
<h2>Liste des commentaires signalés</h2>

<?php if ($reportedComments != null) { ?>

<table id="r">
	<thead>
		<tr>
			<th>Commentaires</th>
			<th>Nombre de signalement</th>
			<th>Articles associés</th>
			<th>Supprimer</th>
			<th>Modérer</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($reportedComments as $reportedComment) : ?>
			<tr>
				<td><?= $reportedComment->comment() ?></td>
				<td><?= $reportedComment->nbr_report() ?></td>
				<td><?php $postController = new PostController() ;$post = $postController->onePost($reportedComment->post_id());
				echo $post->title();
				 ?></td>
				<td><a href="deleteComment=<?= $reportedComment->id() ?>#r">Supprimer</a></td>
				<td><a href="moderateComment=<?= $reportedComment->id() ?>#r">Modérer</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php } else{ ?>
	<p class="white">Aucun commentaire signalé</p>
<?php } ?>



