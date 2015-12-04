<?php
$log = 'u694104836_ts';
$mdp = 'nuitinfo';
try {
	$bdd = new PDO ( 'mysql:host=localhost;dbname=u694104836_base0;charset=UTF8', $log, $mdp );
} catch ( PDOException $e ) {
	echo "Erreur : " . $e->getMessage ();
	die ();
}
?>