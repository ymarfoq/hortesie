<?php
$db = new PDO('sqlite:base.db');

if($_POST["action"]=="ajout_projet"){

	$id=round(microtime(true)*1000);
	$nom=$_POST["nom"];
	$section=$_POST["section"];
	$description=$_POST["description"];

	$db->exec("INSERT INTO projets (id, nom, section, description) VALUES ('$id','$nom','$section','$description');");
	
	mkdir("images/projets/".$id);
	
	header('location:page.php?section='.$section);
}
elseif($_POST["action"]=="modif_projet"){
	
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$description=$_POST["description"];
	
	$db->exec("update projets set nom=$nom, description=$description where id==$id;");
	
	header('location:page.php?section='.$_POST['section']);
}
elseif($_POST["action"]=="ajout_photos"){
	$projet=$_POST['projet'];
	
	for($i=0; $i < count($_FILES['photos']['name']); $i++){
		
		$id=round(microtime(true)*1000);
		$last=$db->query('SELECT * FROM photos WHERE projet="'.$projet.'" ORDER BY id DESC LIMIT 1;')->fetch();
		$first=$db->query('SELECT * FROM photos WHERE projet="'.$projet.'" ORDER BY id ASC LIMIT 1;')->fetch();
		if($last['id']==""){echo "ok";  $last['id']=$id;}
		if($first['id']==""){echo "ok";  $first['id']=$id;}
				
		$photo="images/projets/".$projet."/".$_FILES['photos']['name'][$i];
		
		if ($_FILES['photos']['error'][$i] > 0) $erreur = "transfert_photo";
	  
		//enregistrement de l'image à l'adresse de $photo
		move_uploaded_file($_FILES['photos']['tmp_name'][$i],$photo);
		
	
		//Modification de la base de données en fonction de l'ajout de la nouvelle photo à la fin de la liste
		$db->exec('INSERT INTO photos (id, pre_id, post_id, projet, photo) VALUES ("'.$id.'","'.$last['id'].'","'.$first['id'].'","'.$projet.'","'.$photo.'");');
		$db->exec('UPDATE photos SET post_id="'.$id.'" WHERE id="'.$last['id'].'";');
		$db->exec('UPDATE photos SET pre_id="'.$id.'" WHERE id="'.$first['id'].'";');
	
	};
	header('location:page.php?section='.$_POST['section']);
}
elseif($_POST["action"]=="supp_photo"){
	
	$photo=$db->query('SELECT * FROM photos WHERE id="'.$_POST['id'].'";')->fetch();
	$db->exec('DELETE FROM photos WHERE id="'.$photo['id'].'";');
	$db->exec('UPDATE photos SET post_id="'.$photo['post_id'].'" WHERE id="'.$photo['pre_id'].'";');
	$db->exec('UPDATE photos SET pre_id="'.$photo['pre_id'].'" WHERE id="'.$photo['post_id'].'";');
	
	header('location:page.php?section='.$_POST['section']);
		
};
?>
