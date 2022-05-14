<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đơn hàng chi tiết</title>
  <link rel="icon" href="../../assets_css/img/logo.png" type="image/gif" sizes="16x16">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/web/assets_css/fonts/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="/web/assets_css/css/base.css">
    <link rel="stylesheet" href="/web/assets_css/css/main.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/grid.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/Reponsive.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/reset.css">
</head>

<body>
  <div class="grid wide grid_demo">
      <div class="row sm-gutter">
        <div class="col l-12 m-12 c-12 header_bill">
         <header class="clearfix col l-12 c-12 m-12">
            <div class="row sm-gutter">
            <div class="col l-4 m-4 c-4">
              <h1><a  href="index.php" >Trang chủ</a></h1>
            </div>
            <div  id="logo" class="col l-4 c-4 m-4">
              <img src="../../../web/assets_css/img/logo.png">
            </div>
            <div id="company" class="col l-4 c-4 m-4">
              <h2 class="name">
                  Book Store - SaiGonUniversity
              </h2>
              <div> 
                 273 An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh
              </div>
              <div>
                  0123456789
              </div>
              <div>
                <a href="mailto:email@gmail.com">
                  mail@gmail.com
                </a>
              </div>
              </div>
            </div>
            </div>
          </header> 
      </div>
  <div class="row sm-gutter">
    <div id="details "  class="col l-12 m-12 c-12 ">
      <div id="client" class="clearfix col l-6 m-12 c-12">
        <div class="to">Thông Tin Của Bạn:</div>
        <h2 class="name"><?php
        echo ("<span class=\"header__navbar-user-name\">"
        .$_SESSION['user']);
        echo(" </span> ");
        ?></h2>
        <div class="address">Địa chỉ:</div>
        <div class="email"><a href="mailto:john@example.com">mail@gmail.com</a></div>
      </div>

      <div id="invoice"  class="clearfix col l-6 m-12 c-12">
        <h1>Thông Tin Đơn Hàng Của Bạn</h1>
        <!-- <div class="date">Date of Invoice: 01/06/2014</div>
        <div class="date">Due Date: 30/06/2014</div> -->
      </div>
    </div>
  </div>
  
<div class="row">
    <div class="col l-12 m-12 c-12">
    <table style="font-size:1.4rem; font-width:300">
    <thead>
      <tr class="title-table">
        <th>Tên sách </th>
        <th>Hình minh họa </th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Ngày đặt</th>
        <th>Tình trạng</th>
        <th>Sửa</th>
        <th>Xóa</th>
        <th> Thanh toán </th>
      </tr>
    </thead>
    <?php
      if(isset($_GET['update_bill']))
      {
        
  
        $soluong = $_GET['soluong'];
        if($soluong =="")
        {
          $soluong =0;
        }
        $iddh = $_GET['idhd'];
        $idct = $_GET['idct'];
        $sql ="SELECT * FROM `chitietdonhang` as ct , sach as s WHERE iddonhang = $iddh AND `idchitiethoadon` = $idct and s.id = idsach";
        $result = mysqli_query($cnn, $sql);
        if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          if(($row['soluongs']+$row['soluong']) < ($soluong) ){
            $sql1 = "UPDATE chitietdonhang set soluong = soluong where idchitiethoadon = $idct";
          $result1 = mysqli_query($cnn, $sql1);
          }else{
          // sửa lại số sách trong sách
            $soluongold =$row['soluong'];
            $ids =$row['idsach'];   
            mysqli_query($cnn , "UPDATE sach set soluongs = soluongs - ($soluong - $soluongold)  where id = $ids ");
           $sql1 = "UPDATE chitietdonhang set soluong = $soluong  where idchitiethoadon = $idct";
          $result1 = mysqli_query($cnn, $sql1);
          }
          if($result1){?>
            <h1> update  thành công </h1>
        <?php
          }
          else{?>
              <h1> update không thành công </h1>
          <?php
          }
        }
      } 
      }
  ?>
  <?php
      if(isset($_GET['delete']))
      {
        $id = $_GET['id'];
        // xóa thì trả lại số sách
        $sql ="SELECT * FROM `chitietdonhang` as ct , sach as s WHERE  `idchitiethoadon` = $id and s.id = idsach";
        $result = mysqli_query($cnn, $sql);
        if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
        $soluongold =$row['soluong'];
        $ids =$row['idsach'];
        mysqli_query($cnn , "UPDATE sach set soluongs = soluongs +  $soluongold  where id = $ids ");
        }
      }
        $sql1 = "DELETE FROM  chitietdonhang  where idchitiethoadon = $id";
          $result1 = mysqli_query($cnn, $sql1);
          if($result1){?>
            <h1> Xóa thành công </h1>
        <?php
          }
          else{?>
              <h1>Xóa không thành công </h1>
          <?php
          }
      }
  ?>
    <?php
    $id_kh = $_SESSION['id_cart'];
    $sql = "SELECT * FROM chitietdonhang as HD , donhang as DH, sach as S where S.id = HD.idsach and idkhachhang = '$id_kh' and HD.iddonhang = DH.iddonhang";
    $result = mysqli_query($cnn, $sql);
    $total_bill = 0;
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $total = ($row['soluong'] * $row['dongia']) - ($row['soluong'] * $row['dongia']) * ($row['sale'] / 100);
        $total_bill += $total; 
    ?>
        <tr>
          <td style="min-width: 150px;text-align:left"><?php echo $row['tensach'] ?></td>
          <td> <div src="" alt="" class="home-product__img" style="background-image: url(/web/adminPage/admi/img/book/<?php echo $row['matheloai']?>/<?php echo $row['image']?>);"></div>
</td>
          <td><?php echo $row['soluong'] ?></td>
          <td><?php echo  number_format($total)?>VNĐ</td>
          <td style="min-width: 68px;"><?php echo $row['created_time'] ?></td>
          <td><?php echo $row['status'] ?></td>
          <td><?php if($row['status']=="Chưa xử lí"){
                ?>
                  <a href="editdh.php?iddh=<?php echo $row['iddonhang']?>&idhdct=<?php echo $row['idchitiethoadon']?>">Sửa</a>
                <?php
          }?></td>
           <td><?php if($row['status']=="Chưa xử lí"){
                ?>
                  <a href="?delete&id=<?php echo $row['idchitiethoadon']?>" onclick="return confirm('Bạn có chắc chắn xóa không ?')">Xóa</a>
                <?php
          }?></td>
          <td><?php if($row['status']=="đã xử lí"){
                  echo "Thanh toán";
                ?>
          </td>
          <?php
          }
          ?>
        </tr>
    <?php
      }
    } else echo "k dc";
    ?>
   
  </table>
 </div>
</div>
  <tr ><h1 style="text-align:right;width: 100%;">Tổng tiền: <?php echo number_format($total_bill)?>VNĐ</h1></tr>
  <div id="thanks">Thank you!</div>
  <div id="notices">
    <div>Lưu Ý:</div>
    <div class="notice">Khoản phí tài chính 1,5% sẽ được thực hiện đối với số dư chưa thanh toán sau 30 ngày.</div>
  </div>
  </main>
  <footer>
    Book Store - Dai Hoc Sai Gon - Sai Gon University - SGU
  </footer>
      </div>

  </div>
  </body>
</html>

<style>
  .grid_demo{
    min-width: 920px;
  }
  .title-table th {
    background-color: rgb(104, 225, 253);
  }

  @font-face {
    font-family: SourceSansPro;
    src: url(SourceSansPro-Regular.ttf);
  }
  .header_bill{
    display: flex;
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  a {
    color: #0087C3;
    text-decoration: none;
  }

  /* body {
    position: relative;
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
  } */

  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    text-align: center;
  }

  #logo img {
    height: 70px;
  }

  #company {
    float: right;
    text-align: right;
  }


  #details {
    margin-bottom: 50px;
  }

  #client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    float: left;
  }

  #client .to {
    color: #777777;
  }

  h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
  }

  #invoice {
    float: right;
    text-align: right;
  }

  #invoice h1 {
    color: #0087C3;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0 0 10px 0;
  }

  #invoice .date {
    font-size: 1.1em;
    color: #777777;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
  }

  table th,
  table td {
    padding: 20px;
    background: #EEEEEE;
    text-align: center;
    border-bottom: 1px solid #FFFFFF;
  }

  table th {
    white-space: nowrap;
    font-weight: normal;
  }

  table td {
    text-align: right;
  }

  table td h3 {
    color: #57B223;
    font-size: 1.2em;
    font-weight: normal;
    margin: 0 0 0.2em 0;
  }

  table .no {
    color: #FFFFFF;
    font-size: 1.6em;
    background: #57B223;
  }

  table .desc {
    text-align: left;
  }

  table .unit {
    background: #DDDDDD;
  }

  table .total {
    background: #57B223;
    color: #FFFFFF;
  }

  table td.unit,
  table td.qty,
  table td.total {
    font-size: 1.2em;
  }

  table tbody tr:last-child td {
    border: none;
  }

  table tfoot td {
    padding: 10px 20px;
    background: #FFFFFF;
    border-bottom: none;
    font-size: 1.2em;
    white-space: nowrap;
    border-top: 1px solid #AAAAAA;
  }

  table tfoot tr:first-child td {
    border-top: none;
  }

  table tfoot tr:last-child td {
    color: #57B223;
    font-size: 1.4em;
    border-top: 1px solid #57B223;

  }

  table tfoot tr td:first-child {
    border: none;
  }

  #thanks {
    font-size: 2em;
    margin-bottom: 50px;
  }

  #notices {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
  }

  #notices .notice {
    font-size: 1.2em;
  }

  footer {
    margin-top:100px;
    color: #777777;
    width: 100%;
    height: 30px;
    /* position: absolute; */
    bottom: 0;
    border-top: 1px solid #AAAAAA;
    padding: 8px 0;
    text-align: center;
  }
  .home-product__img{
    padding-top: 100%;
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
}
</style>