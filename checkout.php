    <?php
    require_once('classe/panierclass.php');
    require_once('ressources/produits.php');
    require_once('classe/address.php');
    require_once('classe/commande.php');

    session_start();
    date_default_timezone_set('Europe/Paris');

    $newAdresse = new Adresse();
    $newArticles = new Produits();
    $newPanier = new panier();
    $newCommande = new Commande();
    $articles = $_SESSION['panier'];

    $adresse_1 = htmlspecialchars(trim($_POST['adresse_1']));
    $adresse_suite = htmlspecialchars(trim($_POST['adresse_suite']));
    $codepostal = htmlspecialchars(trim($_POST['codepostal']));
    $ville = htmlspecialchars(trim($_POST['ville']));

    $newAdresse->setAdresse_1($adresse_1);
    $newAdresse->setAdresse_suite($adresse_suite);
    $newAdresse->setCodepostal($codepostal);
    $newAdresse->setVille($ville);
    $newAdresse->addAdresse();

    $ndc = $_SESSION["rowguid"];
    $date = date('d-m-y H:i:s');
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $newCommande->setUser_id($user_id);
    }
    $newCommande->setDate($date);
    $newCommande->setNum_commande($ndc);


    foreach ($articles as $key => $article) {

        $produit = $newPanier->getArticle($key);
        $newCommande->addProduitCommande(['prod_id' => $produit['id'], 'ndc' => $ndc, 'qty' => $article]);
        $total2 += ($produit['prix'] * $article);
        $total2 = number_format($total2, 2, ".", "");
        $newCommande->setTotal($total2); 
        
    }
$newCommande->addCommande();

    
    



    try {
        /*
         * Initialize the Mollie API library with your API key.
         *
         * See: https://www.mollie.com/dashboard/developers/api-keys
         */
        require "./initialize.php";


        foreach ($articles as $key => $article) {


            /* var_dump($article); */
            $produit = $newPanier->getArticle($key);
            /* var_dump($produit); */
            $total += $produit['prix'] * $article;
            $total = number_format($total, 2, ".", "");





            /*
         * Determine the url parts to these example files.
         */
            $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
            $hostname = $_SERVER['HTTP_HOST'];
            $path = dirname($_SERVER['REQUEST_URI'] ?? $_SERVER['PHP_SELF']);

            /*
         * Required Payment Link parameters:
         *   amount        Amount in EUROs. This example creates a € 10,- payment.
         *   description   Description of the payment.
         */
            $paymentLink = $mollie->paymentLinks->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$total", // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "$produit[name]",

            ]);
        }
        unset($_SESSION["rowguid"]);
        $_SESSION["rowguid"] = uniqid();
        $_SESSION['panier'] = [];
        /*
         * Send the customer off to complete the payment.
         * This request should always be a GET, thus we enforce 303 http response code
         */
        header("Location: " . $paymentLink->getCheckoutUrl(), true, 303);
    } catch (\Mollie\Api\Exceptions\ApiException $e) {
        echo "API call failed: " . htmlspecialchars($e->getMessage());
   }  
   

