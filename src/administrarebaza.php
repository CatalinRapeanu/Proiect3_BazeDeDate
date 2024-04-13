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
        <title>Acasa</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <script src="js/.js"></script>
        <script src="js/faraclick.js"></script> 
    </head>
    <body> 
        <?php      
        $xslDoc = new DOMDocument();
        $xslDoc->load("./xml/bauturi.xsl");

        $xmlDoc = new DOMDocument();
        $xmlDoc->load("./xml/bauturi.xml");

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);

        $proc->setParameter('', 'username', $username);
        $proc->setParameter('', 'pos', $pos); 

        echo $proc->transformToXml($xmlDoc);

        ?> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>  
    </body>
</html>
