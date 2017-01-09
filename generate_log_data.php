<?php  
    
  require_once('includes/load.php');
  $admin_id =  $_SESSION['admin_id'] ;
  $year = date('Y');
  $month = date('m');
   $expire_products     =  getExpiringProductsLogs($admin_id);
   $minimumstocks       =  getMinimumProductsHistory($admin_id); 
  $expire_items        =  getExpiringItemLogs($admin_id);

?>
<h2>Products Expiring Logs</h2>
    <hr>
  <table style="width:100%;">
    <thead>
      <tr>
          <th></th>
      </tr>
    </thead>
    <tbody>

          <?php foreach ($expire_items as $exs): ?>
          <tr>
               <td >Batch : <?php echo $exs['batch']; ?>  , Product <?php echo $exs['item_name'];  ?> , Expiring at <?php echo $exs['expiry_date']; ?></td>     
          </tr>           
        <?php endforeach ?>
    </tbody>
  </table>
    
    <h2>Minimum Level Stocks Logs</h2>
    <hr>
    <table style="width: 100%;">
    <thead>
      <tr>
          <th></th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($minimumstocks as $mss): ?>
          <tr>
              <td >Product <?php echo $mss['item_name']; ?> Stocks Reach Minimum Level <?php echo $mss['quantity']; ?></td>
          </tr>    
        <?php endforeach ?>
    </tbody>
  </table>

