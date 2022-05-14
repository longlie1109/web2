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
</head>

<body>
  <header class="clearfix" style="justify-content: space-between;
    display: flex;">
    <a href="index.php" >
      <div id="logo">
        <img src="../../../web/assets_css/img/logo.png">
      </div>
      <div>
      Trang chủ
      </div>
    </a>
    <div id="company" style="margin-left:350px">
      <h2 class="name">Book Store - SaiGonUniversity</h2>
      <div> 273 An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí Minh</div>
      <div>0123456789</div>
      <div><a href="mailto:email@gmail.com">mail@gmail.com</a></div>
    </div>
    </div>
  </header>
  <div id="details" class="clearfix">
    <div id="client">
      <div class="to">Thông Tin Của Bạn:</div>
      <h2 class="name">Tên khách hàng</h2>
      <div class="address">Địa chỉ</div>
      <div class="email"><a href="mailto:john@example.com">mail@gmail.com</a></div>
    </div>
    <div id="invoice">
      <h1>Thông Tin Đơn Hàng Của Bạn</h1>
      <!-- <div class="date">Date of Invoice: 01/06/2014</div>
      <div class="date">Due Date: 30/06/2014</div> -->
    </div>
  </div>
        <div>
            <form action="donhang.php">
            <?php
                $id_kh = $_SESSION['id_cart'];
                $iddh = $_GET['iddh'];
                $idct = $_GET['idhdct'];
                $sql = "SELECT * FROM `chitietdonhang` as ct , sach as s WHERE iddonhang = $iddh AND `idchitiethoadon` = $idct and s.id = idsach";
                $result = mysqli_query($cnn, $sql);
                if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div>
                    <label for="soluong"> Số lượng sách</label>
                    <input type="text" id="soluong" name="soluong" value="<?php echo $row['soluong']?>">
                    <input type="text" hidden name="update_bill"> 
                    <input type="text" hidden name="idhd" value="<?php echo $iddh?>">
                    <input type="text" hidden name="idct" value=<?php echo $idct?>> 
                </div>
                <div>
                    <button>update</button>
                </div>
                <?php
                }
            }
                ?>
            </form>
        </div>
  <div id="thanks">Thank you!</div>
  <div id="notices">
    <div>Lưu Ý:</div>
    <div class="notice">Khoản phí tài chính 1,5% sẽ được thực hiện đối với số dư chưa thanh toán sau 30 ngày.</div>
  </div>
  </main>
  <footer>
    Book Store - Dai Hoc Sai Gon - Sai Gon University - SGU
  </footer>
</body>

</html>

<style>
  .title-table th {
    background-color: rgb(104, 225, 253);
  }

  @font-face {
    font-family: SourceSansPro;
    src: url(SourceSansPro-Regular.ttf);
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

  body {
    position: relative;
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
  }

  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    float: left;
    margin-top: 8px;
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
    color: #777777;
    width: 100%;
    height: 30px;
    position: absolute;
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