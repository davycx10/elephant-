<?php


// T Connexion à la base de données

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db lolo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// ? Cas où la connexion échoue

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// todo ajouter les valuers de dans la bd
// * Insertion des valeurs du formulaire dans la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
 


    // ? Préparation de la requête d'insertion
    // * Version de base$sql = "INSERT INTO utilisateurs (pseudo, nom, prenom, email, message) 
    //         VALUES ('$pseudo', '$nom', '$prenom', '$email', '$message')";
    
    //Etpe 1 securiser avec les ? (paramètres placeholders) pour eviter les injections sql
    
    $sql = "INSERT INTO utilisateurs ( nom, email) VALUES (?, ?)";
    
    // Etape 2 : Préparer la requête
    
    $statement->bind_param("ss",$nom,$email);

    // Etape 3 : Exécuter la requête
    $statement = $conn->prepare($sql);


    // * Envoie de reussite ou echec de la requette
    if ($statement->query($sql) === TRUE) {
        echo "Nouvel utilisateur ajouté avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$sql = "SELECT nom, email message FROM utilisateurs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Liste des utilisateurs</h2>";
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nom"] . "</td>
                <td>" . $row["email"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Aucun utilisateur trouvé.";
}

$conn->close()