<?php session_start(); 

	include('header.php');
		
	if($_SESSION['admin']){
		echo "
		<form enctype='multipart/form-data' method='post' action='data.php' >
			<fieldset>
				<legend> Nouveau </legend>
				<input type='hidden' name='action' value='ajoutProjet'>
				<table cellspacing=20>
					<tr>
						<td>
							<input type=radio name='type' value='projet' checked><label for='type'>Projet</label><br>
							<input type=radio name='type' value='pratique'><label for='type'>Pratique</label>
						</td>
						<td>
							<label for='nom'>Nom du projet : </label>
							<input type='text' name='nom' size=20 value='test'>
						</td>
						<td>
							<label for='nom'>vignette : </label>
							<input type='file' name='vignette'>
						</td>
					</tr>
						<td>
							<label for='motscle'>Mots clés :</label>
							<textarea name='motscle' rows=8>mots,tous,séparés,d'une,virgule</textarea>
						</td>
						<td colspan=2>
							<label for='description'>Description :</label>
							<textarea name='description' rows=20>Description détaillée</textarea>
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
			<span>".$projet['nom']."</span>
			<img id='".$projet['id']."' src='".$projet['vignette']."' width=130 alt='".$projet['nom']."'>";
		if($_SESSION['admin']){
			echo "
				<form action='data.php' method='post'>
					<input type='hidden' name='action' value='supprimerProjet' >
					<input type='hidden' name='id' value='".$projet['id']."' >
					<input type='hidden' name='type' value='".$projet['type']."' >
					<input type='submit' value='supprimer'>
				</form>
			</a>";
		};
	};
?>
		</article>
	</section>
</body
</html>
