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
	$resume = $_POST['resume'];
	$motscle = $_POST['motscle'];
	$description = $_POST['description'];	
	$sth=$conn->exec('INSERT INTO
				projets(nom, date, type, vignette, resume, motscle, description) 
				VALUES("'.$nom.'","'.$date.'","'.$type.'","'.$vignette.'","'.$resume.'","'.$motscle.'","'.$description.'");');
	
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
}
elseif($action=="changeDiscussion"){
	if($_POST["discussionId"]=="ajoutDiscussion"){
		echo "<form method=POST action='data.php'>
				<input type='hidden' name='action' value='ajoutDiscussion'>
				<label>Sujet</label><input type='text' name='discussionName'><br>
				<input value='ajouter une discussion'type='submit'>
		</form>";
	}
	else {
		$messages = $conn->query('SELECT * FROM discussions WHERE discussionId="'.substr($_POST["discussionId"],10).'";')->fetchAll();
		foreach ($messages as $message) {
			if ($message['message'] != "") {
				echo "<div>
						<p><h3>" . $message['auteur'] . "</h3>, le <span>" . $message['date'] . ", à " . $message['time'] . "</span> : </p>
						<p>" . $message['message'] . "</p>
						<hr>
					</div>";
			}
		};
		
		
	};
}
elseif($action=="changeOrganisation"){
	if($_POST["organisationId"]=="benevole"){
		echo "
			<div class='text'>
				<p>Bonjour,
					<br><br>
					tu souhaites être bénévole pour nous aider à organiser la course de vélo sur neige?
					<br>
					<br>
					tu es au bon endroit ;-)
				</p>
				<br><br>
				<form method=POST action='data.php'>
					<input type='hidden' name='action' value='ajoutBenevole'>
					<label>Prénom : </label><input type='text' name='prenom'>	
					<label>Nom : </label><input type='text' name='nom'>
					<br><br>
					<label>Mail : </label><input type='mail' name='mail' required>
					<br><br>
					<textarea name='motivation' cols=50>Laisse-nous un petit mot sur tes motivations pour nous aider :)</textarea>
					<br><br>
					<input value='devenir bénévole' type='submit'>
			</form>
		</div>";
	}
	elseif($_POST["organisationId"]=="parcours"){
		echo '
		<div id="mapContainer"></div>
		<script type="text/javascript">

var map,mapContainer;
mapContainer = document.getElementById("mapContainer");
function initMap() {
	mapContainer.style.margin="-1px 0";
	mapContainer.style.height="87%";
	map = new google.maps.Map(mapContainer, {
    center: {lat: 45.5335239, lng: -73.6304388},
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });
}
		</script>
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyw86lHFR5aq_tTnf2-VtBLqSjLl1vHG0&callback=initMap">
		</script>
    ';
	}
	elseif($_POST["organisationId"]=="partenaires"){
		echo "<div class=\"text\">";
		if($_SESSION['admin']){echo "
			<form method=POST action='data.php'>
				<input type='hidden' name='action' value='ajoutPartenaire'>
				<table>
					<tr>
						<td><label>Nom : </label></td>
						<td><input type='text' name='nom'></td>
					</tr>
					<tr>
						<td><label>Site : </label></td>
						<td><input type='text' name='site'></td>
					</tr>
					<tr>
						<td><label>Url du logo : </label></td>
						<td><input type='text' name='logo'></td>
					</tr>
					<tr>
						<td><label>Contact : </label></td>
						<td><input type='text' name='contact'></td>
					</tr>
					<tr><td><input value='Ajout du partenaire' type='submit'></td></tr>
				</table>
			</form>
			";
		};
		$partenaires=$conn->query('SELECT * FROM partenaires;')->fetchAll();
		foreach ($partenaires as $partenaire){
			echo "<a href=\"".$partenaire['site']."\" target=\"_blank\" style=\"display:inline-block; margin:20px;\"><img src=\"".$partenaire['logo']."\" height=100></a>";
		};
		echo "</div>";
	};
}
elseif($action=="ajoutBenevole"){
	$sth=$conn->exec('INSERT INTO benevoles(prenom, nom, mail,motivation) VALUES("'.$_POST['prenom'].'","'.$_POST['nom'].'","'.$_POST['mail'].'","'.$_POST['motivation'].'");');
	$mail="Bonjour, 
	Une nouvelle demande de bénévolat vient d'arriver pour la course de vélo.
	
	".$_POST['prenom']." ".$_POST['nom']." voudrait être bénévol(e) pour les raisons suivantes : 
	
	".$_POST['motivation'].".
	
	Vous pouvez le(a) joindre à l'adresse suivante : ".$_POST['mail'].".";
	if(mail("marfoq.yohan@gmail.com" , "Nouveau bébévole ;-)", $mail, 'From: webmaster@coursevelosurneige.com')){echo "envoie ok";};
	
	header('Location:./?organisation=benevole');
}
elseif($action=="ajoutPartenaire"){
	$sth=$conn->exec('INSERT INTO partenaires(nom, site, logo ,contact) VALUES("'.$_POST['nom'].'","'.$_POST['site'].'","'.$_POST['logo'].'","'.$_POST['contact'].'");');
	header('Location:./?organisation=partenaires');
};

?>
