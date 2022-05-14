<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if(!isset($_SESSION['user'])=='admin'){
    header("location:../../MVC/View/index.php");   
}
?>
<?php
   function delete_files($target) {
    if (is_dir($target)) {
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file )
        {
            delete_files( $file );
        }

        rmdir( $target );
    } else if (is_file($target)) {
        unlink( $target );
        
    }
}



    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else {
        $action = '';
    }
    switch($action){
        case "view_sach":
            {
                header("location:index.php?action=$action");
                break;
            }
        case "add_sach": 
            {
                header("location:index.php?action=$action");
                break;
            }  
        case "edit_sach" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                
                header("location:index.php?action=$action&id=$id");
                break;
                }
            }  
        case "delete_sach" :
            {
                if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
                $id=$_GET['id'];
                $sql1 = "SELECT * FROM sach where id='$id'";
                $result = mysqli_query($cnn,$sql1);
                $row = mysqli_fetch_assoc($result);
                $dir ='./img/book/'.$row['matheloai'];
                if($dir){
                    echo "ton tai";
                    unlink($dir."/".$row['image']);
                }
                $sql = "DELETE FROM sach WHERE id='$id'";
                if ($cnn->query($sql) === TRUE) {
                header("location:index.php?action=view_sach&delete=true");
                } else {
                echo "Error updating record: " 
                . $cnn->error;
                }
                
                $cnn->close();
                }
                break;
            }
        case "view_type" : 
            {
                header("location:index.php?action=$action");
                break;
            }
        case "add_type" :
            {
                header("location:index.php?action=$action");
                break;
            }
        case "delete_type" :
            {
                if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
                    $id=$_GET['id'];
                    $id = str_replace(' ','',$id);
                    $sql1 = "SELECT * FROM theloai where id='$id'";
                    $result = mysqli_query($cnn,$sql1);
                    $row = mysqli_fetch_assoc($result);
                    $dir ='./img/book/'.$row['id'];
                    $sql2 = "DELETE FROM sach WHERE matheloai='$id'";
                   if( mysqli_query($cnn, $sql2)){
                        if($dir){
                            delete_files($dir);
                        }else {
                            echo"k co";
                            exit();
                        }
                   }
                   else {
                       echo "ch dc";
                       die();
                   }
                    $sql = "DELETE FROM theloai WHERE id='$id'";
                    if ($cnn->query($sql) === TRUE) {
                    header("location:index.php?action=view_type&delete=true");
                    } else {
                    echo "Error updating record: " 
                    . $cnn->error;
                    }
                    
                    $cnn->close();
                    }
                    break;

            }
            case "edit_type" :
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    
                    header("location:index.php?action=$action&id=$id");
                    break;
                    }
                } 
            case "view_author" : 
                {
                    header("location:index.php?action=$action");
                    break;
                }
            case "add_author" :
                {
                    header("location:index.php?action=$action");
                    break;
                } 
            case "edit_author" :
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    
                    header("location:index.php?action=$action&id=$id");
                    break;
                    }
                }
            case "delete_author" :
                {
                    if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
                        $id=$_GET['id'];
                        // $sql1 = "SELECT * FROM tacgia where id='$id'";
                        // $result = mysqli_query($cnn,$sql1);
                        // $row = mysqli_fetch_assoc($result);
                        // $idtacgia= $row['id'];
                        // $sql2 = "DELETE FROM sach WHERE =$idtacgia";
                        // mysqli_query($cnn, $sql2);
                        $sql2 = "DELETE FROM sach WHERE idtacgia=$id";
                        if(mysqli_query($cnn, $sql2)){
                        
                        $sql = "DELETE FROM tacgia WHERE id='$id'";
                        if (mysqli_query($cnn,$sql)) {
                        header("location:index.php?action=view_author&delete=true");
                        } else {
                        echo "Error updating record: " ;
                        }
                    }
                        
                        $cnn->close();
                        }
                        else
                        echo "loi";
                        break;

                }
            case "view_cart" : 
                {
                    header("location:index.php?action=$action");
                    break;
                }
            case "edit_status" :
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    
                    header("location:./includes/manager_cart/change_status.php?action=$action&id=$id");
                    break;
                    }
                }
            case "show_detail_cart" :
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    
                        header("location:index.php?action=$action&id=$id");
                        break;
                    }
                }
            case "view_user" : 
                {
                    header("location:index.php?action=$action");
                    break;
                }
            case "edit_user" :
                {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    
                    header("location:index.php?action=$action&id=$id");
                    break;
                    }
                }

            case "add_user" :
                {
                    header("location:index.php?action=$action");
                    break;
                } 
                
            case "view_statistical" : 
                {
                    header("location:index.php?action=$action");
                    break;
                }
            case "delete_user" :
                {
                    if(isset($_REQUEST['id']) && $_REQUEST['id']!=""){
                        $id=$_GET['id'];
                        // $sql1 = "SELECT * FROM tacgia where id='$id'";
                        // $result = mysqli_query($cnn,$sql1);
                        // $row = mysqli_fetch_assoc($result);
                        // $idtacgia= $row['id'];
                        // $sql2 = "DELETE FROM sach WHERE =$idtacgia";
                        // mysqli_query($cnn, $sql2);
                        $sql = "DELETE FROM user1 WHERE id='$id'";
                        if ($cnn->query($sql) === TRUE) {
                        header("location:index.php?action=view_user&delete=true");
                        } else {
                        echo "Error updating record: " 
                        . $cnn->error;
                        }
                        
                        $cnn->close();
                        }
                        break;

                }
                case "priv_user": {
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    header("location:index.php?action=$action&id=$id");
                    }
                    break;
            }
            case "view_statistical":
                {
                    header("location:index.php?action=view_statistical");
                }
            case "sort":
                {
                    $data =$_GET['data'];
                    if(isset($_GET['startTime'])||isset($_GET['endTime'])){
                        $start=$_GET['startTime'];
                        $end=$_GET['endTime'];
                        header("location:index.php?action=$action&startTime=$start&endTime=$end");
                    }else
                    if($_GET['select']=="date"){
                        header("location:index.php?action=$action&date=$data");

                    }
                    else if($_GET['select']=="month")
                    {
                        header("location:index.php?action=$action&month=$data");
                        
                    }
                    else{
                        header("location:index.php?action=$action&year=$data");

                    }
                break;

                }
                case "view_statistical_chart":
                {
                    header("location:index.php?action=$action");
                }
    }

?>