<?php
  $page_title = 'Return Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $admin_id =  $_SESSION['admin_id'] ;

  $all_products = find_by_sql("SELECT * FROM purchase_order WHERE admin_id = '{$admin_id}'");
 

?>
<?php
 if(isset($_POST['submit'])){

     $sup_name        = remove_junk($db->escape($_POST['sup_name']));
     $sup_address        = remove_junk($db->escape($_POST['sup_address']));
     $sup_town        = remove_junk($db->escape($_POST['sup_town']));
     $sup_country        = remove_junk($db->escape($_POST['sup_country']));
     $sup_postcode        = remove_junk($db->escape($_POST['sup_postcode']));
     $buy_name        = remove_junk($db->escape($_POST['buy_name']));
     $buy_address        = remove_junk($db->escape($_POST['buy_address']));
     $buy_town        = remove_junk($db->escape($_POST['buy_town']));
     $buy_country        = remove_junk($db->escape($_POST['buy_country']));
     $buy_postcode        = remove_junk($db->escape($_POST['buy_postcode']));
     $po_no        = remove_junk($db->escape($_POST['po_no']));
     $po_date        = remove_junk($db->escape($_POST['po_date']));
     $quantity        = remove_junk($db->escape($_POST['quantity']));
     $description        = remove_junk($db->escape($_POST['description']));
     $unit_price        = remove_junk($db->escape($_POST['unit_price']));
     $amount        = remove_junk($db->escape($_POST['amount']));
     $delivery_address        = remove_junk($db->escape($_POST['delivery_address']));
     $street_address        = remove_junk($db->escape($_POST['street_address']));
     $town        = remove_junk($db->escape($_POST['town']));
     $country        = remove_junk($db->escape($_POST['country']));
     $post_code        = remove_junk($db->escape($_POST['post_code']));
     $authorised_by        = remove_junk($db->escape($_POST['authorised_by']));
     $delivery_date        = remove_junk($db->escape($_POST['delivery_date']));
     $payment_terms        = remove_junk($db->escape($_POST['payment_terms']));
     $date    = make_date();

     $query  = "INSERT INTO purchase_order (";
     $query .=" suppliername,supplier_address,supplier_town,supplier_country,supplier_postcode,buyername,buyer_address,buyer_town,buyer_country,buyer_postcode,po_no,po_date,quantity,description,unit_price,amount,delivery_address,street_address,town,country,postcode,deliverydate,terms,authorised_by,date_created,admin_id";
     $query .=") VALUES (";
     $query .=" '{$sup_name}', '{$sup_address}', '{$sup_town}', '{$sup_country}', '{$sup_postcode}', '{$buy_name}', '{$buy_address}','{$buy_town}','{$buy_country}','{$buy_postcode}','{$po_no}','{$po_date}','{$quantity}','{$description}','{$unit_price}','{$amount}','{$delivery_address}','{$street_address}','{$town}','{$country}','{$post_code}','{$delivery_date}','{$payment_terms}','{$authorised_by}','{$date}','{$admin_id}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Purchase Order Success");
       redirect('add_purchase_order.php', false);
     } else {
       $session->msg('d',' Sorry failed to purchase order!');
       redirect('add_purchase_order.php', false);
     }


 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="pe-7s-cart"></span>
            <span>Add Purchase Order</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">              
              <div class="form-group">
                  <div class="row">
                         <div class="col-md-6">
                           <label for="">Supplier Name</label>
                           <input type="text" name="sup_name" class="form-control" placeholder="">   
                           <label for="">Street Address</label>
                           <input type="text" name="sup_address" class="form-control" placeholder="">   

                           <label for="">Town</label>
                           <input type="text" name="sup_town" class="form-control" placeholder="">  

                           <label for="">Country</label>
                           <input type="text" name="sup_country" class="form-control" placeholder="">

                           <label for="">Postcode</label>
                           <input type="text" name="sup_postcode" class="form-control" placeholder="">

                           <label for="">Po no.</label>
                           <input type="text" name="po_no" class="form-control" placeholder="">                             
                        </div>

                         <div class="col-md-6">
                           <label for="">Buyer Name</label>
                           <input type="text" name="buy_name" class="form-control" placeholder="">   
                           <label for="">Street Address</label>
                           <input type="text" name="buy_address" class="form-control" placeholder="">   

                           <label for="">Town</label>
                           <input type="text" name="buy_town" class="form-control" placeholder="">  

                           <label for="">Country</label>
                           <input type="text" name="buy_country" class="form-control" placeholder="">

                           <label for="">Postcode</label>
                           <input type="text" name="buy_postcode" class="form-control" placeholder="">

                           <label for="">Po Date</label>
                           <input type="date" name="po_date" class="form-control" placeholder="">                             
                        </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                           
                           <label for="">Quantity</label>
                           <input type="text" name="quantity" class="form-control" placeholder="">   
                           
                           <label for="">Description</label>
                           <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                           
                           <label for="">Unit Price</label>
                           <input type="text" name="unit_price" class="form-control" placeholder="">  

                           <label for="">Amount</label>
                           <input type="text" name="amount" class="form-control" placeholder="">

                                                     
                        </div>
                  </div>
                  <hr>
                  <div class="row">
                     <div class="col-md-6">
                           <label for="">Delivery Address</label>
                           <input type="text" name="delivery_address" class="form-control" placeholder="">  

                           <label for="">Street Address</label>
                           <input type="text" name="street_address" class="form-control" placeholder="">  

                           <label for="">Town/City</label>
                           <input type="text" name="town" class="form-control" placeholder="">  

                            <label for="">Country</label>
                           <input type="text" name="country" class="form-control" placeholder="">  

                           <label for="">Postcode</label>
                           <input type="text" name="post_code" class="form-control" placeholder=""> 

                           <label for="">Authorised By</label>
                           <input type="text" name="authorised_by" class="form-control" placeholder="">  
                      </div>
                      <div class="col-md-6">
                           <label for="">Delivery Date</label>
                           <input type="date" name="delivery_date" class="form-control" placeholder="">  

                           <label for="">Payment Terms</label>
                           <input type="text" name="payment_terms" class="form-control" placeholder="">  
                      </div>
                  </div>

                 
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
            <span>Listing Purchase Orders</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                    <th>Supplier Name</th><th>supplier address</th><th>supplier town</th><th>supplier country</th><th>supplier postcode</th><th>buyer name</th><th>buyer address</th><th>buyer town</th><th>buyer country</th><th>buyer postcode</th><th>po no</th><th>po date</th><th>quantity</th><th>description</th><th>unit price</th><th>amount</th><th>delivery address</th><th>street address</th><th>town</th><th>country</th><th>postcode</th><th>delivery date</th><th>terms</th><th>authorised by</th><th>Date Added</th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach ($all_products as $ar): ?>
                <tr>

                  <td><?php echo $ar['suppliername']; ?></td>
                  <td><?php echo $ar['supplier_address']; ?></td>
                  <td><?php echo $ar['supplier_town']; ?></td>
                  <td><?php echo $ar['supplier_country']; ?></td>
                  <td><?php echo $ar['supplier_postcode']; ?></td>
                  <td><?php echo $ar['buyername']; ?></td>
                  <td><?php echo $ar['buyer_address']; ?></td>
                  <td><?php echo $ar['buyer_town']; ?></td>
                  <td><?php echo $ar['buyer_country']; ?></td>
                  <td><?php echo $ar['buyer_postcode']; ?></td>
                  <td><?php echo $ar['po_no']; ?></td>
                  <td><?php echo $ar['po_date']; ?></td>
                  <td><?php echo $ar['quantity']; ?></td>
                  <td><?php echo $ar['description']; ?></td>
                  <td><?php echo $ar['unit_price']; ?></td>
                  <td><?php echo $ar['amount']; ?></td>
                  <td><?php echo $ar['delivery_address']; ?></td>
                  <td><?php echo $ar['street_address']; ?></td>
                  <td><?php echo $ar['town']; ?></td>
                  <td><?php echo $ar['country']; ?></td>
                  <td><?php echo $ar['postcode']; ?></td>
                  <td><?php echo $ar['deliverydate']; ?></td>
                  <td><?php echo $ar['terms']; ?></td>
                  <td><?php echo $ar['authorised_by']; ?></td>
                  <td><?php echo $ar['date_created']; ?></td>
                </tr> 
                  
                 <?php endforeach ?>
              </tbody>
            </table>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
