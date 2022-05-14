
            <div id="addproduct">
                <div class="row header__from">
                <sapn class="h1 text-primary col l-12 header__title">
                    Thêm thể loại mới
                    </sapn>
                    <!-- <button onclick="close1()"id="close" >
                    x    
                    </button> -->
                </div>
                <div class="form">
                    <form action="./includes/manager_type/add_theloai.php" enctype="multipart/form-data" method="POST" id="form-addproduct">
                    <div class="mb-3">
                            <label for="type">ID thể loại:</label>
                            <input type="text"  id="idtheloai" class="form-control" name="idtheloai" placeholder="Nhập id thể loại">
                            <span class="form-message"></span>
                        </div> 
                      <div class="mb-3">
                            <label for="idproduct">Tên thể loại:</label>
                            <input type="text" id="tentheloai" class="form-control" name="tentheloai" placeholder="Nhập tên thể loại">
                            <span class="form-message"></span>
                        </div> 
                        
                       
                        <input type="text" hidden name="action" value="add_type">
                        <div >
                            <button class="btn btn-primary">
                                Thêm thể loại
                            </button>
                            <a href="?action=view_type&no_add">
                            <div class="btn btn-danger">
                                Hủy
                            </div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <script>
        // Mong muốn của chúng ta
        Validator({
            formGroupSelector: ('.mb-3'),
            form: '#form-addproduct',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequied('#idtheloai'),
                Validator.isRequied('#tentheloai'),
               

            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
    </script>