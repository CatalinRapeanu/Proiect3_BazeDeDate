<?php 
$xml = simplexml_load_file('./xml/conturi.xml');

if(isset($_COOKIE['username']) && !isset($_SESSION['username']))
{
    $_SESSION['username'] = $_COOKIE['username'];
}

if(isset($_SESSION['username']))
{
    // $GLOBALS['username'] = $_SESSION['username'];
    $username = $_SESSION['username'];

    foreach($xml->cont as $cont)
    {
        if($cont->username == $username)
        {
            // $GLOBALS['pos'] = (string)$cont->user_type;
            $pos = (string)$cont->user_type;
            break;
        }
    }
}

if(!isset($_COOKIE['username']) && !isset($_SESSION['username']))
{
    $username = '';
    $pos = '';
}
?>