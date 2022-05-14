<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
?>
 <?php
// Kết nối Database
// include ("web/MVC/View/demo/connect.php");

if (isset($_POST['action'])){
    $id=$_POST['id_type'];
    $tentheloai=$_POST['ten_the_loai'];
    $id = str_replace(' ','',$id);
	$sql = "UPDATE `theloai` set tentheloai ='$tentheloai' WHERE id='$id' ";
    // $sql1 = "UPDATE sach s , theloai t set matheloai= $id where t.id = s.matheloai ";
    // mysqli_query($cnn, $sql1);

if (mysqli_query($cnn, $sql)){
    header('location:../../index.php?action=view_type&update=true');
} else {    
echo "Error updating record: " . $cnn->error;
 header("location:../../admin.php?faa");
}
 
$cnn->close();
}
?>