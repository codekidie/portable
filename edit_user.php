<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','username','phone');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
             $name = remove_junk($db->escape($_POST['name']));
             $mname   = remove_junk($db->escape($_POST['m-name']));
             $lname   = remove_junk($db->escape($_POST['l-name']));
             $companyname = remove_junk($db->escape($_POST['companyname']));
            $username = remove_junk($db->escape($_POST['username']));
            $phone = remove_junk($db->escape($_POST['phone']));
       $status   = remove_junk($db->escape($_POST['status']));
            $sql = "UPDATE users SET name ='{$name}', mname ='{$mname}', lname ='{$lname}', username ='{$username}',status='{$status}', phone='{$phone}' , company_name='{$companyname}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount Updated ");
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Sorry failed to updated!');
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"User password has been updated ");
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d',' Sorry failed to updated user password!');
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="pe-7s-user"></span>
          Update <?php echo remove_junk(ucwords($e_user['name'])); ?> Account
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
          <div class="form-group">
              <label for="status">Company Name</label>
                  <input type="name" class="form-control" name="companyname" value="<?php echo remove_junk(ucwords($e_user['company_name'])); ?>">
                
            </div>
            <div class="form-group">
                  <label for="name" class="control-label">First Name</label>
                  <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
            </div>
            <div class="form-group">
                <label for="name">Middle Name</label>
                <input type="text" class="form-control" name="m-name" value="<?php echo remove_junk(ucwords($e_user['mname'])); ?>" placeholder="Middle Name">
            </div>

            <div class="form-group">
                <label for="name">Last Name</label>
                <input type="text" class="form-control" name="l-name" value="<?php echo remove_junk(ucwords($e_user['lname'])); ?>" placeholder="Last Name">
            </div>
            <div class="form-group">
                  <label for="username" class="control-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
            </div>

            <div class="form-group">
                  <label for="phone" class="control-label">Phone</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo remove_junk(ucwords($e_user['phone'])); ?>">
            </div>
         
            <div class="form-group">
              <label for="status">Status</label>
                <select class="form-control" name="status">
                  <option <?php if($e_user['status'] === '1') echo 'selected="selected"';?>value="1">Active</option>
                  <option <?php if($e_user['status'] === '0') echo 'selected="selected"';?> value="0">Deactive</option>
                </select>
            </div>


            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  <!-- Change password form -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="pe-7s-user"></span>
          Change <?php echo remove_junk(ucwords($e_user['name'])); ?> password
        </strong>
      </div>
      <div class="panel-body">
        <form action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
          <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Type user new password">
          </div>
          <div class="form-group clearfix">
                  <button type="submit" name="update-pass" class="btn btn-danger pull-right">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
