<!DOCTYPE html>
<html>
	<head>
		<title><?= $t ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<?php if($url[0] == 'accueil' || empty($url[0])){ ?>
		<link rel="stylesheet" href="public/assets/css/main.css" />
		<link rel="stylesheet" href="public/assets/css/menu.css" />
<?php } elseif($url[0] == 'post'){ ?> 
		<link rel="stylesheet" href="../../../public/assets/css/main.css" />
		<link rel="stylesheet" href="../../../public/assets/css/menu.css" />
		<link rel="stylesheet" href="../../../public/assets/css/post.css" />
<?php } elseif(isset($_SESSION['user']) && $url[0] == 'admin'){ ?>
		<link rel="stylesheet" href="../public/assets/css/menu.css" />
		<link rel="stylesheet" href="../public/assets/css/main.css" />
		<link rel="stylesheet" href="../public/assets/css/admin.css" />
		<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=f0y8p3jdfcz0ktpku5705v2i0a29t1 h19lzykrsc8c1vgv8c"></script>
<?php } elseif (!isset($_SESSION['user']) && $url[0] == 'admin') {?>
		<link rel="stylesheet" href="../public/assets/css/login.css" />
		<link rel="stylesheet" href="../public/assets/css/menu.css" />
		<link rel="stylesheet" href="../public/assets/css/main.css" />
<?php } else { ?> 
		<link rel="stylesheet" href="../public/assets/css/menu.css" />
		<link rel="stylesheet" href="../public/assets/css/main.css" />
<?php } ?>
	</head>
	<header>
	<aside>
        <div class="close">
            <div></div>
            <div></div>
        </div>
        <nav>
            <ul>
                <li><a href="<?= URL ?>accueil">ACCUEIL</a></li>
<?php if(!isset($_SESSION['user'])){ ?>		
				<li><a href="<?= URL ?>admin/login">ADMINISTRATION</a></li>
<?php } ?>
<?php if(isset($_SESSION['user'])){ ?>
				<li><a href="<?= URL ?>admin/">ADMINISTRATION</a></li>
				<li><a href="<?= URL ?>admin/logout">SE DECONNECTER</a></li>
<?php } ?>
            </ul>
        </nav>
    </aside>
    
    <div class="overlay"></div>

    <div class="hamburger_menu">
        <div></div>
        <div></div>
        <div></div>
    </div> 
	</header>
	<body>
		<?= $content ?>	
	</body>
<?php if($url[0] == 'accueil' || empty($url[0])){ ?>
	<footer>
        <div>
                <ul class="footer">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Conditions générales d'utilisation</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                </ul><hr>
            <p>Copyright © <?= date('Y') ?> Tous droits réservés</p>
        </div>
	</footer>
<?php } ?>
	<!-- Script jquery-->
			<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- Scripts accueil-->
<?php if($url[0] == 'accueil' || empty($url[0])){ ?>
			<script src="public/js/menu.js"></script>
			<script src="public/assets/js/jquery.min.js"></script>
			<script src="public/assets/js/jquery.scrollex.min.js"></script>
			<script src="public/assets/js/jquery.scrolly.min.js"></script>
			<script src="public/assets/js/browser.min.js"></script>
			<script src="public/assets/js/breakpoints.min.js"></script>
			<script src="public/assets/js/util.js"></script>
			<script src="public/assets/js/main.js"></script>
<?php } ?>
	<!-- Scripts page post-->
<?php if($url[0] == 'post'){ ?>
			<script src="../../../public/js/menu.js"></script>
<?php } ?>
	<!-- Scripts admin-->
<?php if(isset($_SESSION['user']) && $url[0] == 'admin'){ ?>
		<script  src="../public/js/tinymce.js"> </script>
		<script src="../public/js/fr_FR.js"> </script>
		<script src="../public/js/menu.js"></script>	
<?php }if (!isset($_SESSION['user']) && $url[0] == 'admin') {?>
		<script src="../public/js/menu.js"></script>
<?php } ?>
</html>
