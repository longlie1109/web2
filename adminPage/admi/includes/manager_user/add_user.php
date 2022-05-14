<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();

if(isset($_POST['action']) && $_POST['action']=="add_user"){
	if($_POST['gmail'] != '' && $_POST['password'] != ''){
		$name = $_POST['gmail'];
		$passWord = $_POST['password'];
		$passWord = md5($passWord);
		$fullname = $_POST['fullname'];
		 $query =  " INSERT INTO user1( email, password, fullname)

		values ('$name', '$passWord' , '$fullname')";
	   if( mysqli_query($cnn , $query))
		{
			$_SESSION['id_cart'] = mysqli_insert_id($cnn);
			header("location:../../index.php?action=view_user");
			
		}
		
		else
		header("location:../../index.php?dk=false");                   
	}
}
else echo "loi";
 
$cnn->close();
