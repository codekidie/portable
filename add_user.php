<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;
  $groups = find_by_sql("SELECT * FROM user_groups WHERE admin_id = '{$admin_id}'");
  $company_name = find_by_sql("SELECT company_name FROM users WHERE admin_id = '{$admin_id}' AND company_name IS NOT NULL LIMIT 1");
  $company_name =  $company_name[0][0];

?>
<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','username','password');
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $phone   = remove_junk($db->escape($_POST['phone']));
       // $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,status,admin_id,company_name,phone";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}','2', '1','{$admin_id}','{$company_name}','{$phone}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"User account has been creted! ");
          redirect('add_user.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create account!');
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="pe-7s-user"></span>
          <span>Add New User</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_user.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="full-name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name ="password"  placeholder="Password">
            </div>

              <div class="form-group">
                <label for="password">Phone</label>
                <input type="text" class="form-control" name ="phone"  placeholder="phone">
            </div>
            <!--     <div class="form-group">
              <label for="level">User Role</label>
                <select class="form-control" name="level">
                <option value="1">Admin</option>
                <option value="2">Special</option>
                <option value="3">User</option>
                  <?php //foreach ($groups as $group ):?>
                   <option value="<?php //echo $group['group_level'];?>"><?php //echo ucwords($group['group_name']);?></option>
                <?php //endforeach;?>
                </select>
            </div> -->
            <div class="form-group clearfix">
              <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
