
<?php
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    session_start();
    if(!isset($_SESSION['current_user']))
    {
        header("location:../../MVC/View/index.php");
        exit();
    }
   function check_Privilege ($uri = false){
       $uri = $uri !=false ?$uri : $_SERVER['REQUEST_URI'];
    $privileges = $_SESSION['current_user']['privileges']; 
    // $privilege = array (
    //     "\.\.\/admi\/DAO\.php\?action\=view\_statistical",
    //     "\.\.\/admi\/DAO\.php\?action\=view\_type",
    //     "\.\.\/admi\/DAO\.php\?action\=add\_type",
    //     "\.\.\/admi\/DAO\.php\?action\=edit\_type&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=delete\_type&id\=d*\w*",

    //     "\.\.\/admi\/DAO\.php\?action\=edit\_author&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=delete\_author&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=view\_author",
    //     "\.\.\/admi\/DAO\.php\?action\=add\_author",

    //     "\.\.\/admi\/DAO\.php\?action\=view\_user",
    //     "\.\.\/admi\/DAO\.php\?action\=edit\_user&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=delete\_user&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=add\_user",
    //     "\.\.\/admi\/DAO\.php\?action\=priv\_user\&id\=d*\w*",
    //     

    //     "\.\.\/admi\/DAO\.php\?action\=view\_sach",
    //     "\.\.\/admi\/DAO\.php\?action\=add\_sach",
    //     "\.\.\/admi\/DAO\.php\?action\=edit\_sach&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=delete\_sach&id\=d*\w*",

    //     "\.\.\/admi\/DAO\.php\?action\=view\_cart",
    //     "\.\.\/admi\/DAO\.php\?action\=edit\_status&id\=d*\w*",
    //     "\.\.\/admi\/DAO\.php\?action\=show\_detail\_cart&id\=d*\w*",
    // );
    $privileges = implode("|",$privileges);
    preg_match('/admi\/index\.php$|'.$privileges.'/',$uri,$matches);
    return !empty($matches);
   }
//    $regexcheck =  check_Privilege();
//    var_dump($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//    exit();
//  var_dump($regexcheck);
//  exit();
?>
<!-- \.\.\/admi\/DAO\.php\?action\=view\_cart&id\=\d*\w* -->