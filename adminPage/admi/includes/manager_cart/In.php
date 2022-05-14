<!-- <?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql ="SELECT * from chitiethoadon where idchitiethoadon = $id";
        $result = mysqli_query($cnn, $sql);
        if($result){
            while($row = mysqli_fetch_assoc($result))
            {
                ?>
        <div class="form">
            <form action="./controller/addProduct.php" enctype="multipart/form-data" method="POST" id="form-addproduct">
                <div class="mb-3">
                    <label for="idproduct">Mã sản phẩm:</label>
                    <input type="text" id="idproduct" class="form-control" name="id" placeholder="Nhập Mã">
                    <span class="form-message"></span>
                </div>
                <div class="mb-3">
                    <label for="idproduct">Mã sản phẩm:</label>
                    <input type="text" id="idproduct" class="form-control" name="id" placeholder="Nhập Mã">
                    <span class="form-message"></span>
                </div>
                <div class="mb-3">
                    <label for="idproduct">Mã sản phẩm:</label>
                    <input type="text" id="idproduct" class="form-control" name="id" placeholder="Nhập Mã">
                    <span class="form-message"></span>
                </div>
                <div class="mb-3">
                    <label for="idproduct">Mã sản phẩm:</label>
                    <input type="text" id="idproduct" class="form-control" name="id" placeholder="Nhập Mã">
                    <span class="form-message"></span>
                </div>
            </form>
        </div>    
                <?php
            }
        }
        ?>
               
        <?php
    }
?> -->