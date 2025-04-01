<?php
//1. Récupération des informations de connexion 
$host = '127.0.0.1'; //adresse ip de la machine hote
$username = 'root'; //nom d'utilisateur
$password = ''; //mot de passe de connexion
$port = 3307; //par défaut 3306 on le trouve dans le fichier my.ini 
$dbname = 'php'; //nom de la base de données avec laquelle on veut interagir 

//2. Connexion à la base de données. il existe deux mode de cnx ( le mode procédural et le mode orienté objet )
//on va utiliser l'extension mysqli (traite que les BD mysql) ( mode orienté objet )
// Il existe une autre extension ( PDO php data objet  ) (traite différents types de bases de données )

$conn = new mysqli($host, $username, $password,$dbname, $port );
//2.a vérification de la connexion 
if ($conn->connect_error) {
    die("Echec de la connexion : ". $conn->connect_error);
}
echo ("Connexion réussie à la base de données");

// ajouter des enregistrements à la table "produits"

/*$designation = 'souris';
$prix = 15;
$categorie = 'informatique'; //informations à insérer dans le 1er enregistrement 
//préparation de la requete 
//$sql = $conn->prepare("INSERT INTO produits (designation,prix_prod, categorie_prod) VALUES (?,?,?)");// les ? (paramètres placeholders) servent à protéger les données des injections SQL  
//Si on met les valeurs directement dans la requete l'étape de liaison sera retirée
//Lier les paramètres à la requete
//$sql->bind_param("sds",$designation ,$prix ,$categorie );
//executer la requete 
if($sql->execute()){
    echo "<br> enregistrement ajouté avec succès!";
}else{
    echo "Erreur: ". $sql->error;
}*/

//affichage de la table sur le navigateur
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
