<?php
session_start();
require('classe/panierclass.php');

$newpanier = new panier();
$del = $_GET['id'];
unset($_SESSION["panier"][$del]);
$id_panier = $newPanier->getIDpanier();





 
    foreach ($id_panier as $id_panie) {
            $newpanier->deletePanier($id_panie['id']);
        }

header("Location: panier.php");