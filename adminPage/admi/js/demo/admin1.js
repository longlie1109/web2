function delete_sach(){
    var x = confirm("Are you sure you want to delete?");
  if (x)
     {
      document.querySelector(".admin_setting_delete a").removeEventListener("click", function(event){
        event.preventDefault()
      });
      return true;
     }
  else
    {
      document.querySelector(".admin_setting_delete a").addEventListener("click", function(event){
        event.preventDefault()
      });

    }
}

// js cho load trang ajax  
function load() {
  $(document).ready(function (){
  function load_data(page)
  {
      $.ajax({
      url:"./includes/manager_product/product.php",
      method:"POST",
      data:{
          page: page
      },
      success : function(data){                            
          $('#home-product-show-pagination').html(data);
      }

      });
  }   
  load_data();                                      
  $(document).on('click', 'a.pagination-item__link', function (e){
      e.preventDefault();
      var pageId = $(this).attr('id');  
      load_data(pageId);
      });
  });
}
function loadC() {
  $(document).ready(function (){
  function load_data(page)
  {
      $.ajax({
      url:"./includes/manager_type/category.php",
      method:"POST",
      data:{
          page: page
      },
      success : function(data){                            
          $('#home-product-show-pagination').html(data);
      }

      });
  }   
  load_data();                                      
  $(document).on('click', 'a.pagination-item__link', function (e){
      e.preventDefault();
      var pageId = $(this).attr('id');  
      load_data(pageId);
      });
  });
}
function loadA() {
  $(document).ready(function (){
  function load_data(page)
  {
      $.ajax({
      url:"./includes/manager_author/author.php",
      method:"POST",
      data:{
          page: page
      },
      success : function(data){                            
          $('#home-product-show-pagination').html(data);
      }

      });
  }   
  load_data();                                      
  $(document).on('click', 'a.pagination-item__link', function (e){
      e.preventDefault();
      var pageId = $(this).attr('id');  
      load_data(pageId);
      });
  });
}


function loadCart() {
  $(document).ready(function (){
  function load_data(page)
  {
      $.ajax({
      url:"./includes/manager_cart/cart.php",
      method:"POST",
      data:{
          page: page
      },
      success : function(data){                            
          $('#home-product-show-pagination').html(data);
      }

      });
  }   
  load_data();                                      
  $(document).on('click', 'a.pagination-item__link', function (e){
      e.preventDefault();
      var pageId = $(this).attr('id');  
      load_data(pageId);
      });
  });
}




function loadUserl() {
  $(document).ready(function (){
  function load_data(page)
  {
      $.ajax({
      url:"./includes/manager_user/user.php",
      method:"POST",
      data:{
          page: page
      },
      success : function(data){                            
          $('#home-product-show-pagination').html(data);
      }

      });
  }   
  load_data();                                      
  $(document).on('click', 'a.pagination-item__link', function (e){
      e.preventDefault();
      var pageId = $(this).attr('id');  
      load_data(pageId);
      });
  });
}

function loadstatistical() {
    $(document).ready(function (){
    function load_data(page)
    {
        $.ajax({
        url:"./includes/manager_statistical/doanhthu.php",
        method:"POST",
        data:{
            page: page
        },
        success : function(data){                            
            $('#home-product-show-pagination').html(data);
        }
  
        });
    }   
    load_data();                                      
    $(document).on('click', 'a.pagination-item__link', function (e){
        e.preventDefault();
        var pageId = $(this).attr('id');  
        load_data(pageId);
        });
    });
  }
  
  
