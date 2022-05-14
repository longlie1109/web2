<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Phân quyền thành viên
        <a href="../admi/DAO.php?action=add_user">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
             Thêm user
          </button>
        </a>
    </h6>
  </div>
  <div class="card-body">
      <?php
            $privileges = mysqli_query($cnn, "SELECT * FROM privileges");
            $privileges = mysqli_fetch_all($privileges , MYSQLI_ASSOC);
            $privilege_gr = mysqli_query($cnn, "SELECT * FROM `privilege_groud` ORDER BY `privilege_groud`.`position` ASC");
            $privilege_gr = mysqli_fetch_all($privilege_gr , MYSQLI_ASSOC);

            $curentPrivileges = mysqli_query($cnn , "SELECT * FROM `user_privilege` WHERE `userID` = ".$_GET['id']);
            $curentPrivileges = mysqli_fetch_all($curentPrivileges, MYSQLI_ASSOC);

            $curentPrivilegeList = array();
            if(!empty($curentPrivileges)){
                foreach ($curentPrivileges as $curentPrivilege)
                {
                    $curentPrivilegeList[] = $curentPrivilege['privilegeID'];
                }
            }
      ?>
  
  <!-- Content Row -->
  <form action="index.php?action=save" method="POST">
    <?php
        foreach($privilege_gr as $group)
        {
    ?>
        <div class="form-group">
            <h3><?php echo $group['name']?></h3>
            <ul class="list-group list-group-horizontal">
            <?php
                foreach($privileges as $privilege)
                {
            ?>
            <?php 
                if($privilege['groud_id'] == $group['id']){
            ?>
                <li class="list-group-item">
                    <input type="text" hidden  name="userID" value="<?php echo $_GET['id']?>">
                    
                    <input type="checkbox" 
                    <?php if(in_array($privilege['id'], $curentPrivilegeList)){ ?>
                        checked=""
                     <?php }?>
                    value = "<?php echo $privilege['id']?>"class="form-check-input me-1" id="privilege_<?php echo $privilege['id'] ?>" name="privileges[]" >
                    <label for="privilege_<?php echo $privilege['id'] ?>">  <?php echo $privilege['name']?> </label>
                </li>
            <?php
                }
            ?>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        }
        ?>
        <button type="submit" name="action" class="btn btn-primary "> SAVE </button>
        <hr>
</form>

<!-- pagination -->

  