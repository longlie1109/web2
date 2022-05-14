<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
// session_start();
?>
<?php

if(isset($_POST["action"])){
	$idtacgia=$_POST["idtacgia"];
	$tentacgia=$_POST["tentacgia"];
	$sql = "INSERT INTO tacgia(`id`, `tentacgia`) VALUES ('$idtacgia','$tentacgia')";
	if ($cnn->query($sql) === TRUE) {
		
header("location:../../index.php?action=view_author&add_author=true");
} else {
echo "Error updating record: " ;
}
 
$cnn->close();
}
?>