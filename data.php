<?php
session_start();
if(!isset($_SESSION['admin'])){$_SESSION['admin']=0;};

$conn = new PDO('sqlite:base.db');

$conn->exec("CREATE TABLE IF NOT EXISTS projets(
									id INTEGER PRIMARY KEY,
									nom TEXT,
									date TEXT,
									type TEXT,
									vignette TEXT,
									resume TEXT,
									motscle TEXT,
									description TEXT,
									lien TEXT,
									contact TEXT);");

$conn->exec("CREATE TABLE IF NOT EXISTS photos(
									id INTEGER PRIMARY KEY,
									idProjet INTEGER,
									nom TEXT,
									date TEXT);");

$action=$_POST['action'];

if($action=="ajoutProjet"){
	$nom = $_POST['nom'];
	$date=date("d/m/Y h:i:s");
	$type = $_POST['type'];
	if($_FILES['vignette']['size']>50){
		$vignette = "images/vignettes/".time()."".strtolower(strrchr($_FILES['vignette']['name'], '.'));
		move_uploaded_file($_FILES['vignette']['tmp_name'],$vignette);
	}
	else{$vignette="images/vignettes/standard.png";}
	$motscle = $_POST['motscle'];
	$description = $_POST['description'];	
	$sth=$conn->exec('INSERT INTO
				projets(nom, date, type, vignette, motscle, description) 
				VALUES("'.$nom.'","'.$date.'","'.$type.'","'.$vignette.'","'.$motscle.'","'.$description.'");');
	
 header('Location:projet.php?type='.$type);
}
elseif($action=="supprimerProjet"){
	$id=$_POST['id'];
	$sth=$conn->exec('DELETE FROM projets WHERE id="'.$id.'";');
	header('Location:./projet.php?type='.$_POST['type']);
}
elseif($action=="ajouterPhotos"){
	if(count($_FILES['albumPhoto']['name'])) {
		foreach ($_FILES['albumPhoto']['name'] as $position => $file) {
			$nom = "images/projets/".$_POST["idProjet"]."/".strtolower($file);
			move_uploaded_file($_FILES['albumPhoto']['tmp_name'][(string)$position],$nom);
			$sth=$conn->exec('INSERT INTO photos(idProjet, nom) VALUES("'.$_POST["idProjet"].'","'.$nom.'");');
		}
	}
	header('Location:./page.php?projet='.$_POST["idProjet"]);
}
elseif($action=="supprimerPhoto"){
	$sth=$conn->exec('DELETE FROM photos WHERE id="'.$_POST['id'].'";');
	header('Location:./page.php?projet='.$_POST['idProjet']);
}
elseif($action=="ajoutDiscussion"){
	$count=$conn->query('SELECT MAX(discussionId) as max from discussions;')->fetch();
	$conn->exec('INSERT INTO discussions(discussionId, discussionName) VALUES('.($count["max"]+1).',"'.$_POST["discussionName"].'");');
	header('Location:./?discussion='.($count["max"]+1));
};

?>
