
            <div id="addproduct">
                <div class="row header__from">
                <sapn class="h1 text-primary col l-12 header__title">
                   
                    Thêm tác giả mới
                    </sapn>
                    <!-- <button onclick="close1()"id="close" >
                    x    
                    </button> -->
                </div>
                <div class="form">
                    <form action="./includes/manager_author/add_tacgia.php" enctype="multipart/form-data" method="POST" id="form-addproduct">
                    <div class="mb-3">
                            <label for="type">ID tác giả:</label>
                            <input type="text"  id="idtacgia" class="form-control" name="idtacgia" placeholder="Nhập id tác giả">
                            <span class="form-message"></span>
                        </div> 
                      <div class="mb-3">
                            <label for="idproduct">Tên tác giả:</label>
                            <input type="text" id="tentacgia" class="form-control" name="tentacgia" placeholder="Nhập tên tác giả">
                            <span class="form-message"></span>
                        </div> 
                        
                       
                        <input type="text" hidden name="action" value="add_author">
                        <div >
                            <button class="btn btn-primary">
                                Thêm tác giả
                            </button>
                            <a href="?action=view_author&no_add">
                            <div class="btn btn-danger">
                                Hủy
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
                Validator.isRequied('#idtacgia'),
                Validator.isRequied('#tentacgia'),
               

            ],
            onSubmit: function (data) {
                    console.log(data)
             },
        });
    </script>