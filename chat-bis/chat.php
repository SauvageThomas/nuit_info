
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
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script src="chat.js"></script>

</head>
<body>
	<div id="container">
		<h1>Mon super chat</h1>
		
		<?php
		// permettra de cr�er l'utilisateur lors de la validation du formulaire
		if (isset ( $_POST ['login'] ) and ! preg_match ( "#^[-. ]+$#", $_POST ['login'] )) {
			
			/*
			 * On cr�e la variable login qui prend la valeur POST envoy�e
			 * car on va l'utiliser plusieurs fois
			 */
			$login = $_POST ['login'];
			$pass = $_POST ['pass'];
			
			// On cr�e une requ�te pour rechercher un compte ayant pour nom $login
			$query = $db->prepare ( "SELECT * FROM chat_accounts WHERE account_login = :login" );
			$query->execute ( array (
					'login' => $login 
			) );
			// On compte le nombre d'entr�es
			$count = $query->rowCount ();
			
			// Si ce nombre est nul, alors on cr�e le compte, sinon on le connecte simplement
			if ($count == 0) {
				// Cr�ation du compte
				$insert = $db->prepare ( '
		INSERT INTO chat_accounts (account_id, account_login, account_pass)
		VALUES(:id, :login, :pass)
	' );
				$insert->execute ( array (
						'id' => '',
						'login' => htmlspecialchars ( $login ),
						'pass' => md5 ( $pass ) 
				) );
				
				/*
				 * Cr�ation d'une session id ayant pour valeur le dernier ID cr��
				 * par la derni�re requ�te SQL effectu�e
				 */
				$_SESSION ['id'] = $db->lastInsertId ();
				// On cr�e une session time qui prend la valeur de la date de connexion
				$_SESSION ['time'] = time ();
				$_SESSION ['login'] = $login;
			} else {
				$data = $query->fetch ();
				
				if ($data ['account_pass'] == md5 ( $pass )) {
					$_SESSION ['id'] = $data ['account_id'];
					// On cr�e une session time qui prend la valeur de la date de connexion
					$_SESSION ['time'] = time ();
					$_SESSION ['login'] = $data ['account_login'];
				}
			}
			
			// On termine la requ�te
			$query->closeCursor ();
		}
		
		/*
		 * Si l'utilisateur n'est pas connect�,
		 * d'o� le ! devant la fonction, alors on affiche le formulaire
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
	<input type="hidden" id="dateConnexion"
			value="<?php echo $_SESSION['time']; ?>" />

		<!-- Statut //////////////////////////////////////////////////////// -->
		<table class="status">
			<tr>
				<td><span id="statusResponse"></span> <select name="status"
					id="status" style="width: 200px;" onchange="setStatus(this)">
						<option value="0">Absent</option>
						<option value="1">Occup&eacute;</option>
						<option value="2" selected>En ligne</option>
				</select></td>
			</tr>
		</table>



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

				<!-- colonne avec les membres connect�s au chat -->
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
	<?php
		}
		?>
	</div>


</body>
</html>
