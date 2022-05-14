<?php
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    session_start();


    $action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

    if(isset($_GET['id_book'])){

        $id =$_GET['id_book'];

    }
    if(isset($_GET['books'])){
            $quantity = $_GET['books'];
        }
    // session_destroy();
    // die();
    $sql  = "SELECT * FROM SACH WHERE id = $id"; 
    $result = mysqli_query($cnn, $sql);
    if($result){
    $row = mysqli_fetch_assoc($result);
    }
    // var_dump($row);
     $time =  date("Y/m/d");
    $book = [
        'id' => $row['id'],
        'name' => $row['tensach'],
        'img' => $row['image'],
        'theloai' => $row['matheloai'],
        'price' =>  $row['dongia'],
        'quantity'=> $quantity,
        'sale' =>$row['sale'],
        'time' => $time
    ];
    if($action == 'add') {
        if(isset($_SESSION['cart'][$id])){
            if($_SESSION['cart'][$id]['quantity'] <$row['soluongs']&&(($_SESSION['cart'][$id]['quantity'] + $quantity) <= $row['soluongs'])){
                $_SESSION['cart'][$id]['quantity'] +=$quantity;
            }else
            {   
                while(($_SESSION['cart'][$id]['quantity'] + $quantity) > $row['soluongs']){
                    $quantity -=1;
                }
                $_SESSION['cart'][$id]['quantity']= $_SESSION['cart'][$id]['quantity'] + $quantity;
            }
    
         }else{
                if($quantity > $row['soluongs'])
                {
                    $book['quantity']=$row['soluongs'];
                }
                $_SESSION['cart'][$id] = $book;
            }
    }
    else if($action == 'update'){
        if($row['soluongs']>=$quantity){
        $_SESSION['cart'][$id]['quantity'] = $quantity;
        }
        else{
            $_SESSION['cart'][$id]['quantity']= $_SESSION['cart'][$id]['quantity'];
        }

    }
    else if($action == 'delete'){
        unset($_SESSION['cart'][$id]);
    }
    if($row['soluongs']>=$quantity)
    {

        header("location:../View/cart-book.php?ok"); 
    }
    else{
        header("location:../View/index.php?not_enough&id=$id"); 

    }
//thêm mới 
// sửa 
// xóa
?>