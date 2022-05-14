<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
// type=1&id=1&name=1&price=1&img=a.png&author=1&sale=1&mota=1&action=add
        if(isset($_POST['action']) && isset($_FILES["img"])){
            if($_FILES['img']['error']){
                echo " upload loi";
            }
            $soluong = $_POST['quantity'];
            $id = $_POST['id'];
            $name = $_POST['name'];
            $type = $_POST['type'];
            $img = $_FILES['img']['name'];
            $author = $_POST['author'];
            $sale = $_POST['sale'];
            $mota = $_POST['mota'];
            $price = $_POST['price'];
            $query = "INSERT INTO sach(tensach, id, idtacgia, matheloai, mota, image, dongia, sale, soluongs )
            values ('$name', '$id', '$author', '$type', '$mota','$img', '$price', '$sale','$soluong')";
            mysqli_query($cnn , $query);
            $dir ='../img/book/'.$type."/";
            //chac chan co thu muc nhung tao cho chac an
            if(!file_exists($dir)){
                // Tạo một thư mục mới
                mkdir($dir);        
                     if (move_uploaded_file($_FILES['img']['tmp_name'],$dir."/".$_FILES['img']['name'])) {

                         header("location:../index.php?action=view_sach&sucsess");
                    } else {
                         header("location:../index.php?action=view_sach&fall");
                         }
                }else{
                    if (move_uploaded_file($_FILES['img']['tmp_name'],$dir."/".$_FILES['img']['name'])) {
            
                        header("location:../index.php?action=view_sach&sucsess");
                        } else {
                            header("location:../index.php?action=view_sach&fall");
                    } 
            }                               
        }
        else  header("location:../index.php?action=view_sach&fall");
?>
<!-- // if()){
//     echo "Tạo thư mục thành công.";
// } else{
//     echo "ERROR: Không thể tạo thư mục.";
// } -->