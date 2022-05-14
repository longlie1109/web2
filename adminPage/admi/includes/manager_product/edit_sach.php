 <?php
// Kết nối Database
// include ("web/MVC/View/demo/connect.php");
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if (isset($_POST['edit_sach'])){
    $id=$_POST['id'];
    $sale=$_POST['sale'];
    $tensach=$_POST['tensach'];
    // $tacgia=$_POST['author'];
    // $matheloai=$_POST['type']; 
    $soluong=$_POST['quantyti'];
    if($_FILES['img']['name']==""){
       $result =  mysqli_query($cnn, "SELECT * FROM sach WHERE id = $id");
        $row= mysqli_fetch_assoc($result);
        $img  = $row['image'];
    }
    else {
        $img = $_FILES['img']['name'];
    }
    $dongia=$_POST['dongia'];
    // $matheloai = str_replace(' ','',$matheloai);
    // $dir ='../img/book/'.$."/";
    // $dir ='../img/book/'.$matheloai."/";
            //chac chan co thu muc nhung tao cho chac an
            // if(!file_exists($dir)){
            //     // Tạo một thư mục mới
            //      mkdir($dir);        
            //     if (move_uploaded_file($_FILES['img']['tmp_name'],$dir."/".$img)) {


            //          header("location:../../index.php?action=view_sach&sucsess");
            //     }else {
            //              header("location:../../index.php?action=view_sach&fall");
            //         }
            //     }
            //     else{
            //         if (move_uploaded_file($_FILES['img']['tmp_name'],$dir."/".$img)) {
            
            //             header("location:../../index.php?action=view_sach&sucsess");
            //             } else {
            //                 header("location:../../index.php?action=view_sach&fall");
            // }                               

    $sql = "UPDATE `sach` SET tensach='$tensach', soluongs='$soluong',image='$img',dongia='$dongia' , sale='$sale.' WHERE id='$id' ";

if (mysqli_query($cnn, $sql)){
    header('location:../../index.php?action=view_sach&update=true');
} else {    
echo "Error updating record: " . $cnn->error;
 header("location:../../index.php?faa");
}
 
$cnn->close();
}
?>