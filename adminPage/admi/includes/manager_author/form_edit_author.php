
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query=mysqli_query($cnn,"select * from `tacgia` where id='$id'");
        $row=mysqli_fetch_assoc($query);
    }
?>
<div id="addproduct">
    <div class="form">
        <form method="POST" action="./includes/manager_author/edit_author.php" enctype="multipart/form-data">
        <div class="form__product-item">
            <label for="type">ID</label>
            <input type="text"  id="id_author" class="form__input" value="<?php echo $row['id']; ?>" name="id_author" placeholder="Nhập id tác giả ">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
           <label for="idproduct">Tên tác giả:</label>
           <input type="text" id="ten_tac_gia" class="form__input" value="<?php echo $row['tentacgia']; ?>" name="ten_tac_gia" placeholder="Nhập tên tác giả">
            <span class="form-message"></span>
        </div> 
        
      
        <div >
        <input type="text" hidden name="action" value="edit_author">
            <button class="btn btn--primary">
                Sửa
            </button>
            <div class="btn btn--primary">
                <a href="?action=view_author&no_add">Hủy</a>
            </div>
        </div>
</form>
</div>
</div>