<?php
  $page_title = 'Add Batch';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;

  $all_products = find_by_sql("SELECT * FROM products WHERE admin_id = '{$admin_id}' Group By name");

?>
<?php
 if(isset($_POST['add_batch'])){
     $item_name  = remove_junk($db->escape($_POST['item_name']));  
     $get_product = find_by_sql("SELECT id FROM products WHERE admin_id = '{$admin_id}' AND name = '{$item_name}' LIMIT 1");

     foreach ($get_product as $g) {
        $product_id      = $g['id'];
     }
     $batch  = remove_junk($db->escape($_POST['batch']));  
     $quantity = $_POST['quantity']; 
     $expiry_date = $_POST['saleing-expiry-date']; 

     $date    = make_date();
     $getbatch = find_by_sql("SELECT * FROM items WHERE admin_id = '{$admin_id}' AND batch = '{$batch}' ");
    
    // Batch exist in the database
    if (!empty($getbatch)) {
            $session->msg('d',' Sorry failed to add batch batch already exist in the database!');
           redirect('add_batch.php', false);
    }else{
       $query  = "INSERT INTO items (";
       $query .=" product_id,admin_id,item_name,batch,expiry_date,quantity ";
       $query .=") VALUES (";
       $query .=" '$product_id', '{$admin_id}','{$item_name}','{$batch}','{$expiry_date}','{$quantity}'";
       $query .=")";
         if($db->query($query)){
           $session->msg('s',"Batch added ");
           redirect('add_batch.php', false);
         } else {
           $session->msg('d',' Sorry failed to add batch!');
           redirect('add_batch.php', false);
         }
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
            <span>Add Quantity</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="" class="clearfix">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Product name</label>
                      <select class="form-control" name="item_name">
                           <?php  foreach ($all_products as $p): ?>
                                  <option value="<?php echo $p['name']; ?>"><?php echo $p['name'] ?></option>
                           <?php endforeach; ?>
                        </select>
                  </div>
             </div>
                 <div class="col-md-12">
                  <label for="">Expiry Date</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="pe-7s-date"></i>
                      </span>
                      <input type="date" class="form-control" name="saleing-expiry-date" placeholder="Expiry Date" required="required">
                   </div>
                  </div>
                   <div class="col-md-12">
                    <label for="">Batch</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="pe-7s-cash"></i>
                        </span>
                        <input type="text" class="form-control" name="batch" placeholder="Batch" required="required">
                     </div>
                    </div>

                    <div class="col-md-12">
                    <label for="">Quantity</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="pe-7s-cart"></i>
                        </span>
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity" required="required">
                     </div>
                    </div>
                   <div class="col-md-12">
                   <hr>
                     <button type="submit" name="add_batch" class="btn btn-danger">Add Quantity</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
