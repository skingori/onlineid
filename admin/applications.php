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


$result = mysqli_query($con, "SELECT * FROM User_Table WHERE User_Id IN(SELECT Application_Id FROM Application_Table WHERE Application_Id NOT IN(SELECT User_Notification_User_Id FROM User_Notification_Table))");
?>

    <div class="box">

        <div class="box-header">
            <h3 class="box-title" style="font-family:Consolas; font-size: small">All users who have applied</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover table-condensed" id="table1" style="font-family: consolas; font-size: small">
                <thead class="bg-primary">
                <th>Photo</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Date Born</th>
                <th></th>

                </thead>
                <tbody>

                <?php
                //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                while($res = mysqli_fetch_array($result)) {
                    echo "<tr class=''>";
                    echo "<td><img class='img-circle' style='width: 40px;' src=" . $res['User_Photo'] . "></td>";
                    echo "<td class=''>" . $res['User_Id'] . "</td>";
                    echo "<td class=''>" . $res['User_Name'] . "</td>";
                    echo "<td class=''>" . $res['User_Contact'] . "</td>";
                    echo "<td>" . $res['User_Gender'] . "</td>";
                    echo "<td>" . $res['User_DOB'] . "</td>";
                    echo "<td><a href=\"message.php?un=$res[User_Id]\" onClick=\"return confirm('Are you sure you want to confirm?')\" class='btn btn-primary fa fa-envelope'> </a></td>";
                }
                ?>
                </tbody>
                <tfoot class="">
                <th>Photo</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Date Born</th>
                <th></th>
                <th></th>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- -->
<?php include "footer.php";?>