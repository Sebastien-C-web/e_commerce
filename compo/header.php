
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
                <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading xl:space-x-12 " id="navigation">
                    <li><a class="hover:text-orange-500" href="index.php">Accueil</a></li>
                    <li><a class="hover:text-orange-500" href="Articles.php">Nos Produits</a></li>
                    <?php if (isset($_SESSION['user'])) { ?>                        
                        <li><a href="logout.php" class="hover:text-orange-500">deconnexion</a></li>
                        <li><a href="profil.php" class="hover:text-orange-500">profil</a></li>
                        <?php if ($_SESSION['user']['statut'] == 'admin') { ?>
                        <li><a class="hover:text-orange-600" href="stock.php">stock</a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li><a class="hover:text-orange-500" href="connexion.php">Connexion</a></li>
                        <li><a class="hover:text-orange-500" href="sign_in.php">inscription</a></li>
                    <?php } ?>
                    <li><a class="hover:text-orange-500" href="contact.php">Contact Us</a></li>
                </ul>
                <div class="hidden xl:flex items-center space-x-5">
                    <a class="flex items-center hover:text-orange-500" href="panier.php">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h- w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </section>
</div>
