<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
include("../controller/pagination.php");
$result ;
$sql;
$row;
if(isset($limit)&&isset($start)){
if(isset($_GET['selling'])){
    $sql ="SELECT *,s1.id as ids from sach s1 where s1.id in ( SELECT s.id FROM sach s ,donhang dh, chitietdonhang ct where s.id =ct.idsach and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY ct.idsach) LIMIT $start, $limit ";
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
        $sql ="SELECT *,s.id as ids FROM sach s order by id DESC LIMIT $start, $limit";
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
            $sql ="SELECT *,s.id as ids FROM sach s  LIMIT $start, $limit";
            $result = mysqli_query($cnn,$sql);
            if ( !$result ) { 
                include_once("no_product.php");
            }else {
                # code...
                $row =mysqli_fetch_assoc($result);
            }
        }else{
            $id = $_GET['type_search'];
            $sql ="SELECT *,s.id as ids  FROM sach s where matheloai = '$id' LIMIT $start, $limit ";
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
        if($_GET['search_price']=="down")
        {
            $sql ="SELECT *,s.id as ids FROM sach s order by dongia DESC LIMIT $start, $limit";
          
        }else {
            $sql ="SELECT *,s.id as ids FROM sach s order by dongia ASC LIMIT $start, $limit";
            
        }
    }
else if(isset($_GET['seachnavbar'])){
    $name = $_GET['name-header'];
    $sql ="SELECT *, s.id as ids FROM sach s WHERE  tensach LIKE '%$name%' order by tensach LIMIT $start, $limit";  
}else if(isset($_GET['search'])){
    $name = $_GET['name'];
    $author = $_GET['author'];
    $priceMin = $_GET['minprice'];
    $priceMax = $_GET['maxprice'];
    $type =$_GET['type'];
        if($type == "all"){
            $sql ="SELECT *,s.id as ids FROM sach s , tacgia t WHERE t.tentacgia LIKE '%$author%' and s.tensach LIKE '%$name%' and (s.dongia <= '$priceMax' and s.dongia >= '$priceMin') and s.idtacgia = t.id order by s.tensach LIMIT $start , $limit";      
            }else{
                
                $sql ="SELECT *,s.id as ids FROM sach s , tacgia t, theloai l WHERE t.tentacgia LIKE '%$author%' and s.tensach LIKE '%$name%' and (s.dongia <= '$priceMax' and s.dongia >= '$priceMin') and l.id = s.matheloai and s.idtacgia = t.id order by s.tensach LIMIT $start , $limit";      
 
            }         
    // $sql=mysql_query("select * from dangky where name='".$_GET['tukhoa']."' order by name asc limit $start,$row_per_page");
}
// else {
//     $sql = "SELECT * FROM sach LIMIT $start, $limit";  
// }
$result = mysqli_query($cnn,$sql);
if ( !$result ) { 
   include_once("no_product.php");
}else if(mysqli_num_rows($result)>0){  
?>
 <!-- <div id="home-product-show-pagination"> -->
    <div class="home-product">
       <div id ="home-product_ajax"class="row sm-gutter">
<?php
    while($row=mysqli_fetch_assoc($result)){
?>
 <div class="col l-2-4 m-4 c-6">
                                    <a class="home-product-item"  href="index.php?page=<?php echo $current_page?>&id=<?php echo$row['id']?>&action=show<?php if(isset($_GET['seachnavbar'])){
                                        echo "&seachnavbar=&name-header="."$name";
                                    }else if(isset($_GET['type_search'])){
                                        if($_GET['type_search']=="all"){
                                            echo "&type_search=all";
                                        }
                                        else {
                                            echo "&type_search="."$id";
                                        }
                                    }
                                    else if(isset($_GET['search'])){
                                        if($_GET['search']=="all")
                                        {
                                            echo "&type=all&name="."$name"."&author="."$author"."&maxprice="."$priceMax"."&minprice="."$priceMin"."&search=";
                                        }
                                        else{
                                            echo "&type="."$type"."&name="."$name"."&author="."$author"."&maxprice="."$priceMax"."&minprice="."$priceMin"."&search=";
                                        }
                                    }
                                    else if(isset($_GET['search_price']))
                                    {
                                        if($_GET['search_price']=="down")
                                        {
                                           echo "&search_price=down";
                                          
                                        }
                                        else {
                                            echo "&search_price=top";
                                        }
                                    }
                                    else if(isset($_GET['new_product'])){
                                        echo "&new_product";
                                    }
                                        ?>">
                                        <div src="" alt="" class="home-product__img" style="background-image: url(/web/adminPage/admi/img/book/<?php echo $row['matheloai']?>/<?php echo $row['image']?>);"></div>
                                        <h4 class="home-product__name">
                                            <?php
                                                    echo $row['tensach'];
                                               ?>
                                        </h4>
                                        <div class="home-produt-item__price-old">
                                            <?php if($row['sale']>0) {?>
                                            <span class="home-product-item__priced">
                                               <?php
                                                   echo number_format($row['dongia']);
                                               ?>
                                               đ
                                            </span>
                                            <?php }?>
                                            <span class="home-produt-item__price-current">
                                                <?php
                                                    echo number_format($row['dongia'] - ($row['dongia']*($row['sale']/100)));
                                                ?>
                                                đ
                                            </span>
                                        </div>
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
                                        <?php if($row['sale']>0) {?>
                                        <div class="home-produt-item__sale-off">
                                            <span class="home-produt-item__sale-off_percent">
                                                <?php
                                                    echo $row['sale'];
                                                    echo "%";
                                                
                                                ?>
                                            </span>
                                            <span class="home-produt-item__sale-off-label">Giảm</span>
                                        </div>
                                        <?php }?>
                                    </a>
                                    
                                   
                                </div>
                                
<?php
}
?>
</div>
</div>
<!-- </div> -->
<?php
}
?>
<ul class="pagination home-product__pagination">
                                 <!-- <li class="pagination-item ">
                                <a href="" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-left"></i>
                                </a>
                            </li> -->
                            <?php
                                include("../controller/pagination.php");
                                if ($current_page > 1 && $total_page > 1){
                                    // <a href="index.php?page='.($current_page-1).'">Prev</a> | ';
                                    if(isset($_GET['selling'])){
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.($current_page-1).'&selling" class="pagination-item__link">
                                            <i class="pagination-item__icon fas fa-angle-left "></i>
                                        </a>
                                    </li> ' ;
                                    }else
                                if(isset($_GET['new_product'])){
                                    echo '<li class="pagination-item">
                                    <a href="index.php?page='.($current_page-1).'&new_product" class="pagination-item__link">
                                        <i class="pagination-item__icon fas fa-angle-left "></i>
                                    </a>
                                </li> ' ;
                                }else
                                if(isset($_GET['search_price']))
                                {
                                    if($_GET['search_price']=="down")
                                    {
                                        echo '<li class="pagination-item">
                                            <a href="index.php?page='.($current_page-1).'&search_price=down" class="pagination-item__link">
                                                <i class="pagination-item__icon fas fa-angle-left "></i>
                                            </a>
                                        </li> ' ;
                                    }
                                    else{
                                        echo '<li class="pagination-item">
                                            <a href="index.php?page='.($current_page-1).'&search_price=top" class="pagination-item__link">
                                                <i class="pagination-item__icon fas fa-angle-left "></i>
                                            </a>
                                        </li> ' ;
                                        }
                                        
                                }else  if(isset($_GET['type_search'])){
                                        if($_GET['type_search']=="all")
                                        {
                                            echo '<li class="pagination-item">
                                                    <a href="index.php?page='.($current_page-1).'&type_search=all" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-left "></i>
                                                    </a>
                                                </li> ' ;
                                        }else
                                        echo '<li class="pagination-item">
                                                    <a href="index.php?page='.($current_page-1).'&type_search='.$id.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-left"></i>
                                                    </a>
                                                </li> ' ;
                                    }
                                    else if(isset($_GET['seachnavbar']))
                                        {
                                            
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?seachnavbar=&page='.($current_page-1).'&name-header='.$name.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-left"></i>
                                                    </a>
                                                </li> ' ;
                                        }else
                                        if(isset($_GET['search']))
                                        {
                                            if($type == "all"){
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?page='.($current_page-1).'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-left"></i>
                                                    </a>
                                                </li> ' ;
                                            }
                                            else
                                           {
                                    echo '
                                    <li class="pagination-item">
                                    <a href="index.php?page='.($current_page-1).'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                        <i class="pagination-item__icon fas fa-angle-left"></i>
                                    </a>
                                </li>';}
                                }
                            }
                                // Lặp khoảng giữa
                                for ($i = 1; $i <= $total_page; $i++){
                                    // Nếu là trang hiện tại thì hiển thị thẻ span
                                    // ngược lại hiển thị thẻ a
                                    
                                    if ($i == $current_page){
                                           
                                            echo '<li class="pagination-item pagination-item--active">
                                            <a href="" class="pagination-item__link">
                                                <i class="pagination-item__icon">'.$i.'</i>
                                            </a>
                                        </li> ';
                                    }else
                                    if(isset($_GET['selling'])){
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.$i.'&selling" class="pagination-item__link">
                                            <i class="pagination-item__icon ">'.$i.'</i>
                                        </a>
                                    </li> ' ;
                                    }else
                                    if(isset($_GET['new_product'])){
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.$i.'&new_product" class="pagination-item__link">
                                            <i class="pagination-item__icon ">'.$i.'</i>
                                        </a>
                                    </li> ' ;
                                    }else
                                    if(isset($_GET['search_price']))
                                    {
                                        if($_GET['search_price']=="down")
                                        {
                                            echo '<li class="pagination-item">
                                                <a href="index.php?page='.$i.'&search_price=down" class="pagination-item__link">
                                                    <i class="pagination-item__icon">'.$i.'</i>
                                                </a>
                                            </li> ' ;
                                        }
                                        else{
                                            echo '<li class="pagination-item">
                                                <a href="index.php?page='.$i.'&search_price=top" class="pagination-item__link">
                                                    <i class="pagination-item__icon">'.$i.'</i>
                                                </a>
                                            </li> ' ;
                                            }
                                            
                                    }
                                    else{
                                        if(isset($_GET['seachnavbar']))
                                        {
                                            
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?seachnavbar=&page='.$i.'&name-header='.$name.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon">'.$i.'</i>
                                                    </a>
                                                </li> ' ;
                                        }else
                                        if(isset($_GET['type_search'])){
                                            if($_GET['type_search']=="all")
                                            {
                                                echo '<li class="pagination-item">
                                                        <a href="index.php?page='.$i.'&type_search=all" class="pagination-item__link">
                                                            <i class="pagination-item__icon ">'.$i.'</i>
                                                        </a>
                                                    </li> ' ;
                                            }else
                                            echo '<li class="pagination-item">
                                                        <a href="index.php?page='.$i.'&type_search='.$id.'" class="pagination-item__link">
                                                            <i class="pagination-item__icon">'.$i.'</i>
                                                        </a>
                                                    </li> ' ;
                                        }
                                        else 
                                        if(isset($_GET['search']))
                                        {
                                            if($type == "all"){
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?page='.$i.'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon">'.$i.'</i>
                                                    </a>
                                                </li> ' ;
                                            }
                                            else
                                           {
                                                // type=ky_nang_song&name=sms&author=mss&minprice=1&maxprice=1&search=
                                            echo '<li class="pagination-item">
                                            <a href="index.php?page='.$i.'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                                <i class="pagination-item__icon">'.$i.'</i>
                                            </a>
                                        </li> ' ;
                                           }
                                        }else
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.$i.'" class="pagination-item__link">
                                            <i class="pagination-item__icon">'.$i.'</i>
                                        </a>
                                    </li> ' ;
                                    }
                                }
                     
                                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                                if ($current_page < $total_page && $total_page > 1){
                                    // <a href="index.php?page='.($current_page+1).'">Next</a> | ';
                                    if(isset($_GET['selling'])){
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.($current_page+1).'&selling" class="pagination-item__link">
                                            <i class="pagination-item__icon fas fa-angle-right "></i>
                                        </a>
                                    </li> ' ;
                                    }else
                                    if(isset($_GET['new_product'])){
                                        echo '<li class="pagination-item">
                                        <a href="index.php?page='.($current_page+1).'&new_product" class="pagination-item__link">
                                            <i class="pagination-item__icon fas fa-angle-right "></i>
                                        </a>
                                    </li> ' ;
                                    }else
                                    if(isset($_GET['search_price']))
                                    {
                                        if($_GET['search_price']=="down")
                                        {
                                            echo '<li class="pagination-item">
                                                <a href="index.php?page='.($current_page+1).'&search_price=down" class="pagination-item__link">
                                                    <i class="pagination-item__icon fas fa-angle-right "></i>
                                                </a>
                                            </li> ' ;
                                        }
                                        else{
                                            echo '<li class="pagination-item">
                                                <a href="index.php?page='.($current_page+1).'&search_price=top" class="pagination-item__link">
                                                    <i class="pagination-item__icon fas fa-angle-right "></i>
                                                </a>
                                            </li> ' ;
                                            }
                                            
                                    }else
                                    if(isset($_GET['seachnavbar']))
                                        {
                                            
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?seachnavbar=&page='.($current_page+1).'&name-header='.$name.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-right"></i>
                                                    </a>
                                                </li> ' ;
                                }else
                                if(isset($_GET['type_search'])){
                                    if($_GET['type_search']=="all")
                                    {
                                        echo '<li class="pagination-item">
                                                <a href="index.php?page='.($current_page+1).'&type_search=all" class="pagination-item__link">
                                                    <i class="pagination-item__icon fas fa-angle-right"></i>
                                                </a>
                                            </li> ' ;
                                    }else
                                    echo '<li class="pagination-item">
                                                <a href="index.php?page='.($current_page+1).'&type_search='.$id.'" class="pagination-item__link">
                                                    <i class="pagination-item__icon fas fa-angle-right"></i>
                                                </a>
                                            </li> ' ;
                                }
                                else 
                                        if(isset($_GET['search']))
                                        {
                                            if($type == "all"){
                                               echo '<li class="pagination-item">
                                                    <a href="index.php?page='.($current_page+1).'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                                        <i class="pagination-item__icon fas fa-angle-right"></i>
                                                    </a>
                                                </li> ' ;
                                            }
                                            else
                                           {
                                    echo '
                                    <li class=\"pagination-item\">
                                <a href="index.php?page='.($current_page+1).'&search=&type='.$type.'&name='.$name.'&author='.$author.'&minprice='.$priceMin.'&maxprice='.$priceMax.'" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-right"></i>
                                </a>
                            </li>';
                                }
                            }
                        }
                               ?>
</ul>
<?php
}
?>