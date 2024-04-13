<?php   
if(isset($_POST['upload'])){

    $xml = simplexml_load_file("./xml/bauturi.xml");

    if(!empty($_POST['nume']) && !empty($_POST['ingrediente']) && !empty($_POST['tipbautura']) && !empty($_POST['pret']) && !empty($_FILES['image']['name'])) {
        $text=$_POST['nume'];
        $target="./multimedia/".basename($_FILES['image']['name']);
        $ingrediente=$_POST['ingrediente'];
        $tipb=$_POST['tipbautura'];
        $pret=$_POST['pret']; 

        $numarBauturi = count($xml->bautura); 

        if($numarBauturi > 0)
        {
            $ultimaBautura = $xml->bautura[$numarBauturi - 1]; 

            $id = (int)$ultimaBautura->id + 1; 
        }
        else
        {
            $id = 1;
        }

        $bauturaNoua = $xml->addChild('bautura');
        $bauturaNoua->addChild('id', $id);
        $bauturaNoua->addChild('nume', $text);
        $bauturaNoua->addChild('imagine', $target);
        $bauturaNoua->addChild('ingrediente', $ingrediente);
        $bauturaNoua->addChild('tip_bautura', $tipb);
        $bauturaNoua->addChild('pret', $pret);
        $bauturaNoua->addChild('edit', 'editimage.php?id='.$id);
        $bauturaNoua->addChild('view', 'view.php?id='.$id);
        $bauturaNoua->addChild('delete', 'deleteimage.php?id='.$id);
        $bauturaNoua->addChild('confirm','return  confirm("Are you sure you want to delete this?")');
        $bauturaNoua->addChild('upload', 'upload.php');
        $bauturaNoua->addChild('back', 'administrarebaza.php');

        file_put_contents('./xml/bauturi.xml', $xml->asXML());
 
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){ 
            echo "<script>alert('Băutura a fost încărcată cu succes!'); 
                    window.location.href = 'administrarebaza.php';</script>";
        }
        else{ 
            echo "<script>alert('Eroare la incarcarea imaginii.');
                    window.location.href = 'upload.php';</script>";
        } 
    }else { 
        echo "<script>alert('Toate câmpurile sunt obligatorii!');
              window.location.href = 'upload.php';</script>";
    }
}   