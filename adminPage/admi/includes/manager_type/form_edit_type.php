
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query=mysqli_query($cnn,"select * from `theloai` where id='$id'");
        $row=mysqli_fetch_assoc($query);
    }
?>
<div id="addproduct">
    <div class="form">
        <form method="POST" action="./includes/manager_type/edit_theloai.php" enctype="multipart/form-data">
        <div class="form__product-item">
            <label for="type">ID</label>
            <input type="text"  id="id_type" class="form__input" value="<?php echo $row['id']; ?>" name="id_type" placeholder="Nhập id ">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="idproduct">Tên thể loại:</label>
            <input type="text" id="ten_the_loai" class="form__input" value="<?php echo $row['tentheloai']; ?>" name="ten_the_loai" placeholder="Nhập tên thể loại">
            <span class="form-message"></span>
        </div> 
        
      
        <div >
            <input type="text" hidden name="action" value="edit_type">
            <button class="btn btn--primary">
                Sửa
            </button>
            <div class="btn btn--primary">
                <a href="?action=view_type&noedit">Hủy</a>
            </div>
        </div>
</form>
</div>
</div>