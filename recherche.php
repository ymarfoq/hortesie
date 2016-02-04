<?php session_start(); 
$fond="arbre"; 
include('header.php');

$recherche=explode(" ", str_replace(array("?","!",",",";"), " ", strtolower($_POST["recherche"])));

$projets = $db->query('SELECT id,nom,vignette,resume,motscle,description FROM projets;')->fetchAll();

$classement=array();

foreach ($projets as $key => $projet){
	
	$affinite = count(array_intersect(explode(",",strtolower($projet["motscle"])),$recherche));
	
	foreach($recherche as $word){
		$affinite += substr_count(strtolower($projet["description"]),$word);
		$affinite += substr_count(strtolower($projet["resume"]),$word);
	};
	if($affinite>0){
		$classement[$key] = $affinite;
		};
};

arsort($classement);
echo "<div><h5>Résultats de la recherche : ".str_replace(array("?","!",",",";"), " ", strtolower($_POST["recherche"]))."</h5></div><br><br><hr>";
if(count($classement)==0){echo "<br><div>Aucun résultat ne correspond à le recherche.</div><br>";}
foreach($classement as $key => $affinite){
	echo"
		<div>
			<h2>".$projets[$key]['nom']."</h2>
			<img id='".$projets[$key]['id']."' src='".$projets[$key]['vignette']."' width=100 alt='".$projets[$key]['nom']."'>
			<p class='resume'>".$projets[$key]['resume']."</p>
		</div>
		<hr>";	
	};
?>
		</article>
	</section>
</body>
</html>
