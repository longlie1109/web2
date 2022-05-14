
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query=mysqli_query($cnn,"select * from `user1` where id='$id'");
        $row=mysqli_fetch_assoc($query);
    }
?>
<div id="addproduct">
    <div class="form">
        <form method="POST" action="./includes/manager_user/edit_user.php" enctype="multipart/form-data">
        <div class="form__product-item">
            <label for="type">ID</label>
            <input type="text"  id="id_user"  readonly class="form__input" value="<?php echo $row['id']; ?>" name="id_user" placeholder="Nhập id user">
            <span class="form-message"></span>
        </div> 
        <div class="form__product-item">
            <label for="idproduct">EMAIL:</label>
            <input type="text" id="email" class="form__input" value="<?php echo $row['email']; ?>" name="email" placeholder="Nhập email">
            <span class="form-message"></span>
        </div> 
        <div >
            <input type="text" hidden name="action" value="edit_user">
            <button class="btn btn--primary">
                Sửa
            </button>
            <div class="btn btn--primary">
                <a href="?action=view_user&no_add">Hủy</a>
            </div>
        </div>
</form>
</div>
</div>