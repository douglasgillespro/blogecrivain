<?php $this->_t = 'Blog de Jean Forteroche';?>
<?php if(!isset($_SESSION['user'])): ?>


<form action="<?= URL ?>admin/login" method="post">
	<h1> Connexion </h1>
	<p>
		<label for="login">Identifiant</label><br />
		<input type="text" id="login" name="login" required>
	</p>
	<p>
		<label for="password">Mot de passe</label><br />
		<input type="password" name="password" id="password" required>
	</p>
	<p>
		<input class="button primary" type="submit" value="se connecter">
	</p>
	<?php if($errors): ?>
		<p>Identifiant ou mot de passe incorrect</p>
<?php endif; ?>
</form>
<?php endif; ?>
<?php if(isset($_SESSION['user']) && isset($_POST['login']) && isset($_POST['password'])) : ?>
<div class="connect">
	<p>Vous êtes connecté</p>
	<p><a href="<?= URL ?>admin/">Aller vers l'administration</a></p>
</div>
<?php endif; ?>