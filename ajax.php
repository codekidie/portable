<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

<?php
 // Auto suggetion
    $html = '';
   if(isset($_POST['product_name']) && strlen($_POST['product_name']))
   {
     $products = find_product_by_title($_POST['product_name']);
     if($products){
        foreach ($products as $product):
           $html .= "<li class=\"list-group-item\">";
           $html .= $product['item_name'];
           $html .= "</li>";
         endforeach;
      } else {

        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'Not found';
        $html .= "</li>";

      }

      echo json_encode($html);
   }
 ?>
 <?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_title($product_title)){
        
        foreach ($results as $result) {

          $html .= "<tr>";

          $html .= "<td id=\"s_name\"><input type=\"hidden\" name=\"s_name[]\" value=\"{$result['name']}\" required>".$result['name']."</td>";

          $html .= "<td id=\"s_flavor\"><input type=\"hidden\" name=\"s_flavor[]\" value=\"{$result['flavor']}\" required>".$result['flavor']."</td>";

          $html .= "<input type=\"hidden\" name=\"s_id[]\" value=\"{$result['id']}\" required>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"price[]\" value=\"{$result['sale_price']}\" required>";
          $html  .= "</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"quantity[]\" value=\"1\" required>";
          $html  .= "</td>";
         
          $html  .= "<td><input type='text' name='mode_of_selling[]' class='form-control' value='{$result['mode_of_selling']}' readonly></td>";

          $html  .= "<td> <input type='text' name='unit_of_measure[]' class='form-control' value='{$result['unit_of_measure']}' readonly></td>";                    

          
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"batch[]\" value=\"{$result['batch']}\" readonly>";
          $html  .= "</td>";

          $html  .= '<td>
                <button type="button" class="removebutton" title="Remove this row">X</button>
            </td>';

           // $html  .= "<td>";
          $html  .= "<input type=\"hidden\" class=\"form-control\" name=\"total[]\" value=\"{$result['sale_price']}\" required>";
          // $html  .= "</td>";

          // $html  .= "<td>";
          // $html  .= "<button type=\"submit\" name=\"add_sale\" class=\"btn btn-primary\">Add sale</button>";
          // $html  .= "</td>";
          $html  .= "</tr>";


        }
    }

    echo json_encode($html);
  }
 ?>

  <?php
 // find all product by date
  if(isset($_POST['p_date']) && strlen($_POST['p_date']))
  {
     $sale_date = $_POST['p_date'];
     $admin_id =  $_SESSION['admin_id'] ;

    if($result = dateSales($sale_date,$admin_id)){
      // var_dump($results);
      // die();
          $html .= "<tr>";
          $html .= "<th>Product name</th>";
          $html .= "<th>Flavor</th>";
          $html .= "<th>Unit of measure</th>";
          $html .= "<th>Mode of selling</th>";
          $html .= "<th>Price </th>";
          $html .= "<th>Quantity </th>";

          $html  .= "</tr>";

      foreach ($result as $results) {
      
          $html .= "<tr>";
          $html .= "<td>".$results['name']."</td>";
          $html .= "<td>".$results['flavor']."</td>";
          $html .= "<td>".$results['unit_of_measure']."</td>";
          $html .= "<td>".$results['mode_of_selling']."</td>";
          $html .= "<td>".$results['sale_price']."</td>";
          $html .= "<td>".$results['quantity']."</td>";
          $html  .= "</tr>";
      }  
    }

    echo json_encode($html);
  }
 ?>
