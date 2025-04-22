<?php
session_start();

// Initialiser le panier vide s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Traiter la suppression d'un produit
if (isset($_POST['supprimer']) && isset($_POST['produit_id'])) {
    $produit_id = $_POST['produit_id'];
    
    // Parcourir le panier et supprimer le produit correspondant
    foreach ($_SESSION['panier'] as $key => $item) {
        if ($item['id'] == $produit_id) {
            unset($_SESSION['panier'][$key]);//unset supprime du tableau
            
            $_SESSION['panier'] = array_values($_SESSION['panier']); //array_values réindexe le tableau pour éviter les trous dans les indices
            break;
        }
    }
    
    // Rediriger pour éviter la resoumission du formulaire
    header('Location: panier.php?suppression=success');
    exit;
}

// Calculer le total
$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Votre Panier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; margin-top: 20px; }
        .empty { padding: 20px; background-color: #f9f9f9; }
        .success { background-color: #dff0d8; padding: 10px; margin-bottom: 15px; }
        .actions form { display: inline; }
    </style>
</head>
<body>
    <h1>Votre Panier</h1>
    
    <a href="index-exo1-session.php">← Retour aux produits</a>
    
    <?php if (isset($_GET['suppression']) && $_GET['suppression'] == 'success'): ?>
        <div class="success">Produit retiré du panier avec succès !</div>
    <?php endif; ?>
    
    <?php if (empty($_SESSION['panier'])): ?>
        <div class="empty">
            <p>Votre panier est vide.</p>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['panier'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nom']); ?></td>
                        <td><?php echo number_format($item['prix'], 2, ',', ' '); ?> €</td>
                        <td><?php echo $item['quantite']; ?></td>
                        <td><?php echo number_format($item['prix'] * $item['quantite'], 2, ',', ' '); ?> €</td>
                        <td class="actions">
                            <form method="post" action="panier.php">
                                <input type="hidden" name="produit_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" name="supprimer">Retirer du panier</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="total">
            <p>Total: <?php echo number_format($total, 2, ',', ' '); ?> €</p>
        </div>
    <?php endif; ?>
</body>
</html>


