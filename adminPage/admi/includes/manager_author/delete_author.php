<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
?>
<?php
// include_once('connect.php');
if(isset($_REQUEST['id_author']) and $_REQUEST['id_author']!=""){
$id=$_GET['id_author'];
$sql = "DELETE FROM tacgia WHERE idtacgia='$id'";
if ($cnn->query($sql) === TRUE) {
header('location:../../admin.php?action=view_author&delete=true');
} else {
echo "Error updating record: " . $cnn->error;
}
 
$cnn->close();
}
?>