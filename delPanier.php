<?php
session_start();

$del= $_GET['id'];
unset($_SESSION["panier"][$del]);
header("Location: panier.php");







if (isset($_POST['supprimer'])) {
    $id = $id_panie['id'];
    $newPanier->deletePanier($id);
    
}

