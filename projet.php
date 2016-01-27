<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );

if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};

	include('header.php');
		
	if($_SESSION['admin']){
		echo "
		<form method='post' action='base.php'>
			<fieldset>
				<legend> Nouveau </legend>
				<input type='hidden' name='action' value='ajout'>
				<table cellspacing=20>
					<tr>
						<td>
							<input type=radio name='type' value='projet'><label for='type'>Projet</label><br>
							<input type=radio name='type' value='pratique'><label for='type'>Pratique</label>
						</td>
						<td>
							<label for='nom'>Nom du projet : </label>
							<input type='text' name='nom' size=20>
						</td>
						<td>
							<label for='nom'>vignette : </label>
							<input type='file' name='vignette'>
						</td>
					</tr>
						<td>
							<label for='resume'>Résumé :</label>
							<textarea name='resume' rows=8>Résumé du projet en quelques mots</textarea><br><br>
							<label for='motsCles'>Mots clés :</label>
							<textarea name='resume' rows=8>mots,tous,séparés,d'une,virgule</textarea>
						</td>
						<td colspan=2>
							<label for='description'>Description :</label>
							<textarea name='description' rows=20></textarea>
						</td>
						
					</tr>
					<tr>
						<td><input type='submit' value='ajouter'></td>
					</tr>
				</table>
			</fieldset>
		</form>";};
	
	
	$type=$_GET['type'];
	$projets = $db->query("SELECT * FROM projets WHERE type='".$type."';")->fetchAll();
	foreach($projets as $projet){
		echo "
		<a href='page.php?projet=".$projet['id']."' class='vignette'>
			<h4>".$projet['nom']."</h4>
			<img id='".$projet['id']."' src='".$projet['vignette']."' width=130 alt='".$projet['nom']."'>
			<span>".$projet['resume']."</span>
		</a>
		";
	};
?>
		</article>
	</section>
</body
</html>
