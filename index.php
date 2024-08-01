<?php

require_once('config/db.php');
session_start();

$bdd = new db();
$bdd->connecte();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>home</title>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="url-to-cdn/splide.min.css">
</head>

<body>
    <header>
        <?php include('compo/header.php'); ?>
    </header>
    <main>
        <section class="bg-[#EDAC70]">
            <article class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">Slide 01</li>
                        <li class="splide__slide">Slide 02</li>
                        <li class="splide__slide">Slide 03</li>
                    </ul>
                </div>
            </article>
        </section>
        <section>

        </section>
    </main>
    <script>
        new Splide('.splide').mount();
    </script>
    <footer>

    </footer>

</body>

</html>