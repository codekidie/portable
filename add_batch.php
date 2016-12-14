<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;

?>
<?php
 if(isset($_POST['add_batch'])){
  
     $batch  = remove_junk($db->escape($_POST['batch']));
     $admin_id =  $_SESSION['admin_id'] ;
    
   

   
     $date    = make_date();
     $query  = "INSERT INTO batch (";
     $query .=" name,admin_id ";
     $query .=") VALUES (";
     $query .=" '{$batch}', '{$admin_id}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Batch added ");
       redirect('product.php', false);
     } else {
       $session->msg('d',' Sorry failed to add batch!');
       redirect('product.php', false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Add New Batch</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="pe-7s-note2"></i>
                  </span>
                  <input type="text" class="form-control" name="batch" placeholder="Batch Name">
               </div>
              </div>
            <button type="submit" name="add_batch" class="btn btn-danger">Add Batch</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
