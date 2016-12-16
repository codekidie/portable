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
     $unit_of_measure =  remove_junk($db->escape($_POST['unit_of_measure'])); 
     $mode_of_selling =  remove_junk($db->escape($_POST['mode_of_selling'])); 



     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date,admin_id,unit_of_measure,mode_of_selling";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}','{$admin_id}','{$unit_of_measure}','{$mode_of_selling}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query) === TRUE){
          $all_products = find_by_sql("SELECT * FROM products");
          $products = end($all_products);

       $session->msg('s',"Product added ");
       $_SESSION['title'] = $p_name;
       $_SESSION['product_id'] = $products['id'];  


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

 // Code For Submition of item
 if (isset($_POST['add_item'])) {
     $p_id  = remove_junk($db->escape($_POST['item-id']));
     $p_title  = remove_junk($db->escape($_POST['item-title']));
     $p_batch  = remove_junk($db->escape($_POST['item-batch']));
     $p_exp  = remove_junk($db->escape($_POST['item-exp-date']));


      $query  = "INSERT INTO items (";
       $query .=" product_id, admin_id, item_name,batch, expiry_date";
       $query .=") VALUES (";
       $query .=" '{$p_id}','{$admin_id}', '{$p_title}', '{$p_batch}', '{$p_exp}'";
      $query .=")";
      $query .=" ON DUPLICATE KEY UPDATE item_name='{$p_title}'";
       if($db->query($query) === TRUE){
           $_SESSION['title'] = '';
           $_SESSION['product_id'] = '';  

           $session->msg('s',' Item Successfully Added!');  
           redirect('add_product.php', false);
       }else{

            $session->msg("d", "Failed to add  Item!");
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
    <?php 
    if (!empty($_SESSION['title'])): ?>
      <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Add Item</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                  <input type="hidden" class="form-control" name="item-id" value="<?php echo $_SESSION['product_id']; ?>">

                    <label for="">Item Name:</label>

                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="pe-7s-note2"></i>
                  </span>
                  <input type="text" class="form-control" name="item-title" value="<?php echo $_SESSION['title']; ?>" placeholder="Title">
               </div>
              </div>

               <div class="form-group">
                    <label for="">Batch # :</label>

                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="pe-7s-note2"></i>
                  </span>
                  <input type="number" class="form-control" name="item-batch" placeholder="Batch #">
               </div>
              </div>



              <div class="form-group">
                    <label for="">Expiry Date</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="pe-7s-date"></i>
                        </span>
                        <input type="date" class="form-control" name="item-exp-date" placeholder="Expiry Date" required="required">
                     </div>
                    </div>

              <button type="submit" name="add_item" class="btn btn-danger">Add</button>
          </form>
         </div>
        </div>
      </div>
    </div>
    <?php else: ?>  
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
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="pe-7s-cash"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                   </div>
                  </div>
               </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    

                       <div class="col-md-4">
                        <label for="">Unit of Measure</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="pe-7s-graph"></i>
                            </span>
                           

                              <select name="unit_of_measure" class="form-control" required="">
                                  <option> none </option> 
                                  <option> Liter </option> 
                                  <option> 1.5 Liter </option> 
                                  <option> 8oz </option> 
                                  <option> 12oz </option> 
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
                                 <option>  mile </option> 
                              </select>
                         </div>
                        </div>

                        <div class="col-md-4">
                        <label for="">Mode of Selling</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="pe-7s-graph"></i>
                            </span>
                           

                              <select name="mode_of_selling" class="form-control" required="">
                                  <option> none </option> 
                                  <option> piece </option> 
                                  <option> box </option> 
                                  <option> dozen </option> 
                                  <option> can </option> 
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
    <?php endif ?>

  </div>

<?php include_once('layouts/footer.php'); ?>
