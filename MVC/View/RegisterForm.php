<div class="modal__overlay"></div>
                <div class="modal__body"> 
                   <form class="auth-form "method="GET" action="checkRegister.php" id="form_register"> 
                        <div class="auth-form__cointainer">
                            <div class="auth-form__header">
                                <h3 class="auth-form__heading">
                                    Đăng kí
                                </h3>
                                <span class="auth-form__switch-btn" onclick="openLoginForm()">
                                    Đăng nhập
                                </span>
                            </div>
                        <div class="auth-form__form">
                            <div class="form__register-item">
                                <input type="text" rules="required|email" id="gmail1" placeholder="Nhập Gmail của bạn" class="auth-form__input" name="gmail" >
                                <span class="form-message"></span>
                             </div>
                             <div class="form__register-item">
                                <input type="text" placeholder="Nhập họ và tên của bạn" class="auth-form__input" name="fullname" id="fullname" >
                                <span class="form-message"></span>
                             </div>
                            
                            <div class="form__register-item">
                                <input type="password" rules="required|min:6" placeholder="Nhập mật khẩu của bạn" class="auth-form__input" name="password" id="password1">
                                <span class="form-message"></span>
                            </div>
                            <div class="form__register-item">
                                <input type="password" placeholder="Nhập lại mật khẩu của bạn" class="auth-form__input" name="repassword" id="repassword">
                                <span class="form-message"></span>                     
                            </div>
                            <input type="text" hidden name="register">
                        </div>
                        <div class="auth-form__aside">
                            <p class="auth-form__policy-text">
                                Bằng việc đăng kí, bạn đã đồng ý với f8 shop về
                                <a href="" class="auth-form__link-text" >
                                    Điều khoản dịch vụ 
                                </a> &
                                <a href="" class="auth-form__link-text">
                                    Chính sách bảo mật
                                </a>
                            </p>
                        </div>
                        <div class="auth-form__control">
                            <div class="btn btn--nomal auth-form__control-back" onclick="closeForm()">
                                TRỞ LẠI
                            </div>
                            <button type="submit" class="btn btn--primary" name="register">
                                Đăng kí
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

                    <script>
        // Mong muốn của chúng ta
        Validator({
            formGroupSelector: ('.form__register-item'),
            form: '#form_register',
            errorSelector: '.form-message',
            rules: [
                // Validator.isRequied('#name'),
                // Validator.isRequied('#address'),
                // Validator.isRequied('#phone'),
                Validator.isRequied('#gmail1'),
                Validator.isRequied('#fullname'),
                Validator.isGmail('#gmail1'),
                Validator.isRequied('#password1'),
                Validator.minLength('#password1', 5),
                //  repassword muốn nhập vào đúng cái ruturn trong func
                // custom message tùy chỉnh cái message 
                Validator.isRequied('#repassword'),
                //  lưu ý input space
                Validator.isRepassword('#repassword', function (){
                    return document.querySelector('#form_register #password1').value;
                }, ' Mật khẩu không khớp'),        
                // Validator.isRequied('input[name="gender"]')
            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
        </script> 