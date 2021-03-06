<?php 
$user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Portable Inventory System";?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/> -->
    <link rel="stylesheet" href="libs/css/datepicker3.min.css" />
    <!-- <link rel="stylesheet" href="libs/css/main.css" /> -->
     <!-- Bootstrap core CSS     -->
    <link href="libs/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="libs/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="libs/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="libs/assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="libs/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="libs/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <script src="libs/js/jquery.min.js"></script>
    
    <!-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> -->


    
    <style>
          .img-circle{
                width: 100px;
          }
    </style>

  </head>
  <body>
    <?php  if ($session->isUserLoggedIn(true)): ?>
  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

      <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <?php echo remove_junk(ucfirst($user['company_name'])); ?>
                </a>
                <center><?php echo date("F j, Y, g:i a");?> </center>
            </div>
            <?php if($user['user_level'] === '0'): ?>
              <!-- admin menu -->
            <?php include_once('super_menu.php');?>

             <?php elseif($user['user_level'] === '1'): ?>
              <!-- admin menu -->
            <?php include_once('admin_menu.php');?>

            <?php else: ?>
              <?php $admin_id =  $_SESSION['admin_id'] ;
                    $user_id  =  $_SESSION['user_id'] ;
                    $all_privilege = find_by_sql("SELECT * FROM privilege p LEFT JOIN users u  ON p.user_id=u.id WHERE p.admin_id = '{$admin_id}' AND p.user_id='{$user_id}' ORDER BY p.user_id"); ?>
                   <ul class="nav">
                        <li>
                          <a href="home.php">
                            <i class="pe-7s-home"></i>
                            <span>Dashboard</span>
                          </a>
                        </li>  
                        <?php foreach ($all_privilege as $a): ?>
                          <?php 
                             $access = $a['access'];
                             if ($access == 'Manage_Product') {
                                $icon = 'pe-7s-server'; 
                                $link = 'product.php';
                             } elseif ($access == 'Category') {
                                $icon = 'pe-7s-keypad'; 
                                $link = 'categorie.php';
                             }elseif ($access == 'Add_Product') {
                                $icon = 'pe-7s-network'; 
                                $link = 'product.php';
                             }elseif ($access == 'Add_Quantity') {
                                $icon = 'pe-7s-network'; 
                                $link = 'add_batch.php';
                             }elseif ($access == 'Manage_Sales') {
                                $icon = 'pe-7s-repeat'; 
                                $link = 'sales.php';
                             }elseif ($access == 'Add_Sales') {
                                $icon = 'pe-7s-graph1'; 
                                $link = 'add_sale.php';
                             }elseif ($access == 'Sales_by_dates') {
                                $icon = 'pe-7s-date'; 
                                $link = 'sales_report.php';
                             }elseif ($access == 'Monthly_Sales') {
                               $icon = 'pe-7s-date'; 
                                $link = 'monthly_sales.php';
                             }elseif ($access == 'Daily_Sales') {
                               $icon = 'pe-7s-date'; 
                                $link = 'daily_sales.php';
                             }elseif ($access == 'Media') {
                               $icon = 'pe-7s-photo'; 
                                $link = 'media.php';
                             }elseif ($access == 'Return_Product') {
                                $icon = 'pe-7s-server'; 
                                $link = 'add_return_product.php';
                             }elseif ($access == 'Purchase_Order') {
                                $icon = 'pe-7s-cart'; 
                                $link = 'add_purchase_order.php';
                             }elseif ($access == 'View_Reports') {
                                 $icon = 'pe-7s-graph'; 
                                $link = 'view_reports.php';
                             }

                           

                           ?>
                               <li>
                                <a href="<?php echo $link; ?>">
                                  <i class="<?php echo $icon; ?>"></i>
                                  <span><?php echo str_replace('_', ' ',$a['access']); ?></span>
                                </a>
                              </li>    
                         <?php endforeach ?> 
                   </ul> 
            <?php endif;?>
      </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>

                </div>
                <div class="collapse navbar-collapse">
                    <?php if(!$user['user_level'] == '0' ): ?>

                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="http://localhost/portable_inventory/home.php" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                      <?php 

                            $admin_id            =  $_SESSION['admin_id'];
                            
                            $expire_products     = getExpiringProducts($admin_id);

                            $total_notifications = getTotalProductsExpiringNotifications($admin_id);

                            $item_expiry_notifications = getTotalProductsExpiringItem($admin_id);

                            $minimumstocks       = getMinimumProducts($admin_id);
                            
                            $total_minimum_noti  = getTotalMinimumProducts($admin_id);

                            $item_expiry_by_batch = getItemNum($admin_id);


                      ?>
                       
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification"><?php  echo  $total_notifications[0]['count'] + $total_minimum_noti[0]['count'] + sizeof($item_expiry_by_batch); ?></span>
                              </a>
                              <ul class="dropdown-menu">
                              <?php foreach ($expire_products as $ex): ?>
                                <?php  $mergeuserstoproducts = find_by_sql("SELECT * FROM users WHERE admin_id = '{$ex['admin_id']}'"); 
                                       foreach ($mergeuserstoproducts as $mu) {
                                          $phone =  $mu['phone'];

                                
                                                // $ch = curl_init();
                                                // curl_setopt($ch, CURLOPT_URL,"http://api.semaphore.co/api/sms");
                                                // curl_setopt($ch, CURLOPT_POST, 1);
                                                // curl_setopt($ch, CURLOPT_POSTFIELDS,"api=PFpGxb3vGHhL1zYxVXKp&number=".$phone."&message=Product ".$ex['name']." is expiring on ".$ex['expiry_date']);
                                                // // receive server response ...
                                                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                // $server_output = curl_exec ($ch);
                                                // curl_close ($ch);

                                       }


                                ?>

                                    <li><a href="expiry.php?id=<?php echo $ex['id']; ?>">Product : <?php echo $ex['name']; ?> Batch : <?php echo $ex['batch']; ?> Expiring at <?php echo $ex['expiry_date']; ?></a></li>
                                  
                              <?php endforeach ?>
                              <?php foreach ($minimumstocks as $ms): ?>
                                 <li><a href="#">Product : <?php echo $ms['item_name']; ?> Batch : <?php echo $ms['batch']; ?> Stocks Reach Minimum Level <?php echo $ms['quantity']; ?></a></li>
                              <?php endforeach ?>

                              <?php for ($i=0; $i < sizeof($item_expiry_by_batch) ; $i++) {  ?>
                                     <li><a href="#">
                                     <?php $messg = 'Item '; ?>
                              <?php for ($ii=0; $ii < sizeof($item_expiry_notifications); $ii++) {  ?>
                                      <?php if ($item_expiry_notifications[$ii][5] == $item_expiry_by_batch[$i]['expiry_date']): ?>
                                      <?php  $messg .= $item_expiry_notifications[$ii]['item_name'].' , '; ?> 
                                            
                                      <?php endif ?>
                              <?php } ?>
                               <?php echo "Batch :".$item_expiry_notifications[$i]['batch']; ?> 
                                      <?php echo $messg .= "Expiring at ".$item_expiry_by_batch[$i]['expiry_date'];  ?>

                                      </a></li>
                              <?php } ?>

                              
                              </ul>
                        </li>
                       
                    </ul>
                    <?php endif ?>


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                               Account
                            </a>
                        </li>

                          <li>
                           <a href="edit_account.php">
                               Settings
                            </a>
                        </li>
                     
                        <li class="logout">
                            <a href="logout.php">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<?php endif;?>


        <div class="content">
            <div class="container-fluid">
