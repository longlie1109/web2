<?php
    
   session_start();
   session_destroy();
   unset($_SESSION['user']);
   if(isset($_SESSION['user']))
   {
       echo "chua xoa duoc";
   }
   else
   header("location:index.php?ok");
?>