
            <div id="addproduct">
                <div class="row header__from">
                    <sapn class="h1 text-primary col l-12 header__title">
                    Thêm User mới
                    </sapn>
                    <!-- <button onclick="close1()"id="close" >
                    x    
                    </button> -->
                </div>
                <div class="form">
                    <form action="../admi/includes/manager_user/add_user.php" enctype="multipart/form-data" method="POST" id="form-addproduct">
                    <div class="mb-3">
                            <label class="form-label" for="name">Họ và tên:</label>
                            <input type="text" id="name" class="form-control" name="fullname" placeholder="Nhập họ và tên">
                            <span class="form-message"></span>
                        </div> 
                    <div class="mb-3">
                            <label class="form-label" for="type">Email:</label>
                            <input type="text" name="gmail" id="email" class="form-control " name="email" placeholder="Nhập email">
                            <span class="form-message"></span>
                        </div> 
                      <div class="mb-3">
                            <label class="form-label" for="idproduct">Password:</label>
                            <input type="text" id="password" class="form-control " name="password" placeholder="Nhập password">
                            <span class="form-message"></span>
                        </div> 
                       
                       
                        <input type="text" hidden name="action" value="add_user">
                        <div >
                            <button class="btn btn-primary">
                                Thêm User
                            </button>
                            <a href="?action=view_user&noadd">
                            <div class="btn btn-danger">
                                Hủy
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
                Validator.isRequied('#name'),
                Validator.isRequied('#email'),
                Validator.isGmail ('#email'),
                Validator.isRequied('#password'),
               

            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
    </script>