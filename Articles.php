<?php
require_once('config/db.php');
require_once('ressources/produits.php');
require_once('classe/panierclass.php');
session_start();

$db = new db();
$db->connecte();
$newArticles = new Produits();
$articles = $newArticles->getAllProduits();
$newpanier = new panier();








if (isset($_POST['panier'])) {

  foreach ($articles as $article) {

    if ($article['id'] == $_POST['panier']) {
      $produits_id = $_POST['panier'];
      $total = $article['prix'];

      $newpanier->setProduitsid($produits_id);
      $newpanier->setTotal($total);
      $newpanier->addPanier();
      header("Location: Articles.php");
    }
  }
}


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
  <nav>
    <?php include('compo/header.php'); ?>
  </nav>

  <a class="border border-2 border-black bg-[#EDAC70]" href="panier.php">Panier<span><?= ($_SESSION['panier']) ?></span></a>

  <div class="flex flex-row gap-6 bg-[#EDAC70] pt-[3%] pb-[3%]">
    <?php foreach ($articles as $article) { ?>
      <div class="w-[15%] rounded overflow-hidden shadow-lg">
        <a href="produit.php?id=<?php echo $article['id'] ?>"><img class="w-full" src="ressources/uploads/<?php echo $article['image']; ?>" alt="photo de l'article"></a>
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2"><?php echo $article['name']; ?></div>
        </div>
        <div class="px-6 pt-4 pb-2">
          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><?php echo $article['prix'] ?>€</span>
          <a href="addPanier.php?id=<?php echo $article['id'] ?>">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Ajouter au Panier</span>
          </a>
        </div>
      </div>
    <?php } ?>
  </div>
<footer>
<?php include('compo/footer.php'); ?>

</footer>

</body>
f
</html>