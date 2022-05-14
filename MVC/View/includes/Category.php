<div class="row sm-gutter">
    <div class="col l-12">
    <nav class="category">
        <h3 class="category__heading">
            <i class="fas fa-list"></i>
            Thể loại
        </h3>
        <ul class="category-list">
            <li class="category-item <?php if(!isset($_GET['type_search'])) {
                echo  "category-item--active" ;} 
                else if(isset($_GET['type_search'])&&$_GET['type_search']=="all") {
                    echo  "category-item--active" ;
                }else {
                    echo"";
                }
                ?>">
                <a href="index.php?type_search=all" class="category-item__link">
                    Tất cả
                </a>
            </li>
        <?php
            $sql = "SELECT * FROM theloai";
            $result = mysqli_query($cnn , $sql);
            if($result){
                while ($row = mysqli_fetch_assoc($result))
                {
        ?>
            <li class="category-item">
                <a href="index.php?type_search=<?php echo $row['id'] ?>" id="type<?php echo $row['id']?>" class="category-item__link">
                   <?php echo $row['tentheloai']?>
                </a>
            </li>
        <?php            
                }
            }
        ?>   
        </ul>
        <?php if( isset($_GET['type_search'])){
                    $type=$_GET['type_search'];
                  ?>
                    <script>
                       var x = document.querySelector('#type<?php echo $type?>');
                       x.parentElement.classList.add("category-item--active");
                    </script>
                <?php
        }
                ?>
    </nav>
    </div>
    <div class="col l-12">
    <nav class="category category-text-color">
        <h3 class="category__heading">
            <i class="fas fa-list"></i>
            Tim kiếm
        </h3>
        <form action="index.php" method="GET" class="form" id="form-2">
            <div class="form-find">
                <div class="form__register-item-find">
                <label for="select">Thể loại sách</label>     
                    <select class="selected-form" id="select" name="type">
                            <?php
                                $sql = "SELECT * FROM theloai";
                                $result = mysqli_query($cnn , $sql);
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                                        <option  value="<?php echo $row['id']?>"><?php echo $row['tentheloai']?></option>
                            <?php            
                                    }
                                }
                            ?>                
                    </select>
                  <span class="form-message"></span>
                </div>
                <div class="form__register-item-find">
                    <label for="name">Tên sách</label>
                    <input type="text" placeholder="Nhập tên sách" name="name" id="name">
                    <span class="form-message"></span>
                </div>
                <div  class="form__register-item-find">
                    <label for="author">Tác giả</label>
                    <input type="text" placeholder="Nhập tên tác giả của sách "name="author" id="author">
                    <span class="form-message"></span>
                </div>
                <div  class="form__register-item-find">
                    <label for="minprice">Giá tối thiểu</label>
                    <input type="text" placeholder="Nhập giá tối thiểu "name="minprice" id="minprice">
                    <span class="form-message"></span>
                </div>
                <div  class="form__register-item-find">
                    <label for="maxprice">Giá tối đa</label>
                    <input type="text" placeholder="Nhập giá tối đa" name="maxprice" id="maxprice">
                    <span class="form-message"></span>
                </div>
                <input type="text" name="search" hidden>
                <div class="form__register-item-find">
                    <input class= "btn  btn-find"  type="submit" value = "Tìm kiếm">
                </div>
            </div>
        </form>

    </nav>
    </div>
</div>
<script>
     Validator({
            formGroupSelector: ('.form__register-item-find'),
            form: '#form-2',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequied('#name'),
                Validator.isRequied('#author'),
                Validator.isRequied('#minprice'),
                Validator.isRequied('#maxprice'),  
                Validator.isRequied('#name'),
                Validator.isRequied('#select'),
            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
</script>