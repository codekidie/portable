<?php
  $page_title = 'Return Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id  =  $_SESSION['admin_id'] ;
  $return_id =  $_GET['id'] ;

  $all_products = find_by_sql("SELECT * FROM products WHERE admin_id = '{$admin_id}'");
  $all_returned_products = find_by_sql("SELECT ru.id as id, 
                                              ru.name as ru_name,
                                               ru.email as ru_email,
                                               ru.phone as ru_phone,
                                               ru.comment as ru_comment,
                                               ru.replace_product as ru_rp,
                                               ru.reason as ru_reason,
                                               ru.quantity as ru_quantity,
                                               p.name as p_name FROM return_product ru LEFT JOIN products p ON ru.product_id = p.id WHERE p.admin_id = '{$admin_id}'  AND ru.id = '{$return_id}' GROUP BY ru.product_id");

 


?>
<?php
 if(isset($_POST['submit'])){

     $p_id        = remove_junk($db->escape($_POST['product_id']));
     $p_name      = remove_junk($db->escape($_POST['name']));
     $p_qty       = remove_junk($db->escape($_POST['qty']));
     $p_email     = remove_junk($db->escape($_POST['email']));
     $p_phone     = remove_junk($db->escape($_POST['phone']));
     $p_reason    = remove_junk($db->escape($_POST['reason']));
     $p_comment   = remove_junk($db->escape($_POST['comment']));
     $p_replace   = remove_junk($db->escape($_POST['replace']));

    

   
     $date    = make_date();
     $query  = "UPDATE return_product  SET product_id='{$p_id}',name='{$p_name}',email='{$p_email}',phone ='{$p_phone}',comment='{$p_comment}',replace_product= '{$p_replace}',reason='{$p_reason}',quantity='{$p_qty}',admin_id='{$admin_id}' WHERE id='{$_POST['id']}'";
   
     if($db->query($query)){
       $session->msg('s',"Editing Product Return Success");
       redirect('add_return_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to edit return product!');
       redirect('add_return_product.php', false);
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
            <span>Editing Returned Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                  <input type="hidden" name="id" value="<?php echo $all_returned_products[0]['id']; ?>">
                   <i class="pe-7s-note2"></i>
                  </span>
                    <select name="product_id"  class="form-control" >
                      <?php foreach ($all_products as $p): ?>
                        <?php if ($all_returned_products[0]['p_name'] == $p['name']): ?>
                          <option value="<?php echo $p['id'] ?>" selected><?php echo $p['name']; ?></option>
                        <?php else: ?>
                          <option value="<?php echo $p['id'] ?>"><?php echo $p['name']; ?></option>
                        
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
               </div>
              </div>

              

              <div class="form-group">
                  <div class="row">
                        <div class="col-md-6">
                        <label for="">Reason</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control">
                              <?php echo $all_returned_products[0]['ru_reason']; ?>
                            </textarea>
                            <hr>
                            <label for="">Replace Product</label>
                            <select name="replace" class="form-control">
                            <?php if ($all_returned_products[0]['ru_rp'] == "Yes"): ?>
                               <option value="Yes" selected="">Yes</option>
                               <option value="No">No</option>
                            <?php else: ?>   
                              <option value="Yes">Yes</option>
                               <option value="No" selected>No</option>
                            <?php endif ?>
                                
                            </select>
                        </div>
                         <div class="col-md-6">
                          <label for="">Quantity</label>
                           <input type="text" name="qty" class="form-control" value="<?php echo $all_returned_products[0]['ru_quantity']; ?>"  placeholder="">
                            <hr>
                           <label for="">Full Name</label>
                           <input type="text" name="name" class="form-control" value="<?php echo $all_returned_products[0]['ru_name']; ?>" placeholder="Full name">
                            <hr>
                           <label for="">Email</label>
                           <input type="email"  name="email" class="form-control" value="<?php echo $all_returned_products[0]['ru_email']; ?>"   placeholder="Email">
                            <hr>

                            <label for="">Phone</label>
                            <input type="text"  name="phone" value="<?php echo $all_returned_products[0]['ru_phone']; ?>"  class="form-control" placeholder="Phone">

                            
                        </div>
                  </div>

                 
              </div>      
              <div class="form-group">
              <label for="">Comment</label>
                  <textarea name="comment" id="" cols="30" rows="10" class="form-control"><?php echo $all_returned_products[0]['ru_comment']; ?> </textarea>
              </div>
              

         
              <button type="submit" name="submit" class="btn btn-danger">Submit</button>
          </form>
          
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
