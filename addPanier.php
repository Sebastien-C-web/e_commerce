<?php
session_start();

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

header("Location: articles.php");