<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   $admin_id =  $_SESSION['admin_id'] ;
  
   $products = find_by_sql("SELECT p.id,p.name as name,p.flavor,i.quantity,p.buy_price,i.expiry_date,i.batch,p.unit_of_measure,p.sale_price,p.media_id,p.admin_id,p.date,c.name AS categorie,m.file_name AS image  FROM products p LEFT JOIN categories c ON c.id = p.categorie_id  LEFT JOIN items i ON i.product_id = p.id LEFT JOIN media m ON m.id = p.media_id WHERE p.admin_id = '{$admin_id}' ORDER BY p.id ASC");


?>
<?php include_once('layouts/header.php'); ?>

<script src="libs/js/jquery.confirm.js"></script>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New Product</a>
         </div>
        </div>
        <div class="panel-body" style="overflow: auto;">
          <table class="table table-bordered" id="tb">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Flavor </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Saling Price </th>
                <th class="text-center" style="width: 10%;"> Expiry Date </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
                <th class="text-center" style="width: 10%;"> Unit Of Measure </th>
                <th class="text-center" style="width: 10%;"> Product Batch </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['flavor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['expiry_date']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['unit_of_measure']); ?></td>
                
                <td class="text-center"> <?php echo remove_junk($product['batch']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <i class="pe-7s-edit"></i>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger complexConfirm  btn-xs"  title="Delete" data-toggle="tooltip">
                      <i class="pe-7s-trash"></i>
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
