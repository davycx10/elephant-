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


$id = $_REQUEST['id'];
echo $id;

$name = $_REQUEST['name'];
echo $name;


$email = $_REQUEST['email'];
echo $email;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);

if ($result->num_rows > 0) {
    echo "l'utilisateur existe déjà. Veuillez choisr un autre ";   
    
}   else {
    $insertuery = "INSERT INTO utilisateurs (nom, email) VALUES ('$nom', '$email')";
    $stmt -> $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
}
}



if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['email'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prénom'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE utilisateurs SET nom = ?, email = ?, prenom = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nom, $prenom, $email, $id);

    if ($stmt->execute()) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification.";
    }

    $stmt->close();
}



//affichage de la table sur le navigateur
$sql = "SELECT * FROM utilisateur";
$resultat = $conn->query($sql);

if ($resultat->num_rows>0){
   //afficher les enregistrements 
  echo "<table border='1'>
  <tr>
  <th>id</th>
  <th>nom</th>
  <th>mail</th>
  </tr>";
  while ($row = $resultat->fetch_assoc()){
   echo"
   <tr>
  <td>".$row['id_prod'] ."</td>
  <td>".$row['nom'] ."</td>
  <td>".$row['prenom'] ."</td>
  <td>".$row['mail'] ."</td>
  </tr>";
  }
  echo"</table>";
}else {
   echo"aucun enregistrement trouvé";
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h2>Test connexion a une base de donées</h2>

    <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="email">Email :</label>
        <input type="email" id="email" required>
        <br><br>

        <label for="name">Name :</label>
        <input type="text" id="name" required>
        <br><br>

       
        
        <button type="submit">S'inscrire</button>
    </form>


</body>
</html>