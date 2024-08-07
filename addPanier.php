<?php
session_start();
require('classe/panierclass.php');
$panier = new panier();
// $_SESSION['panier'] = array();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_GET['id'])) {
    $produits_id = $_GET['id'];
}
print"<pre>";
var_dump($_SESSION['panier']);
print"</pre>";
if (isset($_POST['qty'])) {
    $produit_qty = $_POST['qty'];
}else{
    $produit_qty = null;
}

if (isset($_POST['posTaille'])){
    $taille = $_POST['posTaille'];
}else{
    $taille = null;
}


if (isset($_SESSION['panier'][$produits_id]) && $produit_qty == null) {
    $_SESSION['panier'][$produits_id]++;
} elseif ($produit_qty) {
    $_SESSION['panier'][$produits_id] += $produit_qty;
} else {
    $_SESSION['panier'][$produits_id] = 1;
    echo "le produit a bien été ajouté au panier";
}

foreach ($_SESSION["panier"] as $id => $quantity) {
    $panier->setProduitsid($id);
    $panier->setRowguid($_SESSION["rowguid"]);
    $panier->setTotal($quantity);
    $panier->setTaille($taille);
    $panier->addPanier();
}


header("Location: articles.php");
