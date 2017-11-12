<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tarclink Systems</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>M</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Online ID  System</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <?php

                        $result = mysqli_query($con,"SELECT COUNT(User_Notification_Id) FROM User_Notification_Table WHERE User_Notification_User_Id='$id'");
                        $row1 = mysqli_fetch_array($result);

                        $x = $row1[0];
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success"><?php echo $x;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $x;?> message(s)</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <!-- end message -->
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM User_Notification_Table WHERE User_Notification_User_Id='$id' ORDER BY User_Notification_Id DESC ");
                                    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                                    while($res = mysqli_fetch_array($result)) {

                                        echo "<li> <a href='messages.php?mesid=".$res['User_Notification_Notification_Id']."'> ".$res['User_Notification_Notification_Id']."</a></li>";
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    
                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <?php
                           $result = mysqli_query($con, "SELECT User_Photo FROM User_Table WHERE User_Id=$id ORDER BY User_Id ASC");
                                   //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                               while($res = mysqli_fetch_array($result)) {

                                  echo "<img class='user-image' src=".$res['User_Photo'].">";
                               }
                             ?>
                            <span class="hidden-xs"><?php echo $username ;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?php
                                $result = mysqli_query($con, "SELECT User_Photo FROM User_Table WHERE User_Id=$id ORDER BY User_Id ASC");
                                   //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                                   while($res = mysqli_fetch_array($result)) {

                                      echo "<img class='img-circle' src=".$res['User_Photo'].">";
                                   }
                                 ?>

                                <p>
                                    <?php echo $username ;?> - Welcome
                                    <small><?php echo date("D.M.Y"); ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Requests</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Officers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Notice</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="../logout.php?logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php
                           $result = mysqli_query($con, "SELECT User_Photo FROM User_Table WHERE User_Id=$id ORDER BY User_Id ASC");
                                   //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                               while($res = mysqli_fetch_array($result)) {

                                  echo "<img class='user-image' src=".$res['User_Photo'].">";
                               }
                             ?>
                </div>
                <div class="pull-left info">
                    <p><?php echo $username ;?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">FAVOURITES</li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-plus"></i>
                        <span>New Entry</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.php"><i class="fa fa-pencil-square"></i> New ID</a></li>
                        
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-pdf-o"></i>
                        <span>My Reports</span>
                        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="payments.php"><i class="fa fa-paper-plane"></i> Receipt</a></li>
                        <li><a href="applications.php"><i class="fa fa-envelope-open"></i> Application</a></li>
                    </ul>
                </li>

                <li class="header">TAGS</li>
                <li><a href="#"><i class="fa fa-question-circle-o"></i> <span>FAQ'S</span></a></li>
                <li><a href=""><i class="fa fa-question"></i> <span>Get Help</span></a></li>
                
                <li class="header">ABOUT</li>
                <li><a href="#"><i class="fa fa-warning"></i> <span>Our terms and conditions</span></a></li>
            </ul>

        </section>

        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                <small>Built 1.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">

