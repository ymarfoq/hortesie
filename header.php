<!DOCTYPE html>
<html lang=en>
<head>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>	
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/jssor.slider.mini.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style.css">
	<script type='text/javascript' src='js/script.js'></script>
</head>
<body class="<?php echo $fond; ?>">
	<section>
		<nav>
			<table><tr>
				<td valign=middle width=250> <a class="menu" href="./"><h1>Hortesie</h1></a></td>
				<td valign=middle align=center width=150><a class="menu" href="projet.php?type=pratique">PRATIQUE</a></td>
				<td valign=middle align=center width=150><a class="menu" href="projet.php?type=projet">PROJET</a></td>
				<td valign=middle align=center width=150><a class="menu" href="contact.php">CONTACT</a></td>
				<td class="recherche">
						<form action='recherche.php' method='post'>
							<input type='text' name='recherche'>
							<input type='submit' value='Recherche'>						
						</form>
				</td>
			</tr></table>
			<hr>
		</nav>
		<article>
	<form id='admin' method="post">
		<?php if($_SESSION['admin']){echo "<input type='hidden' name='mdp' id='mdp' value='xxx'><input type='submit' value='EXIT'>";}
			else{echo "<input type='password' name='mdp' size=5 id='mdp' value=''><input type='submit' value=';-)'>";}
			$db = new PDO('sqlite:base.db');
		?>
	</form>
	
