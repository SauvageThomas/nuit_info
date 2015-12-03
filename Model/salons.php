<html>
<head>
<title>Liste des salons</title>
</head>
<body>
<h1>Liste des salons :</h1>
<?php
require("connect.inc.php");
$req = $conn->prepare('SELECT * FROM salons');
$req->execute();
while($donnees = $req->fetch()){
	$result[] = $donnees;
	echo 'boucle';
}
$req->closeCursor();
echo '<table>';
echo "<tr><th>Identifiant</th><th>Nom du salon</th></tr>";
foreach($result as $saloon) {
	echo "<tr>";
	echo "<td>".$saloon['id']."</td>";
	echo "<td>".$saloon['nom']."</td>";
	echo "</tr>";
}
echo '</table>';
?>
</body>
</html>