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
							<li class="active"><a href="index.php">Accueil</a></li>
							<li><a href="salon.php">Salons</a></li>
							<li><a href="#">Map</a></li>
						</ul>
					</div>
				</div>
        <div class="row">
          <form method="Post" action="search.php">
          <div class="form-group">
            <div class="input-group input-group-lg icon-addon addon-lg">
              <input type="text" placeholder="Saisissez des mots-clés" name="recherche" id="schbox" class="form-control input-lg">
              <i class="icon icon-search"></i>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-inverse">Rechercher</button>
              </span>
            </div>
          </div>
        </form>
        </div>
				<div class="row">
					<div class= "col-lg-offset-1 col-lg-10" id="map">
						<script type="text/javascript">
							var map;
							function initMap() {
							  map = new google.maps.Map(document.getElementById('map'), {
								center: {lat: 48.9021449, lng: 2.4699208},
								zoom: 3
							  });
							}

						</script>
						<script async defer
							src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-huh3mxg37vBifkr-gf4fAbVi1Nwut5I&callback=initMap">
						</script>
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
