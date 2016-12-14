<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $groups = find_all('user_groups');

?>
<?php
  if(isset($_POST['add_client'])){

   $req_fields = array('full-name','username','password');
   validate_fields($req_fields);

   if(empty($errors)){
       $name   = remove_junk($db->escape($_POST['full-name']));
       $mname   = remove_junk($db->escape($_POST['m-name']));
       $lname   = remove_junk($db->escape($_POST['l-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $companyname   = remove_junk($db->escape($_POST['company-name']));
       $phone   = remove_junk($db->escape($_POST[' company-phone']));


       $six_digit_random_number = mt_rand(100000, 999999);

       $user_level = 1;
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name,mname,lname,username,password,user_level,status,company_name,admin_id,phone";
        $query .=") VALUES (";
        $query .=" '{$name}','{$mname}', '{$lname}','{$username}', '{$password}', '{$user_level}','1','{$companyname}','{$six_digit_random_number}','{$phone}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Client account has been created! ");
          redirect('add_user.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create account!');
          redirect('add_client.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_client.php',false);
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
          <form method="post" action="add_client.php">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name="full-name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="name">Middle Name</label>
                <input type="text" class="form-control" name="m-name" placeholder="Middle Name">
            </div>

            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" class="form-control" name="l-name" placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" name="company-name" placeholder="Company Name">
            </div>

            <div class="form-group">
                <label for="name">Phone Number</label>
                <input type="text" class="form-control" name="company-phone" placeholder="Phone">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name ="password"  placeholder="Password">
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_client" class="btn btn-primary">Add Client</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
