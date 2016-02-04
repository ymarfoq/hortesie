<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
 //if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
 ?>
<!DOCTYPE html>
<html lang=en>
<head>
	<style>
html{height:100%;}
body{height:100%; margin:0;}
section{height:100%; background:url("./images/arbre.jpg"); background-size:100% 100%;}	
.bouteille{position:fixed; width:0; padding:10px 0 10px 40px; overflow:hidden; text-decoration:none; cursor:pointer;}
.bouteille:hover{width:auto;}
.bouteille h1{padding:3px 6px; color:black; display:table-cell; font-size:20px; font-family:"Verdana"; background:#C4D3CC; border:1px solid #7F7F7F}
#b1{top:42%; left:39%;}	
#b2{top:47.2%; left:63.5%;}	
#b3{top:70.3%; left:24.7%;}	
#b4{top:74.3%; left:51.3%;}
	</style>
</head>
<body>
	<section>
		<a class="bouteille" id="b1" href="projet.php?type=pratique"><h1>PRATIQUE</h1></a>
		<a class="bouteille" id="b2" href="projet.php?type=projet"><h1>PROJET</h1></a>
		<a class="bouteille" id="b3" href="contact.php?"><h1>CONTACT</h1></a>
		<!--<a class="bouteille" id="b4" href="recherche.php"><h1>RECHERCHE</h1></a>-->
		<form class="bouteille" id="b4" action='recherche.php' method='post'>
							<h1><input type='text' name='recherche'>
							<input type='submit' value='Recherche'></h1>					
						</form>
	</section>
</body
</html>
