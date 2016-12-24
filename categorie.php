<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;
  
  $all_categories = find_by_sql("SELECT * FROM categories WHERE admin_id = '{$admin_id}'");
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));

   if(empty($errors)){
      $sql  = "INSERT INTO categories (admin_id,name)";
      $sql .= " VALUES ('{$admin_id}','{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added Categorie");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
    <script src="libs/js/jquery.confirm.js"></script>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <i class="pe-7s-note2"></i>
            <span>Add New Categories</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="categorie.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Categorie Name">
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Add category</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
            <i class="pe-7s-note2"></i>
          <span>All Categories</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categories</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="pe-7s-edit"></span>
                        </a>
                        <!-- delete_categorie.php?id=<?php //echo (int)$cat['id'];?> -->
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger complexConfirm">
                          <span class="pe-7s-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>

  <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script type="text/javascript">
            $(".complexConfirm").confirm({
                title:"Delete confirmation",
                text:"Are you sure you want to delete?",
                confirm: function(button) {
                  var href = $(button).attr("href");
                  window.location.replace(href);
                },
                cancel: function(button) {
                      alert("You aborted the operation.");
                },
                confirmButton: "Yes I am",
                cancelButton: "No"
            });
    </script>

 
  <?php include_once('layouts/footer.php'); ?>
