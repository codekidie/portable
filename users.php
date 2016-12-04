<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
//pull out all user form database
  $admin_id =  $_SESSION['admin_id'] ;
  $all_users = find_by_admin_id($admin_id);
  $all_privilege = find_by_sql("SELECT * FROM privilege p LEFT JOIN users u  ON p.user_id=u.id WHERE p.admin_id = '{$admin_id}' ORDER BY p.user_id");

  if (isset($_GET['delete_privilege_id'])) {
     $privilege_id =  $_GET['delete_privilege_id'];
     if (delete_by_id('privilege',$privilege_id)) {
            $session->msg('s',' Delete Success!');
            redirect('users.php', false);
     }else{
            $session->msg('d',' Sorry failed to delete user privilege!');
            redirect('users.php', false);
     }
  }

  if (isset($_POST['add_privilege'])) {
        
          $s_user_id   = $db->escape($_POST['user_id']);
          $s_privilege   = $db->escape($_POST['privilege']);
          $s_admin_id   = $db->escape($_POST['admin_id']);

          $sql  = "INSERT INTO privilege (";
          $sql .= " user_id,access,admin_id";
          $sql .= ") VALUES (";
          $sql .= "'{$s_user_id}','{$s_privilege}','{$s_admin_id}'";
          $sql .= ")";

          if($db->query($sql)){
            update_product_qty($s_qty,$p_id);
            $session->msg('s',"Privilege added. ");
            redirect('users.php', false);
          } else {
            $session->msg('d',' Sorry failed to add privilege!');
            redirect('users.php', false);
          }
      
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
         <i class="pe-7s-user"></i>
          <span>Users</span>
       </strong>
         <a href="add_user.php" class="btn btn-info pull-right">Add New User</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Name </th>
            <th>Username</th>
            <th class="text-center" style="width: 10%;">Status</th>
            <th style="width: 20%;">Last Login</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="pe-7s-edit"></i>
               </a>
                <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                  <i class="pe-7s-trash"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
             <i class="pe-7s-user"></i>
             <span>Privileges</span>
         </strong>
      </div>
     <div class="panel-body">
          <div class="col-md-4">
            <form action="" method="POST">
              <div class="form-group">
                  <label for="">Users</label>
                  <select name="user_id" class="form-control">
                  <?php foreach ($all_users as $a): ?>
                    <option value="<?php echo $a['id']; ?>"><?php echo $a['name']; ?></option>                  
                  <?php endforeach ?>
                  </select>
              </div>

              <div class="form-group">
                  <label for="">Assign Privilege</label>
                  <select name="privilege" class="form-control">
                  <option value="Category">Category</option>
                  <option value="Manage_Product">Manage Product</option>
                  <option value="Add_Product">Add Product</option>
                  <option value="Manage_Sales">Manage Sales</option>
                  <option value="Add_Sales">Add Sales</option>
                  <option value="Sales_by_dates">Sales by dates</option>
                  <option value="Monthly_Sales">Monthly Sales</option>
                  <option value="Daily_Sales">Daily Sales</option>
                  <option value="Media">Media</option>
                  <option value="Return_Product">Return Product</option>
                  <option value="Purchase_Order">Purchase Order</option>
                  <option value="View_Reports">View Reports</option>

                </select>
              </div>

              <div class="form-group">
              <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                <input type="submit" value="Submit" name="add_privilege">
              </div>
            
                
            </form>
          </div>
          <div class="col-md-8">
           
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name </th>
                  <th>Privilege</th>
                  <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($all_privilege as $p): ?>
                <tr>
                 <td><?php echo $p['name'];?></td>
                 <td><?php echo str_replace('_', ' ',$p['access']);?></td>
                 <td class="text-center">
                   <div class="btn-group">
                     
                      <a href="users.php?delete_privilege_id=<?php echo (int)$p['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                        <i class="pe-7s-trash"></i>
                      </a>
                      </div>
                 </td>
                </tr>
              <?php endforeach;?>
             </tbody>
           </table>
          </div>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
