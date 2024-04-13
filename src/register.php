<?php     
$status = 0;

if(isset($_POST['Register'])){
    $nume = $_POST['nume'];
    $pass = $_POST['pass'];
    $usertype = 'user'; 
    
    $xml = simplexml_load_file('./xml/conturi.xml'); 

    foreach($xml->cont as $cont)
    {
        if((string)$cont->username == $nume)
        {
            $status = 1;
            break;
        }
    }
    
    if($status==0)
    {
        $numarConturi = count($xml->cont); 

        if($numarConturi > 0)
        {
            $ultimulCont = $xml->cont[$numarConturi - 1]; 

            $id = (int)$ultimulCont->id + 1; 
        }
        else
        {
            $id = 1;
        }

        if($nume != null && $pass != null)
        {
            $newCont = $xml->addChild('cont');
            $newCont->addChild('id', $id);
            $newCont->addChild('username', $nume);
            $newCont->addChild('password', $pass);
            $newCont->addChild('user_type', $usertype);
            $newCont->addChild('edit', 'edit.php?id='.$id);
            $newCont->addChild('delete', 'delete.php?id='.$id);
            $newCont->addChild('confirm','return  confirm("Are you sure you want to delete this?")');

            file_put_contents('./xml/conturi.xml', $xml->asXML()); 
            
            header('location:rememberme.php');
        }
        else
        { 
            header('location:registerform.php');
        }
    }
}
?>