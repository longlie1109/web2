<form class="auth-form" method="POST" action="checkLogin.php" id="form_login">
    <div class="auth-form__cointainer">
    <div class="auth-form__header">
        <h3 class="auth-form__heading">
            Đăng nhập
        </h3>
        <span class="auth-form__switch-btn" onclick="openRegisterForm()">
            Đăng kí
        </span>
    </div>
    <div class="auth-form__form">
        <div class="auth-form__groud">
            <input type="text" placeholder="Nhập tên tài khoản của bạn" class="auth-form__input" id="gmail" name="name-login">
            <span class="form-message"></span>
        </div>
        <div class="auth-form__groud">
            <input type="password" placeholder="Nhập mật khẩu của bạn" class="auth-form__input" name="password" id="password">
            <span class="form-message"></span>
        </div>
    </div>
    <div class="auth-form__aside">
        <div class="auth-form__help">
            <a href="" class="auth-form__help-link auth-form__help--forgot">Quên mật khẩu</a>
            <span class="auth-form__help-separate">
            </span>
            <a href="" class="auth-form__help-link ">Cần trợ giúp?</a>
        </div>
    </div>
    <div class="auth-form__control">
        <div class="btn btn--nomal auth-form__control-back" onclick="closeForm()">
        TRỞ LẠI
        </div>
        <input hidden name="login">
        <span id="connecting"></span>
        <button type="submit" class="btn btn--primary" id="login">
        Đăng Nhập
        </button>
    </div>
    <div class="auth-form__socials">
        <a href="" class="auth-form__socials--facebook btn btn--size-s btn--with-icon">
            <i class="auth-form__socials-icon fab fa-facebook-square"></i>
            <span class="auth-form__socials-label">
                Kết nối với facbook
            </span>
        </a>
        <a href="" class="auth-form__socials--google btn btn--size-s btn--with-icon">
            <i class="auth-form__socials-icon fab fa-google"></i>
            
            <span class="auth-form__socials-label">
                Kết nối với google
            </span>
        </a>
    </div>
</form>    
</div>     
<script src="/web/js/jquery-3.6.0.min.js" type="text/javascript"></script>

<script>
// Mong muốn của chúng ta
        Validator({
        formGroupSelector: ('.auth-form__groud'),
        form: '#form_login',
        errorSelector: '.form-message',
        rules: [
        Validator.isRequied('#gmail'),
        // Validator.isGmail('#gmail'),
        Validator.isRequied('#password'),
        Validator.minLength('#password', 5),
        ],
        onSubmit: function (data) {
        console.log(data)
        },
        });
</script> 