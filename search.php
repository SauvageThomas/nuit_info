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
