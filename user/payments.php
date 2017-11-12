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
            <form method="POST" class="">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Enter your payment code...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
  
            <?php
              if(isset($_POST['search'])) {
                   $search_=$_POST['q'];
                   $result = mysqli_query($con, "SELECT * FROM Payment_Table WHERE Payment_Id='$search_'");

                }

               ?>
        <div class="card-content table-responsive">
            <table class="table table-striped table-bordered" id="table1">
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
                    echo "<td class=''>".$res['Payment_Id']."</td>";
                    echo "<td class=''>".$res['Payment_Amount']."</td>";
                    echo "<td>".$res['Payment_DateTime']."</td>";
                    echo "<td class=''>".$res['Payment_Mode']."</td>";
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
    <!-- -->
<?php include "footer.php";?>

