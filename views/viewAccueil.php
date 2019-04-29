<?php 
$this->_t = 'Blog de Jean Forteroche';
?>
<!-- Header -->
			<section id="header">
				<header class="major">
					<h1>BILLET SIMPLE POUR L'ALASKA</h1>
					<p>Le nouveau roman de Jean Forteroche</p>
				</header>
				<div class="container">
					<ul class="actions special">
						<li><a href="#one" class="buttonlink button primary scrolly">Commencer</a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="public/images/jean-forteroche.jpg" alt="" /></span>
					<div class="content">
						<header class="major">
							<h2>QUI SUIS-JE ?</h2>
							<img class="photo-forteroche" src="public/images/jean-forteroche.jpg" alt="" />
						</header>
						<p>Aliquam ante ac id. Adipiscing interdum lorem praesent fusce pellentesque arcu feugiat. Consequat sed ultricies rutrum. Sed adipiscing eu amet interdum lorem blandit vis ac commodo aliquet integer vulputate phasellus lorem ipsum dolor lorem magna consequat sed etiam adipiscing interdum.</p>
					</div>
					<a href="#two" class="goto-next scrolly">Liste des chapitres</a>
				</div>
			</section>

		<!-- two : article(s) -->
			<section id="two" class="main special">
<?php foreach($articles as $article) : ?>
				<div class="container">
					<article class="content">
						<header class="major">
							<h2><?= $article->title(); ?></h2>
						</header>
						<p><?= $article->content() ?></p>
						<i class="fas fa-comment"></i> <?= $article->nbrComments(); ?>
						<p class="signpost">
							Publié par <span class="author" ><?= $article->author(); ?></span> le <time><?= $article->creation_date()->format('d/m/Y') ?></time>
						</p>
						<a class="boxbutton" href="post/<?= $article->id(); ?>/<?= $article->slug(); ?>/">Lire la suite</a>
					</article>
				</div>
<?php endforeach; ?>
			</section>

