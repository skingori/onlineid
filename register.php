<?php
include_once ('control.php');
require('connection/db.php');

if(isset($_POST['reg'])) {


    $Login_Id_= strip_tags($_POST['Login_Id']);
    $Login_Username_= strip_tags($_POST['Login_Username']);
    $Login_Password_= strip_tags($_POST['Login_Password']);
    //$login_rank_= strip_tags($_POST['login_rank']);
//$Login_Username_= strip_tags($_POST['Login_Username']);


    $Login_Id= $con->real_escape_string($Login_Id_ );
    $Login_Username= $con->real_escape_string($Login_Username_ );
    $Login_Password= $con->real_escape_string($Login_Password_);
    //$login_rank= $con->real_escape_string($login_rank_ );
//$Login_Username= $con->real_escape_string($Login_Username_);
    $enc= md5($Login_Password);
//$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

    $check_ = $con->query("SELECT Login_Username FROM Login_Table WHERE Login_Username='$Login_Username'");
    $count=$check_->num_rows;

    if ($count==0) {

        $query = "INSERT INTO Login_Table(Login_Id,Login_Username,Login_Password,Login_Rank) VALUES('$Login_Id','$Login_Username','$enc','2')";

//inserting in login table
//$query .= "INSERT INTO Login_table(Login_Username,login_rank,Login_Password,login_status) VALUES('$uname','$rank','$enc','Inactive')";

        if ($con->query($query)) {
            $msg = "<div class='alert alert-success'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
</div>";
            ?>

            <p align="center">
                <meta content="2;index.php?login" http-equiv="refresh" />
            </p>

            <?php

        }else {
            $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
</div>";
        }

    } else {


        $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry username already taken !
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
  <title>tarclink | Registration Page</title>
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
      <a href="">Get Started</a>
  </div>

  <div class="register-box-body">
      <!-- Messages for the registration -->
      <?php
      if (isset($msg)) {
          echo $msg;
      }
      ?>
      <!-- End of message -->
    <p class="login-box-msg">Register a new membership</p>

    <form class="" method="post" id="myForm">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" required name="Login_Id" title="Must contain only numbers 0-9" minlength="4" maxlength="15" pattern="\d*" placeholder="Certificate Number">
        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
      </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" title="Username must contain only letters, numbers,underscores and 4-10 characters" required pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{4,10}$" id="field_username" name="Login_Username" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="Login_Password" id="field_pwd1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers.">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" required class="form-control" title="Please enter the same Password as above" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" id="field_pwd2" name="password2" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name='reg' class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="index.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

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

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // JavaScript form validation

        var checkPassword = function(str)
        {
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
            return re.test(str);
        };

        var checkForm = function(e)
        {
            if(this.Login_Username.value == "") {
                alert("Error: Username cannot be blank!");
                this.Login_Username.focus();
                e.preventDefault(); // equivalent to return false
                return;
            }
            re = /^\w+$/;
            if(!re.test(this.Login_Username.value)) {
                alert("Error: Username must contain only letters, numbers and underscores!");
                this.Login_Username.focus();
                e.preventDefault();
                return;
            }
            if(this.Login_Password.value != "" && this.Login_Password.value == this.password2.value) {
                if(!checkPassword(this.Login_Password.value)) {
                    alert("The password you have entered is not valid!");
                    this.Login_Password.focus();
                    e.preventDefault();
                    return;
                }
            } else {
                alert("Oops: Please check that you've entered and confirmed your password!");
                this.Login_Password.focus();
                e.preventDefault();
                return;
            }
            //alert("Both username and password are VALID!");
        };

        var myForm = document.getElementById("myForm");
        myForm.addEventListener("submit", checkForm, true);

        // HTML5 form validation

        var supports_input_validity = function()
        {
            var i = document.createElement("input");
            return "setCustomValidity" in i;
        }

        if(supports_input_validity()) {
            var usernameInput = document.getElementById("field_username");
            usernameInput.setCustomValidity(usernameInput.title);

            var pwd1Input = document.getElementById("field_pwd1");
            pwd1Input.setCustomValidity(pwd1Input.title);

            var pwd2Input = document.getElementById("field_pwd2");

            // input key handlers

            usernameInput.addEventListener("keyup", function(e) {
                usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
            }, false);

            pwd1Input.addEventListener("keyup", function(e) {
                this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
                if(this.checkValidity()) {
                    pwd2Input.pattern = RegExp.escape(this.value);
                    pwd2Input.setCustomValidity(pwd2Input.title);
                } else {
                    pwd2Input.pattern = this.pattern;
                    pwd2Input.setCustomValidity("");
                }
            }, false);

            pwd2Input.addEventListener("keyup", function(e) {
                this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
            }, false);

        }

    }, false);

</script>
</body>
</html>
