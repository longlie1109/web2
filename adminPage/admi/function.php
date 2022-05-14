<?php
     if(isset($_GET['action'])){
      $action = $_GET['action'];
      }else {
          $action = '';
      }
      switch($action){
          case "view_sach":
              {
                  ?>
                    <script  type="text/javascript">
                        load();
                    </script>
                  <?php
                  break;
              }
          case "view_type":
            {
                ?>
                  <script  type="text/javascript">
                      loadC();
                  </script>
                <?php
                break;
            }
          case "add_sach": 
              {
                 include("./includes/manager_product/addproduct.php");
                 break;
              } 
          case "edit_sach" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                
                  include("./includes/manager_product/form_edit.php");
                break;
                }
            }  
          case "delete_sach" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                
                  include("./includes/delete_sach.php");
                break;
                }
            } 
          case "add_type": 
            {
                include("./includes/manager_type/add_theloai_form.php");
                break;
            } 
          case "edit_type" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                
                include("./includes/manager_type/form_edit_type.php");
                break;
                }
            }  

          case "view_author" : 
            {
                ?>
                  <script  type="text/javascript">
                      loadA();
                  </script>
                <?php
                break;
            }
          case "add_author": 
            {
                include("./includes/manager_author/add_tacgia_form.php");
                break;
            }
          case "edit_author" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                
                include("./includes/manager_author/form_edit_author.php");
                break;
                }
            }  
          case "view_cart" : 
            {
                ?>
                  <script  type="text/javascript">
                      loadCart();
                  </script>
                <?php
                break;
            } 
          case "edit_status" :
            {
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                header("location:./includes/manager_cart/change_status.php?action=$action&id=$id");
                break;
                }
            }
          case "show_detail_cart" :
            {
                ?>
                <script  type="text/javascript">
                    loadCartDetail();
                </script>
              <?php
              break;
            }
          case "view_user" : 
            {
              ?>
              <script  type="text/javascript">
                  loadUserl();
              </script>
               <?php
                break;
            }
        case "add_user" :
          {
              include("./includes/manager_user/add_user_form.php");
              break;
          } 
        case "edit_user" :
          {
              if(isset($_GET['id']))
              {
                  $id = $_GET['id'];
              
              include("./includes/manager_user/form_edit_user.php");
             
              }else
              echo "ok";
              break;
          } 
        case "priv_user": {
              include("./includes/privilege/priv.php");
              break;
      }
        case "view_statistical": {
          ?>
          <script  type="text/javascript">
          loadstatistical();
          </script>
               <?php
                break;
        }
        case "sort": {
          ?>
          <script  type="text/javascript">
          loadStatisticalS();
          </script>
               <?php
                break;
        }
      }
  ?>
 

<!-- // php check isset action {add, view , edit, xoa } -->