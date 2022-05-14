<?php
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    session_start();
    $cart = $_SESSION['cart'];
    $id_kh = $_SESSION['id_cart'];
    $totalbill=$_POST['thanhtoan'];
    // print_r($cart);
    if(isset($_POST['thanhtoan'])){

        $name = $_POST['name'];
        $addrees = $_POST['address'];
        $phone = $_POST['phone'];
        $note = $_POST['note'];
        $time = date('Y/m/d');
    }

    else {
        echo"no";
        die();
    }
    $sql = "INSERT INTO DONHANG(idkhachhang,status,totalbill,phonenumber,username, address, note, created_time, last_update )
    values ('$id_kh','Chưa xử lí',$totalbill,'$phone', '$name' , '$addrees' ,'$note', '$time' ,'$time')";
    $result =mysqli_query($cnn, $sql);
    $iddonhang = mysqli_insert_id($cnn);

    if($result){
        foreach ($cart as $key => $value) {
        //     'id' => $row['id'],
        // 'name' => $row['tensach'],
        // 'img' => $row['image'],
        // 'theloai' => $row['matheloai'],
        // 'price' =>  $row['dongia'],
        // 'quantity'=> $quantity,
        // 'sale' =>$row['sale']
        $idsach = $value['id'];
        $dongia = $value['price'];
        $soluong = $value['quantity'];
        $id_donhang =  $iddonhang;
        $time1 = $value['time'];
            $sql = "INSERT INTO chitietdonhang(iddonhang,idsach,soluong,dongia, created_time, last_updated)
            values ( '$id_donhang','$idsach','$soluong', '$dongia' ,'$time1', '$time1')";
            mysqli_query($cnn, $sql);
           
            

            // set lại số lượng sáhc
            
        }
        $sql1 = "SELECT dh.iddonhang, ct.soluong as soluong, ct.idsach as idsach FROM donhang dh, chitietdonhang ct WHERE dh.iddonhang=ct.iddonhang and dh.iddonhang = $iddonhang";
        $result1 =mysqli_query($cnn , $sql1);
        if($result1){
        while ($row =mysqli_fetch_assoc($result1))
        {
        
            $total = $row['soluong'];
            $ids =$row['idsach'];   
            mysqli_query($cnn , "UPDATE sach set soluongs = soluongs - $total where id = $ids ");
        }
    }
        
    }else{
        echo"loi";
         die();
        header("location:../View/index.php?fall");
    }
    unset( $_SESSION['cart']);
    header("location:../View/index.php");

?>