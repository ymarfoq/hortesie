<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );
if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};
$fond="arbre"; 
include('header.php')
?>
			<table>
				<tr> <td colspan=2> <h3> Contact 1 : </h3> </td> </tr>
				<tr> <td width=100> Tel 1 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Tel 2 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Mail </td> <td>contact@hortesie.com</td> </tr>
				<tr> <td> Adresse </td> <td>XX rue de Xxxxxxx, <br>XXXXX Ville</td> </tr>
				<tr> <td colspan=2> <br> </td> </tr>
				<tr> <td colspan=2> <h3> Contact 2 : </h3> </td> </tr>
				<tr> <td> Tel 1 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Tel 2 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Mail </td> <td>contact@hortesie.com</td> </tr>
				<tr> <td> Adresse </td> <td>XX rue de Xxxxxxx, <br>XXXXX Ville</td> </tr>
				<tr> <td colspan=2> <br> </td> </tr>
				<tr> <td colspan=2> <h3> Contact 3 : </h3> </td> </tr>
				<tr> <td> Tel 1 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Tel 2 </td> <td>01-30-00-00-00-00</td> </tr>
				<tr> <td> Mail </td> <td>contact@hortesie.com</td> </tr>
				<tr> <td> Adresse </td> <td>XX rue de Xxxxxxx, <br>XXXXX Ville</td> </tr>
				<tr> <td colspan=2>  </td> </tr>
			</table>
		</article>
	</section>
<script src="script.js"></script>
</body>
</html>
