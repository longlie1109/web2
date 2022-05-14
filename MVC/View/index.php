
<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
if(isset($_SESSION['user']) && $_SESSION['user']=="admin")
{
    unset($_SESSION['user']);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book-store</title>
    <link rel="icon" href="../../assets_css/img/logo.png" type="image/gif" sizes="16x16">
          
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/web/assets_css/fonts/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="/web/assets_css/css/base.css">
    <link rel="stylesheet" href="/web/assets_css/css/main.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/grid.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/Reponsive.css"> 
    <link rel="stylesheet" href="/web/assets_css/css/reset.css">
    
    <script src="/web/js/js.js" type="text/javascript"></script>
    <script src="/web/js/main.js" type="text/javascript"></script>
    <script src="/web/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="/web/js/sweetalert.min.js"></script>
</head>
<body>
    <div class="app">
        <?php
            if(isset($_GET['dk']))
            {
                if($_GET['dk']=="true")
                {
        ?>
        <script>
                    alert("Đăng kí thành công");
                </script>
        <?php
                }
            }
        ?>
        <?php
            include('./includes/top.php')
        ?>
        <?php
        if(isset($_GET['not_enough']))
        {
            if(isset($_GET['id']))
            $id1= $_GET['id'];
           $result1 = mysqli_query($cnn, "SELECT * from sach where id =$id1");
            if($result1)
            {
                while($row1 = mysqli_fetch_assoc($result1))
                {
                    $name = $row1['tensach'];
                    $sl = $row1['soluongs'];
                }
            }
            else {
                echo "loi";
                die();
        }
            ?>
                <script>
                    alert("Số lượng sách <?php echo $name ?> của shop chỉ còn <?php echo $sl?> cuốn cho bạn! Mong bạn ủng hộ shop nhé ");
                </script>
            <?php
        }
    ?>
        
       <div id="modal"> 
        <?php
            include("RegisterForm.php");
        ?>   
        <?php
            include("LoginForm.php");
        ?>  
        </div>
        </div>
         <div class="app__container">
           <div class="grid wide">
                <div class="row sm-gutter app__container-content">
                    <div class="col l-2 m-0 c-0">
                        <?php
                            include("./includes/Category.php");
                        ?>
                    </div>
                    
                    <div class="col l-10 m-12 c-12">
                        <div class="home-filter hide-on-mobile-tablet ">
                            <span class="home-filter_label">
                                Sắp xếp theo
                            </span>
                           <a href="?popular" style="text-decoration: none;">
                           <button class="btn  btn--nomal-n " id="popular1">
                                Phổ biến 
                            </button>
                            </a>
                            <a href="?new_product">
                                <button class="btn btn--nomal-n " id="new_product1">
                                    Mới nhất
                                </button>                            
                            </a>
                            <a href="?selling">
                            <button class="btn btn--nomal-n" id="selling1">
                                Bán chạy 
                            </button>
                            </a>
                            <?php
                            if(isset($_GET['popular'])||isset($_GET['new_product'])||isset($_GET['selling'])){
                                ?>
                                <script>
                                    var x = document.querySelector('#<?php 
                                        if(isset($_GET['selling'])){
                                            echo "selling1";
                                        }
                                        else if(isset($_GET['new_product'])){
                                            echo"new_product1";
                                        }
                                        else{
                                            echo "popular1";
                                        }
                                    ?>');
                                    console.log(x);
                                    x.classList.add("btn--primary");
                                </script>
                                <?php
                            }
                                ?>
                            <div class="select-input">
                                <span class="select-input__label">
                                    Giá: 
                                    <?php
                                        if(isset($_GET['search_price']))
                                        {
                                            if($_GET['search_price']=="top"){
                                            ?>
                                               thấp đến cao
                                            <?php
                                        }
                                        else {
                                            ?>
                                                 cao đến thấp
                                            <?php
                                        }
                                    }
                                    ?>
                                </span>
                                <i class="selcet-input__icon fas fa-chevron-down"></i>
                                <ul class="select-input__list">
                                    <li class="select-input__item">
                                        <a href="?search_price=top" class="select-input__link">
                                            Giá: thấp đến cao
                                        </a>
                                    </li>
                                    <li class="select-input__item">
                                        <a href="?search_price=down" class="select-input__link">
                                            Giá: cao đến thấp
                                        </a>
                                    </li>
                                </ul>
                             </div>
                             <!-- <div class="home-filter__paginate">
                                 <div class="home-filter__page">
                                     <span class="home-filter__page-num">
                                         1
                                     </span>
                                     /14
                                 </div>
                             </div>
                              <div class="home-filter__page-control">
                                     <a href="" class="home-filter__page-control_link home-filter__page-disable">
                                         <i class="home-filter__page-icon fas fa-chevron-left"></i>
                                     </a>
                                     <a href="" class="home-filter__page-control_link">
                                         <i class="home-filter__page-icon fas fa-chevron-right"></i>
                                     </a>
                             </div> -->
                        </div>
                        <!-- <nav class="mobile-category">
                            <ul class="mobile-category__list">
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị Dụng cụ và thiết bị Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                <li class="mobile-category__item"><a href="" class="mobile-category__link">Dụng cụ và thiết bị</a>
                                </li>
                                </li>
                            </ul>
                        </nav> -->
                        <!-- <div class="home-product"> -->
                             <!-- <div id ="home-product_ajax"class="row sm-gutter"> -->
                                <div id="home-product-show-pagination">
                                    
                                </div>
                                <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
                               <script type="text/javascript">
                                 function load() {
                                    $(document).ready(function (){
                                    
                                   
                                    function load_data(page)
                                    {
                                        $.ajax({
                                        url:"pagination.php",
                                        method:"POST",
                                        data:{
                                            page: page
                                        },
                                        success : function(data){                            
                                            $('#home-product-show-pagination').html(data);
                                        }

                                        });
                                        
                                    }   
                                    load_data();                                      
                                    $(document).on('click', 'a.pagination-item__link', function (e){
                                        e.preventDefault();
                                        var pageId = $(this).attr('id');  
                                        load_data(pageId);
                                    });
                                });
                                 }
                               </script>  
                                <?php
                                        if(isset($_REQUEST['action']))
                                        {
                                            if($_REQUEST['action']=="show")
                                            {                                        
                                            include("showDetailBook.php");
                                            }
                                        }
                                        if(isset($_GET['selling'])||isset($_GET['new_product'])||isset($_GET['search'])||isset($_GET['seachnavbar'])||isset($_GET['type_search'])||isset($_GET['search_price']))
                                        {
                                            include("showbook.php");
                                        }
                                        else {
                                            ?>
                                            <script  type="text/javascript">
                                                load();
                                            </script>
                                            <?php
                                        }
                                    ?>
                          
                    </div>
                </div>
           </div>
        </div> 
       <?php
        include('./includes/footer.php');
       ?>
    </div>
</body>
<?php 
if(isset($_GET['login']) && $_GET['login'] == 'not_user') :?>
        <script>
                swal({
                 title: "Warning",
                 text: "User error",
                icon: "error",
              });
        </script>
<?php endif; ?>
<?php 
if(isset($_GET['login']) && $_GET['login'] == 'not_member') :?>
        <script>
                swal({
                 title: "Success",
                 text: "Welcome to Book Store",
                icon: "success",
              });
        </script>
<?php endif; ?>


</html>