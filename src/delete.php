<?php  
$id = $_GET['id'];

$xml = new DOMDocument();
$xml->load('./xml/conturi.xml');

$xpath = new DOMXPATH($xml);
foreach($xpath->query("/root/cont[id='$id']") as $node){
    $node->parentNode->removeChild($node);
}

$xml->save('./xml/conturi.xml');

header('Location:administrareconturi.php');
?>