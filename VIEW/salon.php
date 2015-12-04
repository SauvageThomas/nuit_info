
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">



		<!-- LOGO    SOMMAIRE-->
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				</Br> </Br> </Br>
				<div class="row">
					<div class="col-lg-offset-6 col-lg-6">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index.php">Accueil</a></li>
							<li><a href="#">Salons</a></li>
							<li><a href="map.php">Map</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="input-group input-group-lg icon-addon addon-lg">
							<input type="text" placeholder="Saisissez des mots-clés" name=""
								id="schbox" class="form-control input-lg"> <i
								class="icon icon-search"></i> <span class="input-group-btn">
								<button type="submit" class="btn btn-inverse">Rechercher</button>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-offset-1 col-lg-10" id="blocnews">
						<?php
						include '../Model/connect.inc.php';
						$query = $bdd->query ( "SELECT * FROM salon" );
						echo 'mdr';
						while ( $line = $query->fetch () ) {
							echo $line ['nom'] . '<br>';
						}
						
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-2" id="discutinstant">Chat
				instant'</div>
		</div>


	</div>
</body>

</html>



