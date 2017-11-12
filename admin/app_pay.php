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


$result = mysqli_query($con, "SELECT * FROM Application_Payment_Table");
?>
    
        <div class="card-content table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead class="bg-blue-gradient">
                <th>Application ID</th>
                <th>Reference Number</th>
                <th>Edit</th>
                <th>Delete</th>
              
                </thead>
                <tbody>

                <?php
                //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                while($res = mysqli_fetch_array($result)) {
                    echo "<tr class=''>";
                    echo "<td class=''>".$res['Application_Payment_Application_Id']."</td>";
                    echo "<td>".$res['Application_Payment_Payment_Id']."</td>";
                    echo "<td><a href=\"editwith.php?wit=$res[Application_Payment_Id]\" onClick=\"return confirm('Are you sure you want to edit?')\" class='fa fa-edit lg-2'></a></td>";
                    echo "<td><a href=\"delete.php?appp=$res[Application_Payment_Id]\" onClick=\"return confirm('Are you sure you want to delete?')\" class='fa fa-trash lg-2'></a></td>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr class="bg-info">
                <th>Application ID</th>
                <th>Reference Number</th>
                <th>Edit</th>
                <th>Delete</th>
                
                </tr>
                </tfoot>
            </table>
        </div>
    <!-- -->
<?php include "footer.php";?>





