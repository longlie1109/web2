
            <div id="addproduct">
                <div class="row header__from">
                <sapn class="h1 text-primary col l-12 header__title">
                    Thêm sản phẩm mới
                    </sapn>
                    <!-- <button onclick="close1()"id="close" >
                    x    
                    </button> -->
                </div>
                <div class="form">
                    <form action="./controller/addProduct.php" enctype="multipart/form-data" method="POST" id="form-addproduct">
                    <div class="mb-3">
                            <label for="select">Tên thể loại:</label>
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
                            <!-- <option  value="khoa_hoc">Khoa học</option>
                            <option value="ky_nang_song">Kĩ năng sống</option>
                            <option value="manga">Manga</option>
                            <option value="ngoai_ngu">Ngoại ngữ </option>
                            <option value="ngon_tinh">Ngôn tình</option>
                            <option value="tieu_thuyet">Tiểu thuyết</option>                  -->
                        </select>
                        <!-- <label for="type">Mã thể loại:</label>
                        <input type="text"  id="theloai" class="form-control" name="type" placeholder="Nhập thể loại"> -->
                        <span class="form-message"></span>
                    </div> 
                    <div class="mb-3">
                         <label for="author">Tên tác giả:</label>
                        <select class="selected-form" id="author" name="author">
                            <?php
                                $sql = "SELECT * FROM tacgia";
                                $result = mysqli_query($cnn , $sql);
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                            ?>
                                        <option  value="<?php echo $row['id']?>"><?php echo $row['tentacgia']?></option>
                            <?php            
                                    }
                                }
                            ?>
                       
                        </select>
                        <!-- <label for="type">Mã thể loại:</label>
                        <input type="text"  id="theloai" class="form-control" name="type" placeholder="Nhập thể loại"> -->
                        <span class="form-message"></span>
                    </div> 
                      <div class="mb-3">
                            <label for="idproduct">Mã sản phẩm:</label>
                            <input type="text" id="idproduct" class="form-control" name="id" placeholder="Nhập Mã">
                            <span class="form-message"></span>
                        </div> 
                        <div class="mb-3">
                            <label for="quantity">Số lượng:</label>
                            <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Nhập Số lượng">
                            <span class="form-message"></span>
                        </div> 
                        
                        <div class="mb-3">
                            <label for="name">Tên sản phẩm:</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên">
                            <span class="form-message"></span>
                        </div> 
                        <div class="mb-3">
                            <label for="price">Price: </label>
                            <input type="text" rules="" id="price" class="form-control" placeholder="Nhập giá" name="price">
                            <span class="form-message"></span>
                        </div> 
                        <div class="mb-3">
                            <label for="img">Img: </label>
                            <input type="file" rules="" id="img" class="form-control" placeholder="add img" name="img">
                            <span class="form-message"></span>
                        </div> 
                       <!-- <div class="mb-3">
                            <label for="author">Tên tác giả: </label>
                            <input type="text"  id="author" class="form-control" placeholder="Nhập tên tác giả" name="author">
                            <span class="form-message"></span> -->
                            <!-- rules="required|email" -->
                        <!-- </div>  -->
                        <div class="mb-3">
                            <label for="password">Sale</label>
                            <input type="text" id="sale" class="form-control" placeholder="Nhập sale" name="sale">
                            <span class="form-message"></span>
                            <!-- rules="required|min:6 -->
                        </div>     
                        <div class="mb-3">
                            <label for="repassword">Nhập mô tả:</label>
                            <input type="text" rules="" id="mota" class="form-control" placeholder="Nhập mô tả" name="mota">
                            <span class="form-message"></span>
                        </div> 
                         <!--<div class="mb-3 horizontal">
                            <label for="form-label" class="form-label"> Giới tính:</label>
                            <div>
                                <input type="radio" name="gender"  value="male">
                                Nam
                            </div>
                            <div>
                                <input type="radio" name="gender" value="female">
                                Nữ
                            </div>
                            <div>
                                <input type="radio" name="gender" value="orther">
                                Khác
                            </div>                       
                            <span class="form-message"></span>
                        </div>  -->
                        <!-- <div class="form__register-item">
                            <input type="hidden" name="trangchu" value="tt">
                        </div>  -->
                        <input type="text" hidden name="action" value="add">
                        <div >
                            <button class="btn btn-primary">
                                Thêm sản phẩm
                            </button>
                            <a href="?action=view_sach&no_add">
                            <div class="btn btn-danger">
                                Hủy
                            </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
<!-- <script src="../../js/main.js" type="text/javascript"></script> -->
    <script>
        // Mong muốn của chúng ta
        Validator({
            formGroupSelector: ('.mb-3'),
            form: '#form-addproduct',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequied('#idproduct'),
                Validator.isRequied('#select'),
                Validator.isRequied('#name'),
                Validator.isRequied('#price'),
                Validator.isRequied('#img'),
                Validator.isRequied('#author'),
                Validator.isRequied('#sale'),
                Validator.isRequied('#mota'), 

            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
    </script>