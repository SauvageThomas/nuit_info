<?php
session_start ();
include ('functions.php');
$db = db_connect ();

if (user_verified ()) {
	if (isset ( $_POST ['message'] ) and ! empty ( $_POST ['message'] )) {
		/*
		 * On teste si le message ne contient qu'un ou plusieurs points et
		 * qu'un ou plusieurs espaces, ou s'il est vide.
		 * ^ -> d�but de la chaine - $ -> fin de la chaine
		 * [-. ] -> espace, rien ou point
		 * + -> une ou plusieurs fois
		 * Si c'est le cas, alors on envoie pas le message
		 */
		if (! preg_match ( "#^[-. ]+$#", $_POST ['message'] )) {
			$query = $db->prepare ( "SELECT * FROM chat_messages WHERE message_user = :user ORDER BY message_time DESC LIMIT 0,1" );
			$query->execute ( array (
					'user' => $_SESSION ['id'] 
			) );
			$count = $query->rowCount ();
			$data = $query->fetch ();
			// V�rification de la similitude
			if ($count != 0)
				similar_text ( $data ['message_text'], $_POST ['message'], $percent );
			
			if ($percent < 80) {
				// V�rification de la date du dernier message.
				if (time () - 5 >= $data ['message_time']) {
					
					// YES ! ON PEUT CONTINUER ! Ouiiiii.
				} else
					echo 'Votre dernier message est trop r�cent. Baissez le rythme :D';
			} else
				echo 'Votre dernier message est tr�s similaire.';
		} else
			echo 'Votre message est vide.';
	} else
		echo 'Votre message est vide.';
} else
	echo 'Vous devez �tre connect�.';
	
	// A placer � l'int�rieur du if(time()-5 >= $data['message_time'])

$insert = $db->prepare ( '
	INSERT INTO chat_messages (message_id, message_user, message_time, message_text)
	VALUES(:id, :user, :time, :text)
' );
$insert->execute ( array (
		'id' => '',
		'user' => $_SESSION ['id'],
		'time' => time (),
		'text' => $_POST ['message'] 
) );
echo true;
?>