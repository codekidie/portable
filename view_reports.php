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
<h1>Overall Reports</h1>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="pe-7s-date"></span>
            <span>Monthly Sales</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity sold</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="pe-7s-cash"></span>
            <span>Daily Sales</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity sold</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($dsales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Returned Stocks</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                    <th>Product Name</th><th>Full Name</th><th>email</th><th>phone</th><th>comment</th><th>replace product</th><th>reason</th><th>quantity</th>
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
                </tr> 
                  
                 <?php endforeach ?>
              </tbody>
            </table>
         </div>
        </div>
      </div>
  </div>


<?php include_once('layouts/footer.php'); ?>