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

        case 2:
            header('location:../user/index.php');//redirect to  page
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

        $query = "INSERT INTO Login_Table(Login_Id,Login_Username,Login_Password,Login_Rank) VALUES('$Login_Id','$Login_Username','$enc','1')";

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

<?php include "header.php";?>
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
            <input type="text" class="form-control" required name="Login_Id" title="Must contain only numbers 0-9" minlength="4" maxlength="15" pattern="\d*" placeholder="Employee ID">
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
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" name='reg' class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
<?php include "footer.php";?>
