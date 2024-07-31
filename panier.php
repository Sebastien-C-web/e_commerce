<?php
require_once('config/db.php');
require_once('classe/panierclass.php');
session_start();



/* if(isset($_POST[''])) {
    $total='';
    $produits_id='';

if(!isset($_SESSION['panier'])) {

    $_SESSION['panier'] = ['Produit'=> [$produits_id], 'Total' => $total] ;
   
    
} else {


    
}
}
*/

if(!isset($_SESSION['panier'])){
    $_SESSION['panier']=array();
}

if(isset($_GET['id'])){
    $produits_id= $_GET['id'];

}

if(isset($_SESSION['panier'][$produits_id])) {
    $_SESSION['panier'][$produits_id]++;
} else {
    $_SESSION['panier'][$produits_id]=1;
    echo "le produit a bien été ajouté au panier";
    var_dump($_SESSION['panier']);
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