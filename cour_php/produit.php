<?php
// session_set_cookie_params(3600); //la fonction session_set_cookie_params permet de définir le temps de la session
session_start(); //démarrer la session

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Liste des produits disponibles
$produits = [
    ['id' => 1, 'nom' => 'Smartphone ', 'prix' => 1599.99],
    ['id' => 2, 'nom' => 'Casque Audio', 'prix' => 139.50],
    ['id' => 3, 'nom' => 'Clavier ', 'prix' => 79.90],
    ['id' => 4, 'nom' => 'Souris Sans Fil', 'prix' => 35.00],
    ['id' => 5, 'nom' => 'Écran 24 pouces', 'prix' => 199.99],
    ['id' => 6, 'nom' => 'Imprimante', 'prix' => 79.99]
];

// ajout au panier
if (isset($_POST['ajouter_au_panier']) && isset($_POST['produit_id'])) {
    $produit_id = $_POST['produit_id'];
    
    // Trouver le produit correspondant
    $produit_trouve = null; //initialiser la variable $produit_trouve
    foreach ($produits as $produit) {
        if ($produit['id'] == $produit_id) {
            $produit_trouve = $produit;
            break;
        }
    }
    
    // Ajouter au panier 
    //si le produit existe dans le panier
    if ($produit_trouve) {
        
        $existe = false;
        foreach ($_SESSION['panier'] as &$item) {
            if ($item['id'] == $produit_id) {
                $item['quantite']++;
                $existe = true;
                break;
            }
        }
        
        // Si le produit n'est pas encore dans le panier, l'ajouter
        if (!$existe) {
            $_SESSION['panier'][] = [
                'id' => $produit_trouve['id'],
                'nom' => $produit_trouve['nom'],
                'prix' => $produit_trouve['prix'],
                'quantite' => 1
            ];
        }
        
        // Rediriger pour éviter de soumettre à nouveau en rafraîchissant
        header('Location: index-exo1-session.php?ajout=success');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Boutique</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .produit { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; }
        .success { background-color: #dff0d8; padding: 10px; margin-bottom: 15px; }
        .panier-link { float: right; }
    </style>
</head>
<body>
    <h1> Produits disponibles</h1>
    
    <div class="panier-link">
        <a href="panier.php">Voir le panier (<?php echo count($_SESSION['panier']); ?>)</a>
    </div>
    
    <?php if (isset($_GET['ajout']) && $_GET['ajout'] == 'success'): ?>
        <div class="success">Produit ajouté au panier avec succès !</div>
    <?php endif; ?>
    
    <?php foreach ($produits as $produit): ?>
        <div class="produit">
            <h3><?php echo htmlspecialchars($produit['nom']); ?></h3>
            <p>Prix: <?php echo number_format($produit['prix'], 2, ',', ' '); //number_format($nombre, $decimales, $separateur_decimal, $separateur_milliers)15555.99 15 555,99  number_format(15555.99, 2, ',', ' ' )
            ?> €</p>
            
            <form method="post" action="index-exo1-session.php">
                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                <button type="submit" name="ajouter_au_panier">Ajouter au panier</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>


