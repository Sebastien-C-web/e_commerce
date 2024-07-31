<?php
require_once('config/db.php');
require_once('ressources/produits.php');
session_start();

$db = new db();
$db->connecte();
$newArticles= new Produits();
$articles = $newArticles->getAllProduits();









?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Articles</title>
</head>
<body>
    <div class="flex flex-row gap-6 bg-[#EDAC70]">
        <?php foreach ($articles as $article) { ?>
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
  <a href="produit.php?id=<?php echo $article['id'] ?>"><img class="w-full" src="<?php echo $article['image']; ?>" alt="photo de l'article"></a>
  <div class="px-6 py-4">
    <div class="font-bold text-xl mb-2"><?php echo $article['name']; ?></div>
  </div>
  <div class="px-6 pt-4 pb-2">
    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><?php echo $article['prix']?>€</span>
    <a href="panier.php?id=<?php echo $article['id'] ?>"><span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Ajouter au Panier</span></a>
  </div>
</div>
     <?php } ?>
    </div>
</body>
</html>