<?php
require_once('config/db.php');
require_once('ressources/produits.php');
require_once('classe/panierclass.php');
session_start();

$db = new db();
$db->connecte();
$newArticles = new Produits();
$articles = $newArticles->getAllProduits();
$newPanier = new panier();

/* var_dump($_SESSION['panier']);  */

$total = 0;


?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="CSS/style_panier.css">
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
  <title>Articles</title>
</head>

<body>
<header>
        <?php include_once('compo/header.php'); ?>
    </header>


<div class="p-1 flex flex-wrap justify-center">
<?php foreach ($articles as $article) { ?>
<div class="flex-shrink-0 m-6 relative overflow-hidden bg-[#EDAC70] rounded-lg w-96 shadow-lg group">
    <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform"
        viewBox="0 0 375 283" fill="none" style="opacity: 0.1;">
        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
    </svg>
    <div class="relative pt-10 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
        </div>
        <a href="produit.php?id=<?php echo $article['id'] ?>"><img class="relative w-40 h-40 object-cover" src="ressources/uploads/<?php echo $article['image']; ?>" alt="photo de l'article">
    </div>
    <div class="relative text-white px-6 pb-6 mt-6">
        <div class="flex justify-between">
            <span class="block font-semibold text-xl truncate"><?php echo $article['name']; ?></span>
            </div>
            <div class="flex justify-center mt-2 ">
            <span class=" px-2 block bg-white rounded-full text-orange-500 text-xs font-bold w-fit py-2 leading-none flex items-center"><?php echo $article['prix'] ?> €</span>
            </div>
</a>
    </div>
</div>
<?php } ?>
</div>


  <footer>
    <?php include('compo/footer.php'); ?>

  </footer>
  <script src="JS/son.js"></script> 
</body>


</html>