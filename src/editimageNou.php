<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $data = simplexml_load_file('./xml/bauturi.xml');
    foreach($data->bautura as $bautura){
        if($bautura->id == $id){
            unlink($bautura->imagine);
            $bautura->nume = $_POST['nume'];
            $target = $target="./multimedia/".basename($_FILES['image']['name']);
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
        echo "<script>window.location.href = 'administrarebaza.php';</script>";
    }
    else{
        echo "<script>window.location.href = 'editimage.php';</script>";
    }
}
?>

<?php
$id = $_GET['id'];
$data = simplexml_load_file('./xml/bauturi.xml');

foreach($data->bautura as $bautura){
    if($bautura->id == $id){
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
Nume bautura:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="nume" value="<?php echo $doc->nume;?>"><br/>
Imagine:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="file" name="image" value="<?php echo $doc->imagine;?>"><br/>
<img style="width:200px; height:200px;" src="<?php echo $doc->imagine;?>"><br/>
Ingrediente:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="ingrediente" value="<?php echo $doc->ingrediente;?>"><br/>
Tipul bauturii:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="tipbautura" value="<?php echo $doc->tip_bautura;?>"><br/>
Pret:<input class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;" type="text" name="pret" value="<?php echo $doc->pret;?>"><br/>
<input type="hidden" name="id" value="<?php echo $doc->_id; ?>">
<input type="Submit" name="submit" value="Submit" class="btn btn-primary btn-outline">
</form>
<?php
    }
}
?>