<?php
  $log = 'root';
  $mdp = '';
  try{
    $conn = new PDO('mysql:localhost;dbname=nuitinfo;charset=UTF8', $log, $mdp); 
    }
    catch (PDOException $e){
      echo "Erreur : ".$e->getMessage();
      die();
    }
?>