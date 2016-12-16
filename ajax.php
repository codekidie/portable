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
           $html .= $product['name'];
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

          $html .= "<td id=\"s_name\">".$result['name']."</td>";
          $html .= "<input type=\"hidden\" name=\"s_id[]\" value=\"{$result['id']}\" required>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"price[]\" value=\"{$result['sale_price']}\" required>";
          $html  .= "</td>";
          $html .= "<td id=\"s_qty\">";
          $html .= "<input type=\"number\" class=\"form-control\" name=\"quantity[]\" value=\"1\" required>";
          $html  .= "</td>";
         
          $html  .= '<td><select name="mode_of_selling" class="form-control" required="">
                                  <option> none </option> 
                                  <option> piece </option> 
                                  <option> box </option> 
                                  <option> dozen </option> 
                                  <option> can </option> 
                              </select></td>';

          $html  .= '<td> <select name="unit_of_measure" class="form-control" required="">
                                  <option> none </option> 
                                  <option> Liter </option> 
                                  <option> 1.5 Liter </option> 
                                  <option> 8oz </option> 
                                  <option> 12oz </option> 
                                  <option> milligram </option>
                                  <option> carat </option> 
                                  <option> gram </option> 
                                  <option> kilogram </option> 
                                 <option>  metric ton </option> 
                                  <option> pound </option>
                                 <option>  nanometer </option> 
                                 <option>  millimeter </option>
                                 <option>  centimeter </option>
                                  <option> inch </option> 
                                  <option> foot </option> 
                                 <option>  yard </option> 
                                 <option>  meter  </option> 
                                  <option> kilometer </option>  
                                 <option>  mile </option> 
                              </select></td>';                    

          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date[]\" data-date data-date-format=\"yyyy-mm-dd\" required>";
          $html  .= "</td>";

           $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"total[]\" value=\"{$result['sale_price']}\" required>";
          $html  .= "</td>";

          // $html  .= "<td>";
          // $html  .= "<button type=\"submit\" name=\"add_sale\" class=\"btn btn-primary\">Add sale</button>";
          // $html  .= "</td>";
          $html  .= "</tr>";

        }
    }

    echo json_encode($html);
  }
 ?>
