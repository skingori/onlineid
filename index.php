<?php
session_start();
if (isset($_SESSION['rank'])!="" && isset($_SESSION['logname'])!="") {
    header("Location: sessions.php");
    exit;
}


require('connection/db.php');
// If form submitted, insert values into the database.
if (isset($_POST['login'])){

    $username = stripslashes($_REQUEST['Login_Username']); // removes backslashes
//$rank = stripslashes($_REQUEST['rank']); // removes backslashes
    $password = stripslashes($_REQUEST['Login_Password']);

    $username_ = mysqli_real_escape_string($con,$username); //escapes special characters in a string
//$rank_ = mysqli_real_escape_string($con,$rank); //escapes special characters in a string
    $password_ = mysqli_real_escape_string($con,$password);

    $enc = md5($password_);
//Checking is user existing in the database or not
    $query = "SELECT * FROM `Login_Table` WHERE Login_Username='$username_' AND Login_Password='$enc'";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);

    $rowCheck = mysqli_num_rows($result);
    $row= mysqli_fetch_array($result);


    if($row['Login_Rank']==1){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        //below will be used as a welcome message
        $username=$_SESSION['logname'];

        $msg = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Login Successful !! Welcome $username
                    </div>";


        ?>
        <p align="center">
            <meta content="2;admin/index.php?action=home" http-equiv="refresh" />
        </p>

        <?php
        

    } elseif ($row['Login_Rank']==2){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        $msg = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Login Successful !! Welcome
                    </div>";
        ?>

        <p align="center">
            <meta content="2;user/index.php" http-equiv="refresh" />
        </p>

        <?php

    }elseif ($row['Login_Rank']==3){

        $_SESSION['logname'] = $row['Login_Username'];
        $_SESSION['rank'] = $row['Login_Rank'];

        $msg = "<div class='alert alert-success'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Login Successful !! Welcome
                    </div>";
        ?>

        <p align="center">
            <meta content="2;officer/index.php?action=home" http-equiv="refresh" />
        </p>

        <?php

    }

    else {
        ?>
        <?php

        $msg = "<div class='alert alert-danger'>
                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Wrong username or Password !
                    </div>";

    }
}?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>tarclink | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><small>Almost Done</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form class="" method="post">
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="Login_Username" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="Login_Password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="register.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
