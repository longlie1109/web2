 <?php
// Kết nối Database
// include ("web/MVC/View/demo/connect.php");
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if (isset($_POST['action'])){
    $id = $_POST['id'];
    $name=$_POST['name'];
    $fullname=$_POST['fullname'];
    $sql = "UPDATE `user1` SET email='$name' , fullname='$fullname' WHERE id='$id' ";

if (mysqli_query($cnn, $sql)){
    header('location:../../index.php?action=view_user&update=true');
} else {    
echo "Error updating record: " . $cnn->error;
 header("location:../../index.php?action=view_user&update=fall");
}
 
$cnn->close();
}
?>