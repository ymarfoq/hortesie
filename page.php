<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );

if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};

include('header.php');
 
 ?>
		<article>
		
		</article>
	</section>
<script src="script.js"></script>
</body
</html>
