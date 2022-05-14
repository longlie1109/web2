<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
?>
<?php
    if(isset($_REQUEST['action']))
        {
            if($_REQUEST['action'] == 'edit_status'&&$_REQUEST['id']!="")
            {
                $id = $_REQUEST['id'];
                
                $sql1="SELECT * FROM donhang where iddonhang ='$id'";
                $result = mysqli_query($cnn, $sql1);
                if($result)
                {
                   
                    $row= mysqli_fetch_assoc($result);
                    if($row['status']=="đã xử lí")
                    {
                        $sql = "UPDATE `donhang` set status ='Chưa xử lí' WHERE iddonhang='$id' ";
                        if(mysqli_query($cnn , $sql)){       
                            header("location:../../index.php?action=view_cart&change_status=true");
                           }
                        else 
                             header("location:../../index.php?action=view_cart&change_status=fall");
                    }
                    else{
                        $sql = "UPDATE `donhang` set status ='đã xử lí' WHERE iddonhang='$id' ";
                        if(mysqli_query($cnn , $sql)){     
                         header("location:../../index.php?action=view_cart&change_status=true");
                        }
                        else 
                        header("location:../../index.php?action=view_cart&change_status=fall");
                      
                        }
                }
                

            }
        }
        else echo"ok";
?>