<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if(isset($_POST["action"])){
	$idtheloai=$_POST["idtheloai"];
	$tentheloai=$_POST["tentheloai"];
	$sql = "INSERT INTO theloai (`id`, `tentheloai`) VALUES ('$idtheloai','$tentheloai')";
	if ($cnn->query($sql) === TRUE) {	
		$dir ='../../img/book/'.$idtheloai;
		if(!file_exists($dir)){
			mkdir($dir);
		}
header("location:../../index.php?action=view_type&add_type=true");
} else {
echo "Error updating record: " ;
}
 
$cnn->close();
}
else echo "loi";
?>