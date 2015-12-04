<?php
session_start ();
include ('phpscripts/functions.php');
$db = db_connect ();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="stylechat.css">
<script src="chat.js"></script>

</head>
<body>
	<div id="container">
		<h1>Mon super chat</h1>
		<?php
		// permettra de créer l'utilisateur lors de la validation du formulaire
		if (isset ( $_POST ['login'] ) and ! preg_match ( "#^[-. ]+$#", $_POST ['login'] )) {
		}
		
		/*
		 * Si l'utilisateur n'est pas connecté,
		 * d'où le ! devant la fonction, alors on affiche le formulaire
		 */
		if (! user_verified ()) {
			?>
<div class="unlog">
			<form action="" method="post">
				Indiquez votre pseudo afin de vous connecter au chat. Aucun mot de
				passe n'est requis. Entrez simplement votre pseudo.<br> <br>

				<center>
					<input type="text" name="login" placeholder="Pseudo" /><br /> <input
						type="password" name="pass" placeholder="Mot de passe" /><br /> <input
						type="submit" value="Connexion" />
				</center>
			</form>
		</div>
<?php
		} else {
			?>
<table class="post_message">
			<tr>


				<!-- Statut //////////////////////////////////////////////////////// -->
				<table class="status">
					<tr>
						<td><span id="statusResponse"></span> <select name="status"
							id="status" style="width: 200px;" onchange="setStatus(this)">
								<option value="0">Absent</option>
								<option value="1">Occup&eacute;</option>
								<option value="2" selected>En ligne</option>
								<option value="2">En ligne</option>
						</select></td>
					</tr>
				</table>
<?php
		}
		?>



				<table class="chat">
					<tr>
						<!-- zone des messages -->
						<td valign="top" id="text-td">
							<div id="annonce"></div>
							<div id="text">
								<div id="loading">
									<center>
										<span class="info" id="info">Chargement du chat en cours...</span><br />
										<img src="ajax-loader.gif" alt="patientez...">
									</center>
								</div>
							</div>
						</td>

						<!-- colonne avec les membres connectés au chat -->
						<td valign="top" id="users-td"><div id="users">Chargement</div></td>
					</tr>
				</table>
				<!-- Zone de texte //////////////////////////////////////////////////////// -->
				<a name="post"></a>
				<table class="post_message">
					<tr>
						<td>
							<form action="" method="" onsubmit="envoyer(); return false;">
								<input type="text" id="message" maxlength="255" /> <input
									type="button" onclick="envoyer()" value="Envoyer" id="post" />
							</form>
							<div id="responsePost" style="display: none"></div>
						</td>
					</tr>
				</table>
	
	</div>


</body>
</html>
