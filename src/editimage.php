<?php 
require_once 'CookieSiSesiuni.php'; 

if(!isset($_POST['submit'])){  
    $data = simplexml_load_file("./xml/bauturi.xml");

    $id = $_GET['id'];

    $doc = null; 

    foreach($data->bautura as $bautura)
    {
        if($bautura->id == $id)
        {
            $doc = $bautura;
            break;
        }
    }
}
else{     
    $title=$_POST['nume'];
    $ingr=$_POST['ingrediente'];
    $pret=$_POST['pret'];
    $tipb=$_POST['tipbautura']; 

    $data = simplexml_load_file("./xml/bauturi.xml");
    
    if(isset($_FILES['image']['name'])){
        $target="./multimedia/".basename($_FILES['image']['name']);
    }else{
        $id = $_GET['id'];

        $doc = null; 

        foreach($data->bautura as $bautura)
        {
            if($bautura->id == $id)
            {
                $doc = $bautura;
                break;
            }
        }
        $target=$doc->imagine;
    } 

    $data = simplexml_load_file("./xml/bauturi.xml");

    $id = $_POST['id'];  

    foreach($data->bautura as $bautura)
    {
        if($bautura->id == $id)
        {
            $bautura->nume = $_POST['nume'];
            $bautura->imagine = $target;
            $bautura->ingrediente = $_POST['ingrediente'];
            $bautura->tip_bautura = $_POST['tipbautura'];
            $bautura->pret = $_POST['pret'];
        }
    }

    $handle = fopen("./xml/bauturi.xml", "wb");
    fwrite($handle, $data->asXML());
    fclose($handle);

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        //header('location:administrarebaza.php');
        echo "<script>window.location.href = 'administrarebaza.php';</script>";
    }
    else{ 
        echo "<script>window.location.href = 'editimage.php';</script>";
    } 

    // header('Location:administrarebaza.php'); 
}
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
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" style="color: white;" href="index.php">Shooters</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" style="color: #808080;" aria-current="page" href="index.php">Acasa</a></li>
                        <li class="nav-item"><a class="nav-link" style="color: white;" href="about.php">Despre noi</a></li>
                        <li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">Bauturi</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="produse.php">Toate bauturile</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="populare.php">Shot-uri</a></li>
                                <li><a class="dropdown-item" href="noi.php">Cocktail-uri</a></li>
                            </ul>
                        </li>
                        <?php 
                        if(isset($_SESSION['username'])){
                        echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">'.$_SESSION["username"].'</a>';
                            echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                
                                if(isset($_SESSION['username'])){
                                    if($pos == 'admin' ){
                                       echo '<li><a class="dropdown-item" href="administrareconturi.php">Administrare conturi</a></li>';
                                       echo '<li><a class="dropdown-item" href="administrarebaza.php" style="color: black;">Administrare baza de date</a></li>';
                                       echo '<li><hr class="dropdown-divider" /></li>';
                                         }
                                }
                                
                                //echo '<li><hr class="dropdown-divider" /></li>';
                                echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                            echo '</ul>';
                        echo '</li>';
                        }
                        else{
                            echo '<a class="nav-link" href="rememberme.php" style="color: white;">Login</a>';
                        }
                        ?>
                    </ul>
                </div>
                </div>
        </nav>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Editare inregistrari</h1>           
                    <?php
                    $id = $_GET['id'];
                    $data = simplexml_load_file('./xml/bauturi.xml');
                    foreach($data->bautura as $doc){
                        if($doc->id == $id){
                    ?>                  
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                        Nume bautura:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="nume" value="<?php echo $doc->nume;?>"><br/>
                        Imagine:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="file" name="image" value="<?php echo $doc->imagine;?>"><br/>
                        <img style="width:200px; height:200px;" src="<?php echo $doc->imagine;?>"><br/>
                        Ingrediente:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="ingrediente" value="<?php echo $doc->ingrediente;?>"><br/>
                        Tipul bauturii:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="tipbautura" value="<?php echo $doc->tip_bautura;?>"><br/>
                        Pret:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="pret" value="<?php echo $doc->pret;?>"><br/>
                        <input type="hidden" name="id" value="<?php echo $doc->id; ?>">
                        <input type="Submit" name="submit" value="Submit" class="btn btn-primary btn-outline">
                        </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </header>
        
        <div class="bg-dark"><br/><br/><br/></div>
        
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
    </body>
</html>