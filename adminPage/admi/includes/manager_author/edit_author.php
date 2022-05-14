 <?php
// Kết nối Database
// include ("web/MVC/View/demo/connect.php");
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if (isset($_POST['action'])){
    $id=$_POST['id_author'];
    $tentacgia=$_POST['ten_tac_gia'];
	$sql = "UPDATE `tacgia` SET tentacgia ='$tentacgia' WHERE id='$id' ";
    // $sql1 = "UPDATE sach s , tacgia t set s.tacgia = t.tentacgia where t.id='$id' ";
    
        if (mysqli_query($cnn, $sql)){
            // if(mysqli_query($cnn,$sql1)){
            header('location:../../index.php?action=view_author&update=true');
            // }
            // else echo "loi";
        } else {    
        echo "Error updating record: " . $cnn->error;
         header('location:../../index.php?action=view_author&update=fall');
        }
   
$cnn->close();
}
?>