<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;

  $all_categories = find_by_sql("SELECT * FROM categories WHERE admin_id = '{$admin_id}'");
  $all_photo = find_by_sql("SELECT * FROM media WHERE admin_id = '{$admin_id}'");
  $all_batch = find_by_sql("SELECT * FROM batch WHERE admin_id = '{$admin_id}'");


?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     $unit_of_measure =  remove_junk($db->escape($_POST['unit_of_measure_num'])) .' '.remove_junk($db->escape($_POST['unit_of_measure'])); 

     $p_batch  = remove_junk($db->escape($_POST['batch']));
     $p_expiry_date  = remove_junk($db->escape($_POST['saleing-expiry-date']));

     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date,admin_id,expiry_date,batch,unit_of_measure";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}','{$admin_id}','{$p_expiry_date}','{$p_batch}','{$unit_of_measure}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="pe-7s-note2"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Product Photo</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="pe-7s-pen"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="pe-7s-cash"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="pe-7s-cash"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                    <label for="">Expiry Date</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="pe-7s-date"></i>
                        </span>
                        <input type="date" class="form-control" name="saleing-expiry-date" placeholder="Expiry Date" required="required">
                     </div>
                    </div>


                   <div class="col-md-4">
                    <label for="">Batch</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="pe-7s-settings"></i>
                        </span>
                        <select name="batch" class="form-control">
                            <?php foreach ($all_batch as $b): ?>
                                <option><?php echo $b['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                     </div>
                    </div>

                       <div class="col-md-4">
                        <label for="">Unit of Measure</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="pe-7s-graph"></i>
                            </span>
                            <input type="text" class="form-control" name="unit_of_measure_num" placeholder="Unit of Measure" required="required">

                              <select name="unit_of_measure" class="form-control" required="">
                                  <option> none </option> 
                                  <option> microgram </option> 
                                  <option> milligram </option>
                                  <option> carat </option> 
                                  <option> gram </option> 
                                  <option> kilogram </option> 
                                 <option>  metric ton </option> 
                                  <option> pound </option>
                                 <option>  nanometer </option> 
                                 <option>  millimeter </option>
                                 <option>  centimeter </option>
                                  <option> inch </option> 
                                  <option> foot </option> 
                                 <option>  yard </option> 
                                 <option>  meter  </option> 
                                  <option> kilometer </option> 
                                 <option>  khelter </option> 
                                 <option>  salt pan </option>
                                 <option>  mile </option> 
                                 <option>  visvia </option> 
                                <option>   megalight </option> 
                                  <option> light year </option> 
                                 <option>  parsec </option>
                                 <option>  Siriometer </option> 
                               <option>    kiloparsec </option>
                                <option>  Megaparsec </option>
                                 <option>  Gigaparsec</option>
                                <option>   Teraparsec </option>
                              </select>
                         </div>
                        </div>
                 </div>
              </div>

              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
