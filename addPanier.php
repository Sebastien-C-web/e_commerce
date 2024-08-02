<?php
session_start();
require('classe/panierclass.php');
$panier = new panier();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_GET['id'])) {
    $produits_id = $_GET['id'];
}

if (isset($_SESSION['panier'][$produits_id])) {
    $_SESSION['panier'][$produits_id]++;
} else {
    $_SESSION['panier'][$produits_id] = 1;
    echo "le produit a bien été ajouté au panier";
}

foreach ($_SESSION["panier"] as $id => $quantity) {
    $panier->setProduitsid($id);
    $panier->setRowguid($_SESSION["rowguid"]);
    $panier->setTotal($quantity);
    $panier->addPanier();
}


header("Location: articles.php");
