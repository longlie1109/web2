<li class="header__navbar-item header_navbar-user">
    <img src="/web/assets_css/img/no-cart.png" alt="" class="header__navbar-user-img">          
    
        <?php
            if(isset($_SESSION['user']))
            {
                echo ("<span class=\"header__navbar-user-name\">"
                .$_SESSION['user']);
                echo(" </span> ");
            }
        ?>
    <ul class="header__navbar-user-menu">
        <!-- <li class="header__navbar-user-item">
            <a href="admin.php">Quản lí</a>
        </li> -->
        <li class="header__navbar-user-item">
            <a href="">Địa chỉ của tôi</a>
        </li>
        <li class="header__navbar-user-item">
            <a href="donhang.php">Đơn hàng  của tôi</a>    
        </li>
        <li class="header__navbar-user-item">
            <a href="">Đổi mật khẩu</a>
        </li>
        <li class="header__navbar-user-item header__navbar-user--separate">
            <a href="logout.php">Đăng xuất</a>
        </li>
    </ul>
</li>
<!-- <script src="/web/assets_css/demo/main.js" type="text/javascript"></script> -->
<script >
    removeFormLoginAndRegiter();
</script>
