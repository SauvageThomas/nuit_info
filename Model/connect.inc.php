<?php
  $log = 'u694104836_ts';
  $mdp = 'nuitinfo';
  try{
    $conn = new PDO('mysql:localhost;dbname=u694104836_base0;charset=UTF8', $log, $mdp); 
    }
    catch (PDOException $e){
      echo "Erreur : ".$e->getMessage();
      die();
    }
?>