<?php if((!isset($_POST['recherche'])) || $_POST['recherche']==null){
  header('Location :index.php?msg=Vous devez saisir un mot-clé');
}
include('connect.inc.php');
$requete = $bdd->prepare('SELECT * from tweet WHERE motcle LIKE \'%?%\' ORDER BY date LIMIT 0,10');
$requete->execute(array(htmlspecialchars($_POST['recherche'])));
while($donnees = $requete -> fetch()){
  foreach($donnees as $tweet){
    $tabTweets[] = $tweet;
  }
} ?>


<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>
  <body id="body1">
    <div class="container-fluid">



		<!-- LOGO    SOMMAIRE-->
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				 </Br></Br></Br>
				<div class="row">
					<div class= "col-lg-offset-6 col-lg-6">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Accueil</a></li>
							<li><a href="salon.php">Salons</a></li>
							<li><a href="map.php">Map</a></li>
						</ul>
					</div>
				</div>
				
				<div class="row">
					<div class= "col-lg-offset-1 col-lg-10" id="blocnews">
						<?php echo $tabTweets ;
					</div>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-2" id="discutinstant">
				<?php include("indexchat.php"); ?>

			</div>
		 </div>


		</div>
		</body>

</html>
