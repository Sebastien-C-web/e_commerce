
<div class="flex flex-wrap ">
    <section class="relative mx-auto">
        <nav class="flex border-b-2 border-black bg-white text-black w-screen">
            <div class="px-5 xl:px-12 py-6 flex w-full items-center justify-between">
                <a class="text-3xl font-bold font-heading" href="index.php">
                    <img class="h-fit w-32" src="imagelog/logo1.png" >
                </a>
                <button class="md:hidden text-black navbar-burger self-center mr-12 xl:hidden" id="menu-button"   >
           
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            
                   
                </button>
                <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading md:space-x-6 xl:space-x-12 " id="navigation">
                    <li><a class="hover:text-orange-500" href="index.php">Accueil</a></li>
                    <li><a class="hover:text-orange-500" href="Articles.php">Produits</a></li>
                    <?php if (isset($_SESSION['user'])) { ?>                        
                        <li><a href="logout.php" class="hover:text-orange-500">deconnexion</a></li>
                        <li><a href="profil.php" class="hover:text-orange-500">Profil</a></li>
                        <?php if ($_SESSION['user']['statut'] == 'admin') { ?>
                        <li><a class="hover:text-orange-600" href="stock.php">Stock</a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li><a class="hover:text-orange-500" href="connexion.php">Connexion</a></li>
                        <li><a class="hover:text-orange-500" href="sign_in.php">inscription</a></li>
                    <?php } ?>
                    <li><a class="hover:text-orange-500" href="contact.php">Contact</a></li>
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
                $produit = $newPanier->getArticle($key);
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
      </nav>

    </section>
  </div>
            </div>
        </nav>
    </section>
</div>
