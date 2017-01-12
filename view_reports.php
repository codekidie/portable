<?php
  $page_title = 'View Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
 $year = date('Y');
 $month = date('m');
 $admin_id =  $_SESSION['admin_id'] ;
 $sales = monthlySales($month,$admin_id);
 $dsales = dailySales($year,$month,$admin_id);

 $all_qty = find_by_sql("SELECT * FROM items LEFT JOIN products ON products.id = items.product_id WHERE items.admin_id = '{$admin_id}'");


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
      <div class="col-md-12">
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Monthly Sales</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Daily Sales</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Product Quantity</a></li>
                            <li><a href="#tab4default" data-toggle="tab">Returned Stocks</a></li>
                            <li><a href="#tab5default" data-toggle="tab">Log of Notifications</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                  <div class="panel-heading clearfix">
                                    <strong>
                                      <span class="pe-7s-date"></span>
                                      <span>Monthly Sales</span>
                                    </strong>
                                  </div>
                                  <div class="panel-body">
                                  <a href="generate_monthly.php" class="btn btn-success btn-md pull-right" style="padding:10px;margin:10px;">Print Report</a>

                                  <br style="clear: both;">
                                       <input type="date" id="date_data" class="form-control">
                                        <hr>
                                      <table class="table table-bordered table-striped" id="tbd">
                                        <thead>
                                          <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th> Product name </th>
                                            <th> Flavor </th>
                                            <th class="text-center" style="width: 15%;"> Quantity sold</th>
                                            <th class="text-center" style="width: 15%;"> Total </th>
                                         </tr>
                                        </thead>
                                       <tbody id="table-body">
                                         <?php foreach ($sales as $sale):?>
                                         <tr>
                                           <td class="text-center"><?php echo count_id();?></td>
                                           <td><?php echo remove_junk($sale['name']); ?></td>
                                           <td><?php echo remove_junk($sale['flavor']); ?></td>
                                           <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                                           <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
                                         </tr>
                                         <?php endforeach;?>
                                       </tbody>
                                     </table>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                               <div class="col-md-12">
                                  <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                      <strong>
                                        <span class="pe-7s-cash"></span>
                                        <span>Daily Sales</span>
                                      </strong>
                                    </div>
                                    <div class="panel-body">
                                       <a href="generate_daily.php" class="btn btn-success btn-md pull-right" style="padding:10px;margin:10px;">Print Report</a>
                                       <br style="clear: both;">
                                      <table class="table table-bordered table-striped" id="tb2">
                                        <thead>
                                          <tr>
                                            <th class="text-center" style="width: 50px;">#</th>
                                            <th style="width: 15%;"> Product name </th>
                                            <th style="width: 15%;"> Flavor </th>
                                            <th class="text-center" style="width: 15%;"> Quantity sold</th>
                                            <th class="text-center" style="width: 15%;"> Total </th>
                                            <th class="text-center" style="width: 15%;"> Date </th>
                                         </tr>
                                        </thead>
                                       <tbody>
                                         <?php foreach ($dsales as $sale):?>
                                              <?php if (!empty($sale['name'])): ?>

                                         <tr>
                                           <td class="text-center"><?php echo count_id();?></td>
                                           <td><?php echo remove_junk($sale['name']); ?></td>
                                           <td><?php echo remove_junk($sale['flavor']); ?></td>
                                           <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                                           <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
                                           <td class="text-center"><?php echo $sale['date']; ?></td>
                                         </tr>
                                       <?php endif ?>
                                         <?php endforeach;?>
                                       </tbody>
                                     </table>
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="tab3default">
                           <div class="col-md-12">
                            <div class="panel panel-default">
                              <div class="panel-heading clearfix">
                                <strong>
                                  <span class="pe-7s-date"></span>
                                  <span>Product Quantity</span>
                                </strong>
                              </div>
                              <div class="panel-body">
                                 <a href="generate_product_qty.php" class="btn btn-success btn-md pull-right" style="padding:10px;margin:10px;">Print Report</a>
                                 <br style="clear: both;">

                                <table class="table table-bordered table-striped" id="tb3">
                                  <thead>
                                    <tr>
                                      <th class="text-center" style="width: 50px;">#</th>
                                      <th> Product name </th>
                                      <th> Flavor </th>
                                      <th class="text-center" style="width: 15%;"> Quantity Instocks </th>
                                   </tr>
                                  </thead>
                                 <tbody>
                                   <?php foreach ($all_qty as $sale):?>
                                        <?php if (!empty($sale['item_name'])): ?>
                                               <tr>
                                                 <td class="text-center"><?php echo count_id();?></td>
                                                 <td><?php echo remove_junk($sale['item_name']); ?></td>
                                                 <td><?php echo remove_junk($sale['flavor']); ?></td>
                                                 <td class="text-center"><?php echo (int)$sale['quantity']; ?></td>
                                               </tr>
                                        <?php endif ?>
                                   <?php endforeach;?>
                                 </tbody>
                               </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="tab4default">
                             <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <strong>
                                      <span class="pe-7s-cart"></span>
                                      <span>Returned Stocks</span>
                                   </strong>
                                  </div>
                                  <div class="panel-body">
                                   <div class="col-md-12">
                                      <a href="generate_return_stocks.php" class="btn btn-success btn-md pull-right" style="padding:10px;margin:10px;">Print Report</a>
                                      <br style="clear: both;">

                                      <table class="table" id="tb4">
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
                        <div class="tab-pane fade" id="tab5default">
                           <?php   
                              $expire_products     =  getExpiringProductsLogs($admin_id);
                              $minimumstocks       =  getMinimumProductsHistory($admin_id); 
                              $expire_items        =  getExpiringItemLogs($admin_id);

                            ?>
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <strong>
                                      <span class="pe-7s-cart"></span>
                                      <span>Log of Notifications</span>
                                   </strong>
                                  </div>
                                  <div class="panel-body">
                                   <div class="col-md-12">
                                     <a href="generate_log_of_notifications.php" class="btn btn-success btn-md pull-right" style="padding:10px;margin:10px;">Print Report</a>
                                      <br style="clear: both;">

                                        <center><h2>Products Expiring Logs</h2></center>
                                        <hr>
                                      <table class="table" id="tb5">
                                        <thead>
                                          <tr>
                                              <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                    
                                              <?php foreach ($expire_items as $exs): ?>
                                              <tr>
                                                   <td>Batch : <?php echo $exs['batch']; ?>  , Product <?php echo $exs['item_name'];  ?> <?php echo $exs['flavor']; ?>, Expiring at <?php echo $exs[5]; ?></td>     
                                              </tr>           
                                            <?php endforeach ?>
                                        </tbody>
                                      </table>
                                        <center><h2>Minimum Level Stocks Logs</h2></center>
                                        <hr>
                                        <table class="table" id="tb6">
                                        <thead>
                                          <tr>
                                              <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($minimumstocks as $mss): ?>
                                              <tr>
                                                  <td>Product <?php echo $mss['item_name']; ?> <?php echo $mss['flavor']; ?> Stocks Reach Minimum Level <?php echo $mss['quantity']; ?></td>
                                              </tr>    
                                            <?php endforeach ?>
                                        </tbody>
                                      </table>

                                   </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>



                     

<?php include_once('layouts/footer.php'); ?>
