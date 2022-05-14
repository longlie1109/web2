
<?php
    $cnn = mysqli_connect("localhost", "root", "" , "dota") or die (" khong ket noi duoc");
    mysqli_query($cnn, 'SET NAMES UTF8');
    $limit = 10;
    $page = "";
    if(isset($_POST['page']))
        {
            $page = $_POST['page'];       
        }
        else{
            $page = 1;   
        }
        $start = ($page - 1)*$limit;    
    $sql = "SELECT * FROM SACH LIMIT {$start} , {$limit}";
     
    $result = mysqli_query($cnn, $sql);
   

    $output = "";
    if(mysqli_num_rows($result)>0){
       $output.='<div class="home-product">
       <div id ="home-product_ajax"class="row sm-gutter">';
        while($row = mysqli_fetch_assoc($result)){
            $current =$row['dongia'] - ($row['dongia']*($row['sale']/100));
            $current = number_format($current);
            $row["dongia"] = number_format($row['dongia']);
           $output.=" <div class='col l-2-4 m-4 c-6'>
                                    <a class='home-product-item'  href='index.php?page={$page}&id={$row['id']}&action=show'>
                                        <div src='' alt='' class='home-product__img' style='background-image: url(/web/adminPage/admi/img/book/{$row["matheloai"]}/{$row["image"]});'></div>
                                        <h4 class='home-product__name'>
                                            {$row['tensach']}
                                        </h4>
                                        <div class='home-produt-item__price-old'>
                                        ";
                                        if($row['sale'] >0) {
                                            $output .="
                                            <span class='home-product-item__priced'>
                                            {$row["dongia"]} đ
                                            </span>";
                                        }
                                        $output.="
                                            <span class='home-produt-item__price-current'>
                                             $current đ
                                             
                                            </span>
                                        </div>
                                        <div class='home-produt-item__aciton'>
                                            <span class='home-produt-item__heart home-produt-item__heart--liked'>
                                                <i class='home-produt-item__heart--liked-icon-emty far fa-heart'></i>
                                                <i class='home-produt-item__heart--liked-icon-fill fas fa-heart'></i>
                                            </span>
                                            <div class='home-produt-item__rating'>
                                                <i class='home-produt-item-star-gold fas fa-star'></i>
                                                <i class='home-produt-item-star-gold fas fa-star'></i>
                                                <i class='home-produt-item-star-gold fas fa-star'></i>
                                                <i class='home-produt-item-star-gold fas fa-star'></i>
                                                <i class='far fa-star'></i>

                                            </div>";
                                             $idss = $row['id'];
                                            $sql2 ="SELECT  sum(ct.soluong) as total FROM sach s ,donhang dh,  chitietdonhang ct where ct.idsach =s.id and ct.idsach = $idss and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY ct.idsach";
                                            $result2 = mysqli_query($cnn,$sql2); 
                                            $row2 = mysqli_fetch_assoc($result2);
                                            if($row2)
                                            { 
                                                $output .="
                                            <span class='home-produt-item--sold'>
                                            Đã bán: {$row2['total']}
                                                
                                            </span>";
                                            }
                                            // $output .="
                                            // <span class='home-produt-item--sold'>
                                            //     1 Đã bán
                                            // </span>";

                                         $output .="   
                                        </div>
                                        <div class='home-produt-item__origin'>
                                            <span class='home-produt-item__brand'>Whoo</span>
                                            <span class='home-produt-item__origin-name'>Nhật bản</span>
                                        </div>";
                                        ?>
                                        <?php
                                            $idss = $row['id'];
                                            $sql2 ="SELECT  * FROM sach s ,donhang dh,  chitietdonhang ct where s.id = $idss and s.id =ct.idsach and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%'";
                                            $result2 = mysqli_query($cnn,$sql2); 
                                            $row2 = mysqli_fetch_assoc($result2);
                                            if($row2)
                                            { 
                                            $output .="
                                            <div class='home-produt-item__favourite'>
                                                <i class='fas fa-check'></i>
                                                <span>
                                                Yêu thích
                                                </span>
                                            </div>";
                                            }
                                        if($row['sale'] >0) {
                                            $output .="
                                        <div class='home-produt-item__sale-off'>
                                            <span class='home-produt-item__sale-off_percent'>
                                                {$row['sale']}
                                            </span>
                                            <span class='home-produt-item__sale-off-label'>Giảm</span>
                                        </div>";
                                        }
                                        $output.="
                                    </a>                                
                                </div>       
           ";
        }
    $sql_total = "SELECT * FROM sach";
    $records = mysqli_query( $cnn, $sql_total) or die ("sai");
     $total_records = mysqli_num_rows($records);
     $total_page = ceil($total_records/$limit);
     $output .=" 
     </div>
            </div>
      <ul  class='pagination home-product__pagination'>";
     for($i=1 ; $i<=$total_page; $i++){
         if($i == $page){
             $class_name = "pagination-item--active";
         }
         else {
             $class_name = "";
         }
         $output .="
         
         <li class='pagination-item {$class_name}'>
             <a href='' id={$i} class='pagination-item__link' >
                 <i class='pagination-item__icon'>{$i}</i>
             </a>
          </li>";
         
     }
     $output .= "</ul>
     ";

      
echo $output;
    }
    
?>