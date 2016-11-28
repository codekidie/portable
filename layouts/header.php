<?php $user = current_user(); ?>
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/> -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
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

            <?php elseif($user['user_level'] === '2'): ?>
              <!-- Special user -->
            <?php include_once('special_menu.php');?>

            <?php elseif($user['user_level'] === '3'): ?>
              <!-- User menu -->
            <?php include_once('user_menu.php');?>

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
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="http://localhost/portable_inventory/home.php" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                       
                    </ul>

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
                     
                        <li>
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
