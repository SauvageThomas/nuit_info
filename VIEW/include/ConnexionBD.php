<?php
		try{
			$bdd=new PDO('mysql:host=localhost;dbname=web9014_db;charset=UTF8','web9014_db','ptuts3');
		}catch (PDOException $e) {
			echo"Erreur : ".$e.getMessage()."<br />";
			die();
		}
?>
