<?php
    if(isset($_GET['action']))
    {
        $action = $_REQUEST['action'];
        switch($action){
        case 'add_author' : 
            {
               header("location:../../admin.php?add_author");
                break;
            }
        case 'delete_author' :
            {
                if($_GET['id'])
                $id = $_GET['id'];
                include("delete_author.php");
                break;
            }
        case 'edit_sach' :
                {
                    if($_GET['id'])
                    $id = $_GET['id'];
                    header("location:../../admin.php?edit_author&id=$id");
                    break;
                }
        case "" :
        break;
        
    }
    } 
?>