<?php
$cnn = new mysqli('localhost', 'root', '', 'dota') or die('false');
mysqli_query($cnn, 'SET NAMES UTF8');
session_start();
?>
<?php
            if(isset($_POST['login']))
            {
                $user = $_POST["name-login"];
                $password = md5($_POST["password"]);
                $sql = " SELECT * FROM user1";
                $result = mysqli_query($cnn , $sql); //$this->conn->query($sql);
                if(mysqli_num_rows($result)>0){   
                    //this->result->fetch_assoc()
                    while($row = mysqli_fetch_assoc($result)){      
                         if($row["email"] == $user && $row["password"]== $password){
                            $_SESSION['id_cart'] = $row['id'];
                            $_SESSION['user'] = $row['fullname'];
                            $id = $row['id'];
                            //id đơn hàng cho tk user này lấy id của nó luôn
                            $user_privileges =  mysqli_query($cnn , "SELECT * FROM user_privilege 
                            INNER JOIN privileges on user_privilege.privilegeID = privileges.id
                             WHERE user_privilege.userID = $id");
                             //để all mé chuyển về mảng đượic
                            $user_privileges = mysqli_fetch_all($user_privileges,MYSQLI_ASSOC);
                            if(!empty($user_privileges))
                            {
                                $user_priv['privileges'] = array();
                                foreach ($user_privileges as $privilege) {
                                    $user_priv['privileges'][] = $privilege['uri_match'];
                                }
                                $_SESSION['current_user'] = $user_priv;
                            header("location:../../adminPage/admi/index.php?login=true");
                            exit();
                            }
                            else header("location:index.php?login=not_member"); 
                            exit();
                         }
                         else 
                         header("location:index.php?login=not_user"); 
                       
                    }
                   
                } 
    
            }
?>