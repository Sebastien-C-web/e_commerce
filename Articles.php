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
  <div class="flex flex-wrap ">
    <section class="relative mx-auto">

      <nav class="flex justify-between border-b-2  border-black bg-white-300 text-black w-screen">
        <div class="px-5 xl:px-12 py-6 flex w-full items-center">
          <a class="text-3xl font-bold font-heading" href="panier.php">
            <img class="h-16" src="imagelog/logo1.png" alt="">

          </a>

          <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
            <li><a class="hover:text-orange-500" href="index.php">Accueil</a></li>
            <li><a class="hover:text-orange-500" href="Articles.php">Nos Produits</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
              <li><a href="logout.php" class="hover:text-orange-500">deconnexion</a></li>
              <?php if ($_SESSION['user']['statut'] == 'admin') { ?>
                <li><a class="hover:text-orange-600" href="stock.php">stock</a></li>
              <?php } ?>
            <?php } else { ?>

              <li><a class="hover:text-orange-500" href="connexion.php">Connexion</a></li>
              <li><a class="hover:text-orange-500" href="sign_in.php">inscription</a></li>
            <?php } ?>

            <li><a class="hover:text-orange-500" href="#">Contact Us</a></li>
          </ul>




          <div class="text-center">
            <button class="text-white bg-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
              <img src="icons8-panier-24.png" alt="">
            </button>
          </div>


        </div>
        <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
          <h5 id="drawer-label" class="text-xl inline-flex items-center mb-4 text-base font-semibold text-black dark:text-gray-400">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />Panier
          </h5>
          <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
          </button>

          <div class="cart-item">
            <?php if (!empty($_SESSION['panier'])) { ?>
              <?php foreach ($_SESSION['panier'] as $key => $article) {
                $produit = $newpanier->getArticle($key);
                $total += ($produit['prix'] * $article);

              ?>

                <a href="produit.php?id=<?php echo $produit['id'] ?>"><img class="w-[20%] h-[20%]" src="ressources/uploads/<?php echo $produit['image']; ?>" alt="photo de l'article"></a>
                <div class="details">
                  <h3 class="font-semibold"><?php echo $produit['name']; ?></h3>
                  <p>
                    <span class="quantity">Quantité : <?= $article ?></span>
                    <span class="price"><?php echo $produit['prix'] ?>€</span>
                  </p>
                </div>
                <div class="cancel"><i class="fas fa-window-close"></i></div>
              <?php } ?>
          </div>

          <p>Total : <?php print $total ?></p>
        <?php } else { ?>
          <p class="mb-6 text-sm text-gray-500 dark:text-gray-400"><?php print "Votre panier est tristement vide !" ?><br></p>
        <?php } ?>
        <div class="grid grid-cols-2 gap-4">
          <?php if (!empty($_SESSION['panier'])) { ?>
            <a href="panier.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-[#EDAC70] rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Procéder au paiement<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
              </svg></a>
          <?php } else { ?>
            <a href="Articles.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-[#EDAC70] rounded-lg hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Retour aux achats<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
              </svg></a>
        </div>
        <img src="sadfaceicon.png" alt="icone triste">
      <?php } ?>
        </div>

        <a class="xl:hidden flex mr-6 items-center" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>

        </a>
        <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </a>
      </nav>

    </section>
  </div>

<div class="p-1 flex flex-wrap justify-center">
<?php foreach ($articles as $article) { ?>
<div class="flex-shrink-0 m-6 relative overflow-hidden bg-[#f3af77] rounded-lg w-96 shadow-lg group">
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

  <script src="script_panier.js"></script>
</body>


</html>