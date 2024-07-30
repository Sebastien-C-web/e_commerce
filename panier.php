<?php
session_start();


if(isset($_POST[''])) {
    $total='';
    $produits_id='';

if(!isset($_SESSION['panier'])) {

    $_SESSION['panier'] = ['Produit'=> [$produits_id], 'Total' => $total] ;
   
    
} else {


    
}
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    
    <section>

        <table>

        <th>Produit</th>
        <th>Prix</th>
        <th>Quantite</th>
        <th>Action</th>

        </table>

    </section>

</body>
</html>