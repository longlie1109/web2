
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query=mysqli_query($cnn,"select * from `sach` where id='$id'");
        $row=mysqli_fetch_assoc($query);
        $img = $row['image'];
    }
?>
<div id="addproduct">
    <div class="form">
        <form method="POST" action="../admi/includes/edit_sach.php" enctype="multipart/form-data">
        <div class="form__product-item">
            <label for="type">Mã thể loại</label>
            <input type="text"  id="theloai" class="form__input" value="<?php echo $row['matheloai']; ?>" name="matheloai" placeholder="Nhập thể loại">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="idproduct">Mã sản phẩm:</label>
            <input type="text" id="idproduct" class="form__input" value="<?php echo $row['id']; ?>" name="id" placeholder="Nhập Mã">
            <span class="form-message"></span>
        </div> 
        
        <div class="form__product-item">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="tensach" class="form__input" value="<?php echo $row['tensach']; ?>" name="tensach" placeholder="Nhập tên">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="price">Price: </label>
            <input type="text" rules="" id="price" class="form__input" placeholder="Nhập giá" value="<?php echo $row['dongia']; ?>" name="dongia">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="img">Img: </label>
            <input type="file" rules="" id="img" class="form__input" placeholder="add img" name="img" accept="image/png, image/jpeg, image/jpg" value="<?php echo  $img;?>">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="author">Tên tác giả: </label>
            <input type="text"  id="author" class="form__input" placeholder="Nhập tên tác giả" name="tacgia" value="<?php echo $row['id']; ?>">
            <span class="form-message"></span>
            <!-- rules="required|email" -->
        </div> 
        <div class="form__product-item">
            <label for="password">Sale</label>
            <input type="text" id="sale" class="form__input" placeholder="Nhập sale" name="sale" value="<?php echo $row['sale'];?>" >
            <span class="form-message"></span>
            <!-- rules="required|min:6 -->
        </div>     
        <div class="form__product-item">
            <label for="repassword">Nhập mô tả:</label>
            <input type="text" rules="" id="mota" class="form__input" placeholder="Nhập mô tả" value="<?php echo $row['mota']; ?>" name="mota">
            <span class="form-message"></span>
        </div>
        <div >
            <input type="text" hidden name="edit_sach">
            <button class="btn btn--primary">
                Sửa
            </button>
            <div class="btn btn--primary">
                <a href="?action=view_sach&no_edit">Hủy</a>
            </div>
        </div>
</form>
</div>
</div>