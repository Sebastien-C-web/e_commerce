<?php
session_start();

$del= $_GET['id'];
unset($_SESSION["panier"][$del]);
header("Location: panier.php");
