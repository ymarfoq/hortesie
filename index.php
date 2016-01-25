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
.bouteille{position:fixed; height:8%; width:2%; overflow:hidden; text-decoration:none; border-radius:20px; border:2px solid red;}
.bouteille:hover{width:auto;}
.bouteille h1{margin-top:18px; margin-left:40px; margin-right:10px; vertical-align:middle; color:red; font-size:30px; font-family:"verdana";}
#b1{top:42%; left:39%;}	
#b2{top:47.2%; left:63.5%;}	
#b3{top:70.3%; left:24.7%;}	
#b4{top:74.3%; left:51.3%;}
	</style>
</head>
<body>
	<section>
		<a class="bouteille" id="b1" href="page.php?section=pratique"><h1>PRATIQUE</h1></a>
		<a class="bouteille" id="b2" href="page.php?section=projet"><h1>PROJET</h1></a>
		<a class="bouteille" id="b3" href="page.php?section=contact"><h1>CONTACT</h1></a>
		<a class="bouteille" id="b4" href="page.php?section=recherche"><h1>RECHERCHE</h1></a>
	</section>
</body
</html>
