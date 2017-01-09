<?php  
    
  require_once('includes/load.php');
  $admin_id =  $_SESSION['admin_id'] ;
  $year = date('Y');
  $month = date('m');
   $all_qty = find_by_sql("SELECT * FROM items WHERE admin_id = '{$admin_id}'");
?>

  <h1>Daily Sales Report</h1>    
  <table  style="width:100%;">
      <thead>
        <tr>
          <th style="width: 50px;padding:15px;">#</th>
          <th style="width: 50px;padding:15px;"> Product name </th>
          <th style="width: 50px;padding:15px;"> Quantity Instocks </th>
       </tr>
      </thead>
     <tbody>
       <?php foreach ($all_qty as $sale):?>
            <?php if (!empty($sale['item_name'])): ?>
                   <tr>
                     <td style="width: 50px;padding:15px;"><?php echo count_id();?></td>
                     <td style="width: 50px;padding:15px;"><?php echo remove_junk($sale['item_name']); ?></td>
                     <td style="width: 50px;padding:15px;"><?php echo (int)$sale['quantity']; ?></td>
                   </tr>
            <?php endif ?>
       <?php endforeach;?>
     </tbody>
   </table>
