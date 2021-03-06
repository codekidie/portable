<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php

$admin_id =  $_SESSION['admin_id'] ;

  $product = find_by_sql("SELECT  products.id, products.name,items.quantity,products.buy_price,products.sale_price,items.expiry_date,items.batch, products.unit_of_measure  FROM  products  LEFT JOIN items ON products.id = items.product_id  WHERE  products.id = '{$_GET['id']}' AND products.admin_id = '{$admin_id}'");



$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){



       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_id  = remove_junk($db->escape($_POST['product-id']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['buying-price']));
       $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
       $p_expiry_date  = remove_junk($db->escape($_POST['saleing-expiry-date']));
       $unit_of_measure = remove_junk($db->escape($_POST['unit_of_measure'])); 
       $p_batch  = remove_junk($db->escape($_POST['batch']));


       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['product-photo']));
       }
       $query1   = "UPDATE products SET";
       $query1  .=" name ='{$p_name}',  unit_of_measure ='{$unit_of_measure}', ";
       $query1  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}',expiry_date='{$p_expiry_date}' ";
       $query1  .=" WHERE id ='{$p_id}'";
       $result1 = $db->query($query1);


       $query   = "UPDATE items SET";
       $query  .=" batch = '{$p_batch}', ";
       $query  .=" quantity ='{$p_qty}', expiry_date='{$p_expiry_date}' ";
       $query  .=" WHERE product_id ='{$p_id}'";

       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$p_id, false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product[0]['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="pe-7s-cart"></i>
                  </span>
                    <input type="hidden" class="form-control" name="product-id" value="<?php echo remove_junk($product[0]['id']);?>">
                  <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product[0]['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                    <option value=""> Select a categorie</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value=""> No image</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="pe-7s-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product[0]['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Buying price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="pe-7s-cash"></i>
                      </span>
                      <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product[0]['buy_price']);?>">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="qty">Selling price</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="pe-7s-cash"></i>
                       </span>
                       <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product[0]['sale_price']);?>">
                       <span class="input-group-addon">.00</span>
                    </div>
                   </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                          <label for="">Expiry Date</label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="pe-7s-date"></i>
                              </span>
                              <input type="date" class="form-control" name="saleing-expiry-date" value="<?php echo remove_junk($product[0]['expiry_date']);?>" placeholder="Expiry Date" required="required">
                          </div>
                    </div>
                </div>
                  <div class="col-md-4">
                  <label for="">Batch</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="pe-7s-settings"></i>
                      </span>
                      <input type="text" class="form-control" name="batch" placeholder="Batch No." value="<?php echo remove_junk($product[0]['batch']);?>" required="required">
                   </div>
                  </div>

                    <div class="col-md-4">
                        <label for="">Unit of Measure</label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="pe-7s-graph"></i>
                            </span>
                            <input type="text" class="form-control" name="unit_of_measure" value="<?php echo remove_junk($product[0]['unit_of_measure']);?>" placeholder="Unit of Measure" required="required">
                         </div>
                        </div>
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
