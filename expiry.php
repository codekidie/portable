<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   $admin_id =  $_SESSION['admin_id'] ;
   $id = $_GET['id'];
  
   $products = find_by_sql("SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.admin_id,p.date,p.expiry_date,c.name AS categorie,m.file_name AS image  FROM products p LEFT JOIN categories c ON c.id = p.categorie_id  LEFT JOIN media m ON m.id = p.media_id WHERE  p.expiry_date >= DATE(now()) AND  p.expiry_date <= DATE_ADD(DATE(now()), INTERVAL 1 WEEK) AND p.admin_id = '{$admin_id}' AND p.id='{$id}' ORDER BY p.id ASC");

?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
  
        </div>
        <div class="panel-body">
          <table class="table table-bordered" id="tb">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Saleing Price </th>
                <th class="text-center" style="width: 10%;"> Expiry Date </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
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
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['expiry_date']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
               
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
