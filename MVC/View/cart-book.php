<?php
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    session_start();
    $cart = (isset($_SESSION['cart']) ? $_SESSION['cart'] :[]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart-book</title>
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
</head>
<body>
<div class="app">
    <?php
        include("./includes/top.php");
        
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
    <div class="app__container cart-book-app">
           <div class="grid wide">
                <div class="row sm-gutter app__container-content cart-book-content ">
                    <div class="col l-12 c-12 cart-book-header">
                        Giỏ hàng
                    </div>
                    <div class=" col l-9 c-12 m-12">
                       
                        <div class=" l-12 cart-book-wraper cart-book-app-detail">
                            <div class=" c-12 l-12 cart-book-title">
                            Sản phẩm
                            </div>
                            <div class=" c-12 m-12 l-12">
                                <div id="cart-body">
                                    <div id="cart-left-box">
                                        <div id="cart-products">
                                            <div id="cart-product-no-empty">
                                                <table style="width:100%">
                                                        <thead>
                                                                <tr >
                                                                    <th>STT</th>
                                                                    <th>Name</th>
                                                                    <th>image</th>
                                                                    <th>Số lượng</th>
                                                                    <th>Giá</th>
                                                                    <th>Thao tác</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($cart as $key => $value): ?>
                                                                <tr>
                                                                    <td><?php echo $key?></td>
                                                                    <td> <?php echo $value['name']?></td>
                                                                    <td><img src="/web/adminPage/admi/img/book/<?php echo $value['theloai']?>/<?php echo $value['img']?>" width="96px" alt=""></td>
                                                                    <td> 
                                                                        <form action="../controller/cart.php" id="cart-list"> 
                                                                            <div class="form-groud">
                                                                            <input style="border:1px solid black" type="text"  class="btn--size-min book-detail-footer-number" id="quantyti" value="<?php echo $value['quantity']?>" name ="books">
                                                                            <span class="form-message"></span>
                                                                            <button class ="btn btn--primary">
                                                                                    update
                                                                            </button>
                                                                            </div>
                                                                            <input type="text" hidden  name="id_book" value = "<?php echo $value['id'] ?>">
                                                                            <input type="text" hidden name="action" value = "update">
                                                                            
                                                                            <!-- <input type="checkbox" onsubmit="onsubmit()" name ="checkbox" id="checkbox"class="btn btn--primary btn--update ">
                                                                            <script>
                                                                                    function onsubmit(){
                                                                                        var checbox = document.querySelector('input[name="checkbox"]:checked');
                                                                                        if(checbox !=null){
                                                                                // if(checbox.value=="on")
                                                                                // console.log("co");
                                                                                            document.querySelector("#btnsubmit").obsubmit;
                                                                                        }
                                                                                        else console.log("k co");
                                                                                    }
                                                                            </script>   -->
                                                                        </form>
                                                                    </td>
                                                                    <td>  <?php echo number_format($value['price']*$value['quantity'] - ($value['price']*$value['quantity']) * ($value['sale']/100)) ?>đ </td>
                                                                    <td> 
                                                                        <a href="../controller/cart.php?action=delete&id_book=<?php echo $value['id']?>">
                                                                        <button class="btn btn--danger">
                                                                            Xóa
                                                                        </button>
                                                                       
                                                                        </a>
                                                                    </td>
                                                                </tr>

                                                        <?php endforeach ?> 
                                                            
                                                        </tbody>
                                                </table>
                                            </div>
                                            <div id="cart-products-empty">
                                            <?php
                                            if(count($cart)>0)
                                            {?>
                                               <script>
                                                     function closeCartEmty(){
                                                        document.querySelector("#cart-products-empty").style.display="none";
                                                        document.querySelector("#cart-product-no-empty").style.display="block";
                                                     }
                                                     closeCartEmty();
                                               </script>
                                               <?php 

                                            }
                                            else {
                                        ?>
                                            <script>
                                                    function openCartEmty(){
                                                        document.querySelector("#cart-products-empty").style.display="block";
                                                        document.querySelector("#cart-product-no-empty").style.display="none";
                                                     }
                                                     openCartEmty();
                                               </script>
                                        <?php
                                            }
                                        ?>
                                                <div id="cart-products-empty-container">
                                                    <div>  (Hiện không có sản phẩm nào trong giỏ hàng) </div>
                                                    <div>
                                                        <a href="index.php">
                                                        <button class="button btn btn--update "> Mua ngay </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col l-3 c-12 m-12">
                    <div id="cart-right-box">
                        <div id="cart-orders">
                            <div class="cart-title"> Đặt hàng </div>
                            <?php 
                            $total = 0;
                            $total_sale = 0;
                            ?>
                            <?php foreach($cart as $key => $value){
                              $total += $value['price']*$value['quantity'];
                              $total_sale +=  ($value['price']*$value['quantity']) * ($value['sale']/100);  
                            }
                                ?>
                            <div id="cart-orders-container">
                                <div id="cart-orders-price">
                                    <div id="cart-original-price" class="orders-price">
                                        <div> Giá sách </div>
                                        <div id="cart-orders-original-price"> <?php echo number_format($total) ?>đ </div>
                                    </div>

                                    <div id="cart-sale-price" class="orders-price">
                                        <div> Giảm giá </div>
                                        <div id="cart-orders-sale-price"> <?php echo number_format($total_sale) ?>đ </div>
                                    </div>

                                    <hr/>

                                    <div id="cart-final-price" class="orders-price">
                                        <div> Thành tiền </div>
                                        <div id="cart-orders-final-price"><?php echo number_format($total - $total_sale) ?>đ </div>
                                </div>
                                   
                                <div id="cart-orders-button-container">
                                    
                                        <button id="cart-orders-button" onclick="openLoginForm()"  class="button">
                                                Cần đăng nhập để mua hàng
                                        </button>
                                        <button onclick="isCartInfo()"  class="btn btn--primary cart-info-button">
                                                Thêm thông tin để đặt hàng
                                        </button>
                                        <?php
                                            if(isset($_SESSION['user']))
                                            {
                                        ?> 
                                            <script>
                                                document.querySelector("#cart-orders-button").style.display = "none";
                                                document.querySelector(".cart-info-button").style.display = "block";
                                            </script>       
                                        <?php
                                            
                                            }
                                            else {
                                        ?>
                                            <script>
                                                  document.querySelector(".cart-info-button").style.display = "none";
                                                  document.querySelector("#cart-orders-button").style.display = "block";
                                            </script> 
                                        <?php
                                            }    
                                        ?>    
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l-12 c-12 m-12" id="cart-info-wraper">
                        <form action="../controller/thanhtoan.php" method="POST" id="form_cart">
                            <div class="cart-info-content">
                                <div class="herder-cart-infor">
                                    <span> Thông tin khách hàng</span>
                                </div>
                                <div  class="cart-info-item">
                                    <label>Người nhận: </label>
                                    <input type="text" class="cart-info-item-input" value=""id="name" name="name" />
                                     <span class="form-message"></span>
                                </div>
                                <div class="cart-info-item">
                                        <label>Điện thoại: </label>
                                        <input  type="text" class="cart-info-item-input" value="" id="phone" name="phone" />
                                        <span class="form-message"></span>
                                </div>
                                <div class="cart-info-item">
                                        <label>Địa chỉ: </label>
                                        <input type="text" class="cart-info-item-input" value="" id="address" name="address" />
                                         <span class="form-message"></span>
                                </div>
                                <div class="cart-info-item"><label>Ghi chú: </label>
                                    <div>
                                        <textarea class="cart-info-item-input" name="note" ></textarea>
                                    </div>
                                </div>    
                                <input type="text" hidden value="<?=$total - $total_sale?>" name="thanhtoan" />
                                    <div class="cart-info-item-btn">
                                        <?php
                                            if(!empty($cart)){
                                        ?>
                                            <button class = "btn btn--primary btn--update">
                                            Đặt hàng
                                            </button> 
                                        <?php
                                            }
                                        ?>
                                        <div style="text-align:center;line-height:34px" onclick="noCartInfo()"class = "btn btn--danger">
                                            Hủy
                                        </div > 
                                    </div>
                                    
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>     
                    <script>
                            function isCartInfo(){
                                 document.querySelector(".cart-info-content").style.display="flex";
                                 document.querySelector(".cart-info-button").style.display = "none";

                            }
                        function noCartInfo() {
                             document.querySelector(".cart-info-content").style.display="none";
                             document.querySelector(".cart-info-button").style.display = "block";
                            }
                    </script>
         </div>
     </div>
             <?php
                 include("./includes/footer.php");
             ?>
     </div>
     <script>
     Validator({
        formGroupSelector: ('.form-groud'),
        form: '#cart-list',
        errorSelector: '.form-message',
        rules: [
        Validator.isRequied('#quantyti'),
        Validator.isNumber('#quantyti'),
        ],
        onSubmit: function (data) {
        console.log(data)
        },
        });
// Mong muốn của chúng ta
        Validator({
        formGroupSelector: ('.cart-info-item'),
        form: '#form_cart',
        errorSelector: '.form-message',
        rules: [
        Validator.isRequied('#name'),
        // Validator.isGmail('#gmail'),
        Validator.isRequied('#address'),
        Validator.isRequied('#phone'),
        // Validator.minLength('#phone', 10),
        Validator.isPhone('#phone'),
        Validator.isName('#name'),
        
        ],
        onSubmit: function (data) {
        console.log(data)
        },
        });
</script> 
     </body>
     
     </html>
         
                         
         
         
         
         
     


                            
        
                                        

