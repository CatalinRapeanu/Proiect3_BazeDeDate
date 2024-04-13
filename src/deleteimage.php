<?php  
$id = $_GET['id'];

$xml = new DOMDocument();
$xml->load('./xml/bauturi.xml');

$xpath = new DOMXPATH($xml);
foreach($xpath->query("/root/bautura[id='$id']") as $node){
    $node->parentNode->removeChild($node);
}

$xml->save('./xml/bauturi.xml');

header('Location:administrarebaza.php');
?>