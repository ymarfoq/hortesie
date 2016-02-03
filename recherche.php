<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
$fond="arbre"; 
include('header.php');

$recherche=explode(" ", str_replace(array("?","!",",",";"), " ", strtolower($_POST["recherche"])));

$projects = $db->query('SELECT id,nom,description,motscle FROM projets;')->fetchAll();

$classement=array();

foreach ($projects as $key => $project){
	
	$affinite = count(array_intersect(explode(",",strtolower($project["motscle"])),$recherche));
	
	foreach($recherche as $word){
		$affinite += substr_count(strtolower($project["description"]),$word);
	}
	
	if($affinite>0){
		$classement[$key] = $affinite;
		}
};

arsort($classement);

foreach($classement as $key => $affinite){
	echo $projects[$key]["nom"];
	echo "<br><br>";
	}

?>
		</article>
	</section>
</body>
</html>
