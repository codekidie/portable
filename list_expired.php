<?php
  $page_title = 'View Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
 $admin_id =  $_SESSION['admin_id'] ;
?>
<?php include_once('layouts/header.php'); ?>

<?php   
  $expire_products     =  getExpiringProductsLogs($admin_id);
  ?>
  <div class="row">
        <form action="" method="POST" class="pull-right col-md-6 col-xs-12">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-btn">
                  <button type="submit"  name="submit" class="btn btn-primary">Search by Date</button>
                </span>
                <input type="date" id="sug_input" class="form-control"  name="sbd" style="height: 40px;"  placeholder="Search for product name">
             </div>
             <div id="result" class="list-group"></div>
          </div>
        </form>
  </div>
<?php 
if (isset($_POST['submit'])) {
      $sbd = find_by_sql("SELECT * FROM products LEFT JOIN items ON items.product_id = products.id WHERE items.admin_id = '{$admin_id}' AND items.expiry_date = '{$_POST['sbd']}'");
?>
      <div class="row">
          <div class="panel panel-default">
              <div class="panel-heading">
                <strong>
                  <span class="pe-7s-cart"></span>
                  <span>Search Results</span>
               </strong>
              </div>
              <div class="panel-body">
               <div class="col-md-12">
                  <table class="table" id="tb">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Date Expired</th>
                          <th>Batch</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sbd as $exs): ?>
                          <tr>
                               <td><?php echo $exs['name']; ?></td>     
                               <td><?php echo $exs['expiry_date']; ?></td>     
                               <td><?php echo $exs['batch']; ?></td>     
                          </tr>           
                        <?php endforeach ?>
                       
                    </tbody>
                  </table>

               </div>
              </div>
            </div>
        </div>
<?php } ?>
   
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
            <table class="table" id="tb2">
              <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Date Expired</th>
                    <th>Batch</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($expire_products as $exs): ?>
                    <tr>
                         <td><?php echo $exs['name']; ?></td>     
                         <td><?php echo $exs['expiry_date']; ?></td>     
                         <td><?php echo $exs['batch']; ?></td>     
                    </tr>           
                  <?php endforeach ?>
                 
              </tbody>
            </table>

         </div>
        </div>
      </div>
  </div>
                     

<?php include_once('layouts/footer.php'); ?>
