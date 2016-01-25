<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>	
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style.css">
	<script type='text/javascript' src='script.js'></script>
	<style>
		section{width:80%;}
		table{width:100%;}
		article{margin-bottom:80px;}
		.description{display:inline-block; width:35%; vertical-align:top; text-align:center;}
		h2{margin:20px;}
		.image{width:60%; display:inline-block;}
	</style>
</head>
<body>
	<section>
		<nav>
			<table><tr>
				<td valign=middle width=250> <a class="menu" href="./"><h1>Hortesie</h1></a></td>
				<td valign=middle align=center width=120><a class="menu" href="page.php?section=pratique">PRATIQUE</a></td>
				<td valign=middle align=center width=120><a class="menu" href="page.php?section=projet">PROJET</a></td>
				<td valign=middle align=center width=120><a class="menu" href="page.php?section=recherche">RECHERCHE</a></td>
				<td class="contact">
					(514) 569 - 0985
					<br>yohan.marfoq@hmail.com
				</td>
			</tr></table>
			<hr>
		</nav>
	<form id='admin' method="post">
		<?php if($_SESSION['admin']){echo "<input type='hidden' name='mdp' id='mdp' value='xxx'><input type='submit' value='EXIT'>";}
			else{echo "<input type='password' name='mdp' size=5 id='mdp' value=''><input type='submit' value=';-)'>";}
		?>
	</form>
		<?php
		$db = new PDO('sqlite:base.db');
		
		if($_SESSION['admin']){
			echo "
		<form method='post' action='base.php'>
			<fieldset>
				<legend>Nouveau</legend>
				<input type='hidden' name='action' value='ajout'>
				<table cellspacing=20>
					<tr>
						<td>
							<input type=radio name=\"type\" value=\"projet\"><label for \"type\">Projet</label><br>
							<input type=radio name=\"type\" value=\"pratique\"><label for \"type\">Pratique</label>
						</td>
						<td>
							<label for='nom'>Nom : </label>
							<input type='text' name='nom' size=20>
						</td>
						<td>
							<label for=\"motsCles\">Mots clés :</label>
							<input type=text name=motsCles size=40 placeholder=\"mots,tous,séparés,de,virgule,et,sans,article\">
						</td>
					
					</tr>
						<td colspan=2>
							<textarea name='description' rows=8 cols=100%>Description</textarea>
						</td>
						<td>
							<textarea name='resume' rows=4>Résumé du projet en quelques mots</textarea>
						</td>
					</tr>
					<tr>
						<td><input type='submit' value='ajouter'></td>
					</tr>
				</table>
			</fieldset>
		</form>";};
		
		$projets = $db->query('SELECT * FROM projets ORDER BY id DESC;')->fetchAll();
		foreach($projets as $projet){
			$vignette = $db->query('SELECT * FROM photos WHERE projet="'.$projet['id'].' LIMIT BY 1";')->fetch();
			echo "<img src='".$vignette['photo']."' width=50 alt=\"$projet['name']\" title=\"$projet['resume']\">";
		};
?>
	</section>
<script>
	$(document).ready(function(){
		$('.photos').slick({
			dots:true,
			arrows:true,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear'
		});
	});
</script>
</body
</html>
