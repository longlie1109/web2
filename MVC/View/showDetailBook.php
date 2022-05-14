
<?php
    $cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
    mysqli_query($cnn, 'SET NAMES UTF8');
    $id;
    $sql;
    $row;
    if(isset($_GET['action']))
        {
            $id= $_GET['id'];
            $sql = "SELECT * ,s.id as ids FROM sach s , theloai as t WHERE s.id = $id and t.id=s.matheloai";   
             $result = mysqli_query($cnn,$sql);
            if(!$result){
                echo "loi";
            }
            else if(mysqli_num_rows($result)>0){  
                while($row=mysqli_fetch_assoc($result)){
                    $tacgia = $row['idtacgia'];
                    $sql1 = " SELECT * from tacgia where id = '$tacgia'";
                    $result1 = mysqli_query($cnn, $sql1);
                    if($result1){
                        $row1 = mysqli_fetch_assoc($result1);

?>
<div id="modal1">
    <div class="modal__overlay1"></div>
    <div class="modal__body1"> 
        <div class="grid wide">

            <div class="row sm-gutter ">
            
                <div class= "col l-8 l-o-2">
                    <div class="row sm-gutter book-detail">                                        
                        <div class="col l-6 m-4 c-6"style="padding:20px 20px" >
                            <a  class="home-product-item"  href="#">
                                <div src="" alt="" class="home-product__img" style="background-image:url(/web/adminPage/admi/img/book/<?php echo $row['matheloai']?>/<?php echo $row['image']?>);"></div>
                                <!-- <div class="home-produt-item__price-old">
                                    <span class="home-product-item__priced">
                                        1.200.000đ
                                    </span>
                                    <span class="home-produt-item__price-current">
                                        900.000đ
                                    </span>
                                </div> -->
                                <div class="home-produt-item__aciton">
                                    <span class="home-produt-item__heart home-produt-item__heart--liked">
                                        <i class="home-produt-item__heart--liked-icon-emty far fa-heart"></i>
                                        <i class="home-produt-item__heart--liked-icon-fill fas fa-heart"></i>
                                    </span>
                                    <div class="home-produt-item__rating">
                                        <i class="home-produt-item-star-gold fas fa-star"></i>
                                        <i class="home-produt-item-star-gold fas fa-star"></i>
                                        <i class="home-produt-item-star-gold fas fa-star"></i>
                                        <i class="home-produt-item-star-gold fas fa-star"></i>
                                        <i class="far fa-star"></i>

                                    </div>
                                    <?php
                                             $idss = $row['ids'];
                                            $sql2 ="SELECT  sum(ct.soluong) as total FROM sach s ,donhang dh,  chitietdonhang ct where ct.idsach =s.id and ct.idsach = $idss and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY ct.idsach";
                                            $result2 = mysqli_query($cnn,$sql2); 
                                            $row2 = mysqli_fetch_assoc($result2);
                                            if($row2)
                                            { 
                                                ?>
                                    <span class="home-produt-item--sold">
                                    Đã bán:
                                        <?php echo $row2['total']; 
                                        ?>
                                    </span>
                                    <?php
                                            }
                                    ?>
                                </div>
                                <div class="home-produt-item__origin">
                                    <span class="home-produt-item__brand">Whoo</span>
                                    <span class="home-produt-item__origin-name">Nhật bản</span>
                                </div>
                                <?php
                                            $idss = $row['ids'];
                                            $sql2 ="SELECT  * FROM sach s ,donhang dh,  chitietdonhang ct where s.id = $idss and s.id =ct.idsach and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%'";
                                            $result2 = mysqli_query($cnn,$sql2); 
                                            $row2 = mysqli_fetch_assoc($result2);
                                            if($row2)
                                            { ?>
                                <div class="home-produt-item__favourite">
                                    <i class="fas fa-check"></i>
                                    <span>
                                   <?php
                                                echo "Yêu thích";
                                    ?>
                                    </span>
                                </div>
                                <?php
                                            }
                                ?>
                             <?php if($row['sale'] >0) {?>
                                <div class="home-produt-item__sale-off">
                                    <span class="home-produt-item__sale-off_percent">
                                        <?php echo $row['sale']?>
                                    </span>
                                    <span class="home-produt-item__sale-off-label">Giảm</span>
                                </div>
                                <?php }?>
                            </a>  
                        </div>
                        <div class="col l-6 c-6">
                            <div class="grid">
                                <div class="row sm-gutter ">
                                    <div class="col l-12 book-detail-header">
                                       <h1 style="font-weight: 400;"><?php echo $row['tensach']?></h1>
                                    </div>
                                    <div style="font-size:1.6rem"class="home-produt-item__rating col l-12 book-detail-body">
                                       <div class="book-detail-item">
                                            <span style="color:red">4.9</span>                                  
                                            <i class="home-produt-item-star-gold fas fa-star"></i>
                                            <i class="home-produt-item-star-gold fas fa-star"></i>
                                            <i class="home-produt-item-star-gold fas fa-star"></i>
                                            <i class="home-produt-item-star-gold fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <?php
                                             $idss = $row['ids'];
                                            $sql2 ="SELECT  sum(ct.soluong) as total FROM sach s ,donhang dh,  chitietdonhang ct where ct.idsach = $idss and ct.idsach =s.id and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY ct.idsach";
                                            $result2 = mysqli_query($cnn,$sql2); 
                                            $row2 = mysqli_fetch_assoc($result2);
                                            if($row2)
                                            { 
                                                ?>
                                     <span style="font-size:1.6rem" class="home-produt-item--sold">
                                            Đã bán
                                        <?php echo $row2['total']; 
                                        ?>
                                    </span>
                                    <?php
                                            }
                                    ?>
                                        </div>
                                    
                                        <div  class="home-produt-item__price-old col l-12 book-detail-item">
                                        <?php if($row['sale'] >0) {?>
                                            <span class="home-product-item__priced">
                                                <?php echo $row['dongia']?>
                                            </span>
                                        <?php }?>
                                            <span style="font-size:3rem" class="home-produt-item__price-current">
                                                <?php
                                                    echo number_format($row['dongia'] - ($row['dongia']*($row['sale']/100)));
                                                ?>
                                                đ
                                            </span>
                                        </div>
                                        <div class="book-detail-item">
                                            <div class="book-detail-body-type col l-12">
                                                <span> Thể loại</span>
                                                <?php
                                                  echo  $row['tentheloai'];
                                                ?>
                                            </div>    
                                            <div class="book-detail-body-author col l-12">    
                                                <span> Tác giả</span>
                                                <?php
                                                  echo  $row1['tentacgia'];
                                                ?>
                                            </div>
                                            <div class="book-detail-body-descibe col l-12">                                        
                                                <span> Số lượng còn lại trong kho:</span>
                                                <?php
                                                    echo $row['soluongs'];
                                                ?>
                                            </div>
                                            <div class="book-detail-body-descibe col l-12">                                        
                                                <span> Mô tả</span>
                                                <?php
                                                    echo $row['mota'];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="book-detail-footer">
                                   <form action="../controller/cart.php?">
                                   <div class="book-detail-footer-total-price">
                                        Tổng tiền: <span id ="total-book-detail">
                                            <?php echo number_format($row["dongia"]) ?>
                                            đ
                                        </span>
                                   </div>
                                    <div class="book-detail-footer-increase-redu">
                                        <label for="" class="book-detail-footer-label">
                                        Số lượng:
                                        <script>                                         
                                            function valueInput(){
                                                var s=document.querySelector("#number-input-value");
                                                var a = document.querySelector("#total-book-detail");
                                                a.innerHTML +=  
                                                
                                                (parseInt(s.value)* <?php echo $row['dongia'] - ($row['dongia']*($row['sale']/100))?>)+"đ";
                                            }                                         
                                        </script>
                                        </label>
                                        <div class="book-detail-footer-body">
                                            <div>
                                                <div  id="redu-book-detail" class="btn--size-min book-detail-footer-redu" onclick="redu()">
                                                    -
                                                </div>                                                                                                           
                                            </div>
                                            <div>
                                                <input type = "text" id = "number-input-value" name="books" class=" btn--size-min book-detail-footer-number " value ="1">    
                                                <input type = "text" hidden name="add_cart">  
                                                <input type="text" hidden name="action" value="add">
                                                <input type = "text" hidden name="id_book" value="<?php echo $row['ids']?>">     
                                                <script>
                                                    function increas(){
                                                        var s=document.querySelector("#number-input-value");
                                                        document.querySelector("#number-input-value").value = parseInt(s.value)+1;
                                                        if(s.value>0){
                                                            document.querySelector("#redu-book-detail").classList.remove("btn--disable-detail");
                                                            document.querySelector("#redu-book-detail").classList.add("book-detail-footer-redu");
                                                        }
                                                        
                                                         var a = document.querySelector("#total-book-detail");
                                                        a.innerHTML = (parseInt(s.value)* <?php echo $row['dongia'] - ($row['dongia']*($row['sale']/100))?>) +"đ";
                                                    }
                                                    function redu(){
                                                        var s=document.querySelector("#number-input-value");
                                                        var a = document.querySelector("#total-book-detail");
                                                        document.querySelector("#number-input-value").value = parseInt(s.value)-1;
                                                        if(s.value <=0)
                                                        {
                                                            document.querySelector("#redu-book-detail").classList.add("btn--disable-detail");
                                                            document.querySelector("#redu-book-detail").classList.remove("book-detail-footer-redu");
                                                            s.value = 0;
                                                            
                                                             a.innerHTML = "0đ";
                                                            return;
                                                    }
                                                    else {
                                                            document.querySelector("#redu-book-detail").classList.remove("btn--disable-detail");
                                                            document.querySelector("#redu-book-detail").classList.add("book-detail-footer-redu");
                                                    }
                                                        a.innerHTML = (parseInt(s.value)* <?php echo $row['dongia'] - ($row['dongia']*($row['sale']/100))?>) +"đ";
                                                }
                                                </script>                                                                            
                                            </div>
                                            <div>
                                                 <div  class="btn--size-min book-detail-footer-increase"onclick="increas()" >
                                                    +
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                    <div <?php if($row['soluongs']<=0)
                                                {
                                                    echo "style='justify-content: flex-end;'";
                                                }
                                                    
                                        ?> class="book-detail-footer-btn">

                                            <?php
                                                if($row['soluongs']>0)
                                                {
                                            ?>
                                             <button class="btn btn--primary">
                                                Thêm vào giỏ hàng
                                            </button>
                                            <?php
                                                } 
                                            ?>
                                            <div class="btn btn--primary" onclick="closeDetailBook()">
                                                cancel
                                            </div>
                                    </div>
                                   </form>

                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div> 
</div>        
<?php
                    }
                }

    }
}
?>