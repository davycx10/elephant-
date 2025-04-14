<?php

//1. Récupération des informations de connexion 
$host = '127.0.0.1'; //adresse ip de la machine hote
$username = 'root'; //nom d'utilisateur
$password = ''; //mot de passe de connexion
$port = 3307; //par défaut 3306 on le trouve dans le fichier my.ini 
$dbname = 'test_db'; //nom de la base de données avec laquelle on veut interagir 



$conn = new mysqli($host, $username, $password,$dbname, $port );
//2.a vérification de la connexion 
if ($conn->connect_error) {
    die("Echec de la connexion : ". $conn->connect_error);
}
echo ("Connexion réussie à la base de données");

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];
// Vérifiez les informations d'identification (utilisation de
// valeurs en dur pour les tests


if ($username === 'username' && $password === 'password') {
$_SESSION['username'] = $username;
header('Location: dashboard.php');
exit();
} else {
$error_message = 'Identifiants incorrects';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
<title>Login</title>

</head>
<body>

<h2>Login</h2>

<?php if (isset($error_message)) : ?>
<p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="post" action="">
<label for="username">Username:</label>
<input type="text" name="username" required><br>
<label for="password">Password:</label>
<input type="password" name="password" required><br>
<button type="submit">Login</button>
</form>

</body>
</html>

<?php

// affichage de la table sur le navigateur 
 $sql = "SELECT * FROM produits";
 $resultat = $conn->query($sql);
 if ($resultat->num_rows>0){
    //afficher les enregistrements 
   echo "<table border='1'>
   <tr>
   <th>id</th>
   <th>designation</th>
   <th>Prix</th>
   <th>Categorie</th>
   </tr>";
   while ($row = $resultat->fetch_assoc()){
    echo"
    <tr>
   <td>".$row['id_prod'] ."</td>
   <td>".$row['designation'] ."</td>
   <td>".$row['prix_prod'] ."</td>
   <td>".$row['categorie_prod'] ."</td>
   </tr>";
   }
   echo"</table>";
 }else {
    echo"aucun enregistrement trouvé";
 }

?>