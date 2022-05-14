<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start(); ?>
<?php
if(isset($_REQUEST['id_user']) and $_REQUEST['id_user']!=""){
$id=$_GET['id_user'];
$sql = "DELETE FROM user1 WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
header('location:../admin.php?action=view_user&delete=true');
} else {
echo "Error updating record: " . $conn->error;
}
 
$conn->close();
}
?>