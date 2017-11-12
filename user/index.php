<?php

/**
 * Created by PhpStorm.
 * User: king
 * Date: 10/10/2017
 * Time: 10:44
 */

session_start();
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['logname']) && ($_SESSION['rank'])) {
    switch($_SESSION['rank']) {

        case 1:
            header('location:../admin/index.php');//redirect to  page
            break;
        case 3:
            header('location:../officer/index.php');//redirect to  page
            break;

    }
}elseif(!isset($_SESSION['logname']) && !isset($_SESSION['rank'])) {
    header('Location:../sessions.php');
}
else
{

    header('Location:index.php');
}

include '../connection/db.php';
$username=$_SESSION['logname'];

$result1 = mysqli_query($con, "SELECT * FROM Login_Table WHERE Login_Username='$username'");

while($res = mysqli_fetch_array($result1))
{
    $username= $res['Login_Username'];
    $id= $res['Login_Id'];

}


$check_ = $con->query("SELECT User_Id FROM User_Table WHERE User_Id='$id' ");
$count=$check_->num_rows;

if ($count==0) {

    header('Location:profile.php');
}else{

null;

}
//AUTO GENERATE NUMBER

$chars = array(0,1,2,3,4,5,6,7,8,9);
$serial = '';
$max = count($chars)-1;
for($i=0;$i<10;$i++){
    $serial .= (!($i % 5) && $i ? '' : '').$chars[rand(0, $max)];
}

//INSERT DATA ON DB
if(isset($_POST['app'])) {
    
    $User_Contact_=$_POST['User_Contact'];
    $Payment_Id_=$_POST['Payment_Id'];
    $Payment_Amount_=$_POST['Payment_Amount'];
    $Payment_Mode_=$_POST['Payment_Mode'];
    $Application_Type_=$_POST['Application_Type'];
    
    $sql = "INSERT INTO Application_Table(Application_Id, Application_DateTime, Application_Type)
VALUES ('$id', NOW(), '$Application_Type_');";
    $sql .= "INSERT INTO Payment_Table(Payment_Id,Payment_Amount ,Payment_DateTime ,Payment_Mode,Payment_code)
VALUES ('$Payment_Id_', '$Payment_Amount_', NOW(),'$Payment_Mode_','$serial');";
    $sql .= "INSERT INTO Application_Payment_Table(Application_Payment_Application_Id,Application_Payment_Payment_Id,Application_Payment_Payment_Code)
VALUES ('$id', '$Payment_Id_','$serial')";

    if ($con->multi_query($sql) === TRUE) {
        
        $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Success!
					</div>";
        
        echo '<meta content="4;index.php" http-equiv="refresh" >';
    
        
    } else {
        
        $msg = "<div class='alert alert-warning'>
						<span class='glyphicon glyphicon-info-sign'></span> $con->error
					</div>";
     
    }

    $con->close();

}

?>


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

                                        echo "<li class=''><a href='messages.php?mesid=".$res['User_Notification_Notification_Id']."'> ".$res['User_Notification_Notification_Id']."</a></li>";
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
                                    <a href="pro_edit.php" class="btn btn-default btn-flat">Profile</a>
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

        <!-- Main content -->
            <!-- ADD CONTENT HERE -->
           <section class="content">
            <div class="box">

                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <!-- ADD CONTENT HERE -->
                <ul id="registration-step">
                    <li id="account" class="highlight">Application</li>
                    <li id="password">Payment</li>
                    <li id="general">Confirm</li>
                </ul>
                <form name="frmRegistration" id="registration-form" method="POST">
                    <div id="account-field">

                        <div class="form-group" hidden="">
                            <label for="Application_Id">Application ID</label>
                            <input type="text" class="form-control" placeholder="" readonly value="<?php echo $id;?>" name="Application_Id" id="Application_Id">
                        </div>
                        <!--<div class="form-group" hidden="">
                            <label for="Application_DateTime">Date/Time</label>
                            <input type="text" readonly="" class="form-control" name="Application_DateTime" value="<?php echo date('l jS \of F Y h:i:s A'); ?>" id="Application_DateTime" required>
                        </div>-->

                        <div class="form-group">
                            <label for="Application_Type">Application type:</label>
                            <select class="form-control" name="Application_Type" id="Application_Type">
                                <option value="NORMAL"> Normal </option>
                                <option value="RE-APPLICATION"> Re-Application </option>
                            </select>
                        </div>
                        <div>
                            <small><p style="color:red">Note:</p> This account is for Kenyan citizens only. Your birth certificate number will be used.Select normal if you have never applied for the ID before.
                                <br>For those with lost or destroyed ID,select Re-Application(No charges).<p></p></small>
                        </div>
                    </div>
                    <div id="password-field" style="display:none;">

                        <div class="form-group">
                            <label for="Payment_Id">Confirmation Code:</label>
                            <input type="text" class="form-control" name="Payment_Id" placeholder="e.g. XiUGGH9977VC" required="">
                        </div>
                        <div class="form-group">
                            <label for="Payment_Amount">Amount in numbers:</label>
                            <input type="text" class="form-control" name="Payment_Amount" placeholder="e.g. 70000" required="">
                        </div>
                        <div class="form-group">
                            <label for="Payment_Mode">Application type:</label>
                            <select class="form-control" name="Payment_Mode" id="Payment_Mode">
                                <option value="MPESA"> M-PESA </option>
                                <option value="AIRTEL-MONEY"> AIRTEL-MONEY </option>
                                <option value="BANK"> BANK </option>
                            </select>
                        </div>
                    </div>
                    

                    <div id="general-field" style="display:none;" class="form-group">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" required> I agree to the <a href="#">terms</a>
                                </label>

                                <button type="submit" name="app" class="btn btn-warning">Complete</button>

                            </div>
                        </div>

                    </div>


                    <div>
                        <input class="btn btn-primary" type="button" name="back" id="back" value="Back" style="display:none;">
                        <input class="btn btn-primary" type="button" name="next" id="next" value="Next">
                        <!--<input class="btn btn-default" type="submit" name="finish" id="finish" value="Finish" style="display:none;">-->
                    </div>

                </form>
                <style>
                    #registration-step{margin:0;padding:0;}
                    #registration-step li{list-style:none; float:left;padding:5px 10px;border-top:#EEE 1px solid;border-left:#EEE 1px solid;border-right:#EEE 1px solid;}
                    #registration-step li.highlight{background-color:#418EBA;}
                    #registration-form{clear:both;border:1px #EEE solid;padding:20px;}
                    .demoInputBox{padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;background-color: #FFF;width: auto;}
                    .registration-error{color:#FF0000; padding-left:15px;}
                    .message {color: #00FF00;font-weight: bold;width: 100%;padding: 10px;}
                    .btnAction{padding: 5px 10px;background-color: #09F;border: 0;color: #FFF;cursor: pointer; margin-top:15px;}
                </style>
            </div>
            <!--END ADD CONTENT HERE -->
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="">online id system</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>


            </div>
            <!-- /.tab-pane -->

            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
 <script>
        function validate() {
            var output = true;

            return output;
        }
        $(document).ready(function() {
            $("#next").click(function(){
                var output = validate();
                if(output) {
                    var current = $(".highlight");
                    var next = $(".highlight").next("li");
                    if(next.length>0) {
                        $("#"+current.attr("id")+"-field").hide();
                        $("#"+next.attr("id")+"-field").show();
                        $("#back").show();
                        $("#finish").hide();
                        $(".highlight").removeClass("highlight");
                        next.addClass("highlight");
                        if($(".highlight").attr("id") == $("li").last().attr("id")) {
                            $("#next").hide();
                            $("#finish").show();
                        }
                    }
                }
            });
            $("#back").click(function(){
                var current = $(".highlight");
                var prev = $(".highlight").prev("li");
                if(prev.length>0) {
                    $("#"+current.attr("id")+"-field").hide();
                    $("#"+prev.attr("id")+"-field").show();
                    $("#next").show();
                    $("#finish").hide();
                    $(".highlight").removeClass("highlight");
                    prev.addClass("highlight");
                    if($(".highlight").attr("id") == $("li").first().attr("id")) {
                        $("#back").hide();
                    }
                }
            });
        });
    </script>
</body>
</html>
