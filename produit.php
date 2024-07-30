<h2?php
require_once('./config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
session_start();

$sql = new db();
$sql->connecte();

$newProd= new Produits();
$all_prod = $newProd->getAllProduits();
$id=$_GET['id'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php foreach ($all_prod as $all_prods){
        if ($all_prods['id'] = $id){
             print $all_prod['name'];  
        }
    }
    ?>
    </title>
</head>
<body>
    <main class="container mx-auto">
        <?php foreach ($all_prod as $all_prods){ 
            if ($all_prods['id']= $id){?>
            <div>
                <img src="<?php print $all_prods['image'];?>" alt="produit numero <?php print $id ?>">
                <h2><?php print $all_prods['name']; ?></h2>
                <p><?php print $all_prods['description']; ?></p>
                <form action="">

                </form>
            </div>
            <?php ?>
            <div>
                
            </div>
            <?php }}?>
    </main>
</body>
</html>