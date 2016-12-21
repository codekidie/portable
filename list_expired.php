<?php
  $page_title = 'View Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
 $year = date('Y');
 $month = date('m');
 $admin_id =  $_SESSION['admin_id'] ;
 $sales = monthlySales($year,$admin_id);
 $dsales = dailySales($year,$month,$admin_id);

 $all_qty = find_by_sql("SELECT * FROM items WHERE admin_id = '{$admin_id}'");


 $all_products = find_by_sql("SELECT * FROM products WHERE admin_id = '{$admin_id}'");
 $all_returned_products = find_by_sql("SELECT  ru.name as ru_name,
                                               ru.email as ru_email,
                                               ru.phone as ru_phone,
                                               ru.comment as ru_comment,
                                               ru.replace_product as ru_rp,
                                               ru.reason as ru_reason,
                                               ru.quantity as ru_quantity,
                                               p.name as p_name FROM return_product ru LEFT JOIN products p ON ru.product_id = p.id WHERE p.admin_id = '{$admin_id}' GROUP BY ru.product_id");




?>
<?php include_once('layouts/header.php'); ?>

<?php   
  $expire_products     =  getExpiringProductsLogs($admin_id);
  ?>
   <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Expiring Products</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Date Expired</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($expire_products as $exs): ?>
                    <tr>
                         <td><?php echo $exs['name']; ?></td>     
                         <td><?php echo $exs['expiry_date']; ?></td>     
                    </tr>           
                  <?php endforeach ?>
                 
              </tbody>
            </table>

         </div>
        </div>
      </div>
  </div>
                     

<?php include_once('layouts/footer.php'); ?>
