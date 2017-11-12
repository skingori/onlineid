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
?>
<?php include "header.php";?>
<!-- -->
<?php

include "../connection/db.php";
// Check connection

$idx=$_GET['pay'];
$result = mysqli_query($con, "SELECT * FROM Payment_Table WHERE Payment_Id IN(SELECT Application_Payment_Payment_Id FROM Application_Payment_Table WHERE Application_Payment_Application_Id ='$idx')");
?>
<div class="box">

    <div class="box-header">
        <h3 class="box-title" style="font-family:Consolas; font-size: small">User Payments</h3>
    </div>
    <div class="box-body">
        <table class="table table-striped table-hover table-condensed" id="table1" style="font-family: consolas; font-size: small">
            <thead class="bg-primary">
            <th>Confirmation Code</th>
            <th>Amount Paid</th>
            <th>Payment Date</th>
            <th>Payment Mode</th>

            </thead>
            <tbody>

            <?php
            //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
            while($res = mysqli_fetch_array($result)) {
                echo "<tr class=''>";
                echo "<td class=''>" . $res['Payment_Id'] . "</td>";
                echo "<td class=''>" . $res['Payment_Amount'] . "</td>";
                echo "<td>" . $res['Payment_DateTime'] . "</td>";
                echo "<td class=''>" . $res['Payment_Mode'] . "</td>";
            }
            ?>
            </tbody>
            <tfoot>
            <tr class="bg-info">
                <th>Confirmation Code</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Payment Mode</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

    <div class="form-group">
        <a href="payments.php" class=" fa fa-backward btn btn-flat">&nbsp;Back to Payments</a>
        </div>
<!-- -->
<?php include "footer.php";?>

