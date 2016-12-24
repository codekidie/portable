<?php
  $page_title = 'Return Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;

  $all_products = find_by_sql("SELECT * FROM products WHERE admin_id = '{$admin_id}'");
  $all_returned_products = find_by_sql("SELECT ru.id as id, 
                                              ru.name as ru_name,
                                               ru.email as ru_email,
                                               ru.phone as ru_phone,
                                               ru.comment as ru_comment,
                                               ru.replace_product as ru_rp,
                                               ru.reason as ru_reason,
                                               ru.quantity as ru_quantity,
                                               p.name as p_name FROM return_product ru LEFT JOIN products p ON ru.product_id = p.id WHERE p.admin_id = '{$admin_id}' GROUP BY ru.product_id");

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
     $query  = "INSERT INTO return_product (";
     $query .=" product_id,name,email,phone,comment,replace_product,reason,quantity,admin_id";
     $query .=") VALUES (";
     $query .=" '{$p_id}', '{$p_name}', '{$p_email}', '{$p_phone}', '{$p_comment}', '{$p_replace}', '{$p_reason}','{$p_qty}','{$admin_id}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product Return Success");
       redirect('add_return_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to return product!');
       redirect('add_return_product.php', false);
     }


 }

?>
<?php include_once('layouts/header.php'); ?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="libs/js/jquery.confirm.js"></script>
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
            <span>Return a Product</span>
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
                    <select name="product_id"  class="form-control" >
                      <?php foreach ($all_products as $p): ?>
                          <option value="<?php echo $p['id'] ?>"><?php echo $p['name']; ?></option>
                      <?php endforeach ?>
                    </select>
               </div>
              </div>

              

              <div class="form-group">
                  <div class="row">
                        <div class="col-md-6">
                        <label for="">Reason</label>
                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"></textarea>
                            <hr>
                            <label for="">Replace Product</label>
                            <select name="replace" class="form-control">
                                 <option value="Yes">Yes</option>
                                 <option value="No">No</option>
                            </select>
                        </div>
                         <div class="col-md-6">
                          <label for="">Quantity</label>
                           <input type="text" name="qty" class="form-control" placeholder="">
                            <hr>
                           <label for="">Full Name</label>
                           <input type="text" name="name" class="form-control" placeholder="Full name">
                            <hr>
                           <label for="">Email</label>
                           <input type="email"  name="email" class="form-control" placeholder="Email">
                            <hr>

                            <label for="">Phone</label>
                            <input type="text"  name="phone" class="form-control" placeholder="Phone">

                            
                        </div>
                  </div>

                 
              </div>      
              <div class="form-group">
              <label for="">Comment</label>
                  <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
              </div>
              

         
              <button type="submit" name="submit" class="btn btn-danger">Submit</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Listing Returned Products</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
            <table class="table" id="tb">
              <thead>
                <tr>
                    <th>Name</th><th>Client Name</th><th>email</th><th>phone</th><th>comment</th><th>replace product</th><th>reason</th><th>quantity</th><th>Actions</th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach ($all_returned_products as $ar): ?>
                <tr>

                  <td><?php echo $ar['p_name']; ?></td>
                  <td><?php echo $ar['ru_name']; ?></td>
                  <td><?php echo $ar['ru_email']; ?></td>
                  <td><?php echo $ar['ru_phone']; ?></td>
                  <td><?php echo $ar['ru_comment']; ?></td>
                  <td><?php echo $ar['ru_rp']; ?></td>
                  <td><?php echo $ar['ru_reason']; ?></td>
                  <td><?php echo $ar['ru_quantity']; ?></td>
                  <td>  <a href="edit_return_product.php?id=<?php echo (int)$ar['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                  <i class="pe-7s-edit"></i>
               </a>
                <a href="delete_return.php?id=<?php echo (int)$ar['id'];?>" class="btn btn-xs btn-danger complexConfirm" data-toggle="tooltip" title="Remove">
                  <i class="pe-7s-trash"></i>
                </a></td>
                </tr> 
                  
                 <?php endforeach ?>
              </tbody>
            </table>
         </div>
        </div>
      </div>
  </div>

 <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
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
