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
?>

<?php include "header.php";?>
<!-- -->
<?php

include "../connection/db.php";
// Check connection

$mes=$_GET['mesid'];

$result = mysqli_query($con, "SELECT * FROM Notification_Table WHERE Notification_Id='$mes'");
?>

<div class="card-content table-responsive">
    <table class="table table-striped table-bordered" id="table1">
        <thead class="bg-primary">
        <th width="15%">Date Sent</th>
        <th>Message</th>

        </thead>
        <tbody>

        <?php
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {
            echo "<tr class=''>";
            echo "<td class=''>".$res['Notification_DateTime']."</td>";
            echo "<td>".$res['Notification_Message']."</td>";
        }
        ?>
        </tbody>
        <tfoot>
        <tr class="bg-info">
            <th>Date Sent</th>
            <th>Message</th>

        </tr>
        </tfoot>
    </table>
</div>
<!-- -->
<?php include "footer.php";?>

