<?php
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="container mx-auto">
        <?php foreach ($all_prod as $all_prods){ 
            if ($all_prods['id']= $id){?>
            <div>
                <img src="<?php print $all_prods['image'];?>" alt="produit numero <?php print $id ?>" class="w-40 h-fit">
                <h2><?php print $all_prods['name']; ?></h2>
                <p><?php print $all_prods['description']; ?></p>
                <h2><?php print $all_prods['prix'];?></h2>
                <form action="" method="post">
                    <button type="submit" value="<?php print $all_prods['id']; ?>" class="p-2 border border-black">Ajouter au panier</button>
                </form>
            </div>
            <?php ?>
            <div>

            </div>
            <?php }}?>
    </main>
</body>
</html>