<?php 
require_once 'CookieSiSesiuni.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produse populare</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body> 
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shot-uri</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Selectia noastra de shot-uri</p>
                </div>
            </div>
        </header>  

        <?php
        $tip_bautura = "cocktail";

        $xslDoc = new DOMDocument();
        $xslDoc->load("./xml/afisareBauturi.xsl");

        $xmlDoc = new DOMDocument();
        $xmlDoc->load("./xml/bauturi.xml");

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        $proc->setParameter('', 'username', $username);
        $proc->setParameter('', 'pos', $pos); 
        $proc->setParameter('', 'tip_bautura', $tip_bautura); 

        echo $proc->transformToXml($xmlDoc); 
        ?>     
        ?>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html> 