<?php  
session_start();

if(isset($_POST['Login']))
{
    if(empty($_POST['username']) || empty($_POST['password']))
    {
        header("location:rememberme.php?Empty= Please Fill in the Blanks");
    }
    else
    {
        $username = $_POST['username'];
        $password = $_POST['password']; 
        
        $data = simplexml_load_file("./xml/conturi.xml");

        $conectat = false;

        foreach($data->cont as $cont)
        {
            if($cont->username == $username && $cont->password == $password)
            {
                $conectat = true;
            }
        }
    }

    if($conectat)
    {
        $_SESSION['username'] = $username;
        header('location:index.php');
    }
    else
    {
        header("location:rememberme.php?Invalid=Please Enter Correct User Name and Password");
    }

    if(isset($_POST['rememberme'])){
        setcookie('username', $_POST['username'], time()+60*60*24*365);
        setcookie('password', md5($_POST['password']), time()+60*60*24*365);
    }else{
        setcookie('username', $_POST['username'], false);
        setcookie('password', md5($_POST['password']), false);
    }
}
else
{
    echo 'Not Working Now Guys';
}

?>