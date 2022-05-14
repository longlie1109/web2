
<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
// session_start();
?>
<?php
                if(isset($_GET['register'])){
                    if($_GET['gmail'] != '' && $_GET['password'] != ''){
                        $name = $_GET['gmail'];
                        $passWord = $_GET['password'];
                        $fullname = $_GET['fullname'];
                        $pass  = md5($passWord);
                         $query =  " INSERT INTO user1( email, password, fullname)
                       
                        values ('$name', '$pass' , '$fullname')";
                       if( mysqli_query($cnn , $query))
                        {
                            $_SESSION['id_cart'] = mysqli_insert_id($cnn);
                            header("location:index.php?dk=true");
                            
                        }
                        
                        else
                        header("location:index.php?dk=false");                   
                    }
                }
                else echo "loi";
?>