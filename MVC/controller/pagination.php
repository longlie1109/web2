<?php
        // BƯỚC 1: KẾT NỐI CSDL
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    if(isset($_GET['selling'])){
        $sql ="SELECT COUNT(s1.id) as total from sach s1 where s1.id in ( SELECT s.id FROM sach s ,donhang dh, chitietdonhang ct where s.id =ct.idsach and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY ct.idsach)";
        $result = mysqli_query($cnn,$sql);
            if ( !$result ) { 
                include_once("no_product.php");
            }else {
                # code...
                $row =mysqli_fetch_assoc($result);
            }
    }else
    if(isset($_GET['new_product']))
    {
        $sql ="SELECT count(id) as total FROM sach";
        $result = mysqli_query($cnn,$sql);
            if ( !$result ) { 
                include_once("no_product.php");
            }else {
                # code...
                $row =mysqli_fetch_assoc($result);
            }
    }
    else  
    if(isset($_GET['type_search']))
    {       
            if($_GET['type_search']=="all")
            {
                $sql ="SELECT count(id) as total FROM sach";
                $result = mysqli_query($cnn,$sql);
                if ( !$result ) { 
                     include_once("no_product.php");
                }else {
                    # code...
                    $row =mysqli_fetch_assoc($result);
                }
            }else {
            $id = $_GET['type_search'];
            $sql ="SELECT count(id) as total FROM sach where matheloai = '$id' ";
            $result = mysqli_query($cnn,$sql);
            if ( !$result ) { 
                 include_once("no_product.php");
            }else {
                # code...
                $row =mysqli_fetch_assoc($result);
            }
        }
    }
    else
    if(isset($_GET['search_price']))  
    {
        $result = mysqli_query($cnn, 'select count(id) as total from sach');
        $row = mysqli_fetch_assoc($result);
    }
    else if(isset($_GET['seachnavbar'])){
        $name = $_GET['name-header'];
        $sql ="SELECT count(id) as total FROM sach WHERE  tensach LIKE '%$name%'";
        $result = mysqli_query($cnn,$sql);
        if ( !$result ) { 
            include_once("no_product.php");
        }else {
            # code...
            $row =mysqli_fetch_assoc($result);
        }
    }
    else if(isset($_GET['search'])){
        $type =$_GET['type'];
        $name = $_GET['name'];
        $author = $_GET['author'];
        $priceMin = $_GET['minprice'];
        $priceMax = $_GET['maxprice'];
        $type =$_GET['type'];
        if($type == "all"){
            $sql ="SELECT count(s.id) as total FROM sach s , tacgia t WHERE t.tentacgia LIKE '%$author%' and s.tensach LIKE '%$name%' and (s.dongia <= '$priceMax' and s.dongia >= '$priceMin') and s.idtacgia = t.id";      
        $result = mysqli_query($cnn,$sql); 
       
            }
        else{   
                
         //$sql ="SELECT count(s.id) as total FROM sach s , tacgia t, theloai l WHERE t.tentacgia LIKE '%$author%' and s.tensach LIKE '%$name%' and (s.dongia <= '$priceMax' or s.dongia >= '$priceMin') and l.id = '$type' and l.id = s.matheloai and s.idtacgia = t.id";      
       $sql ="SELECT count(s.id) as total FROM sach s , tacgia t, theloai l WHERE t.tentacgia LIKE '%$author%' and s.tensach LIKE '%$name%' and (s.dongia <= '$priceMax' and s.dongia >= '$priceMin') and l.id = '$type' and l.id = s.matheloai and s.idtacgia = t.id";
        $result = mysqli_query($cnn,$sql); 
              
            } 
            if ($result) { 

                $row =mysqli_fetch_assoc($result);
            }else{
                $row['total'] = 0;
            }     
        // $sql=mysql_query("select * from dangky where name='".$_GET['tukhoa']."' order by name asc limit $start,$row_per_page");
        
       
    }
    // else {
    // //      // BƯỚC 2: TÌM TỔNG SỐ RECORDS
    //     $result = mysqli_query($cnn, 'select count(id) as total from sach');
    //     $row = mysqli_fetch_assoc($result);
    // }
    if($row){
    $total_records = $row['total'];
    // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;
    
    // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
    // tổng số trang
    $total_page = ceil($total_records / $limit);
    
    // Giới hạn current_page trong khoảng 1 đến total_page
    if ($current_page > $total_page){
        $current_page = $total_page;
    }
    else if ($current_page < 1){
        $current_page = 1;
    }
    
    // Tìm Start
    $start = ($current_page - 1) * $limit;
}
    // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
    // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
    
    // $sql=mysql_query("select * from dangky where sach='".$_GET['tukhoa']."' order by name asc limit $start,$row_per_page");
?>
<!-- pagination ajax -->
 