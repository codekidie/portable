<?php  
    
  require_once('includes/load.php');
  $admin_id =  $_SESSION['admin_id'] ;
  $year = date('Y');
  $month = date('m');

  $dsales = dailySales($year,$month,$admin_id);

  echo  '
  
<h1>Daily Sales Report</h1> 
   <table style="width:100%;">
        <thead>
          <tr>
            <th class="text-center"  style="width: 50px;padding:15px;">#</th>
            <th> Product name </th>
            <th class="text-center"  style="width: 50px;padding:15px;"> Quantity sold</th>
            <th class="text-center"  style="width: 50px;padding:15px;"> Total </th>
            <th class="text-center"  style="width: 50px;padding:15px;"> Date </th>
         </tr>
        </thead>
       <tbody>';
?>      
         <?php foreach ($dsales as $sale):?>
              <?php if (!empty($sale['name'])): ?>

           <tr>
           <td class="text-center"  style="width: 50px;padding:15px;"><?php echo count_id();?></td>
           <td  style="width: 50px;padding:15px;"><?php echo remove_junk($sale['name']); ?></td>
           <td class="text-center"  style="width: 50px;padding:15px;"><?php echo (int)$sale['qty']; ?></td>
           <td class="text-center"  style="width: 50px;padding:15px;"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
           <td class="text-center"  style="width: 50px;padding:15px;"><?php echo $sale['date']; ?></td>
         </tr>
       <?php endif ?>
         <?php endforeach;?>
       </tbody>
     </table>  