<?php session_start(); 
header( 'content-type: text/html; charset=utf-8' );

if(isset($_POST['mdp'])){if($_POST['mdp']=='GretaMarie'){$_SESSION['admin']=TRUE;}else{$_SESSION['admin']=FALSE;}}else{if(!(isset($_SESSION['admin']))){$_SESSION['admin']=FALSE;}};

include('header.php');
 
 ?>
			<table>
				<tr>
					<td width=50%>		
						<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden; visibility: hidden;">
							<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden;">
							<?php
									$photos = $db->query('SELECT * FROM photos ORDER BY ID DESC;')->fetchAll();
									
									foreach ($photos as $photo){
										echo 	"<div data-p='112.50' style='display: none;'>";
										if($_SESSION['admin']){
											echo "<form data-u='image' action='data.php' method='post'>
															<input type='hidden' name='action' value='supprimer_photo' >
															<input type='hidden' name='id' value='".$photo['id']."' >
															<input style='position:absolute; right:0;'type='submit' value='x'>
															<img src='".$photo['adress']."'/>
														</form>";
										}
										else{
											echo "<img data-u='image' src='".$photo['adress']."'/>";
										}
										echo "</div>";
									}
									echo 	"<div data-p='112.50' style='display: none;'>
													<img data-u='image' src='images/arbre.jpg'/>
												</div>";
									
									if($_SESSION['admin']){
										echo "<div data-p='112.50' style='display: none;'>
														<form style='margin:20px;' action='data.php' method='post' enctype='multipart/form-data'>
															<input type='hidden' name='action' value='ajouter_photos' >
															<input type='file' name='album_photo[]' multiple>
															<input type='submit' value='ajouter'>
														</form>
													</div>";
									}
								?>
							</div>
							<!-- Arrow Navigator -->
							<span data-u="arrowleft" class="jssora12l" style="top:123px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
							<span data-u="arrowright" class="jssora12r" style="top:123px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
						</div>
					</td>
				<td>
					
					</td>
				</tr>
			</table>
		</article>
	</section>
</body
</html>
