<?php include "header.php";?>
    <!-- -->
<?php

include "../connection/db.php";
// Check connection


$result = mysqli_query($con, "SELECT * FROM Payment_Table");
?>
    
        <div class="card-content table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead class="bg-blue-gradient">
                <th>Confirmation Code</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Payment Mode</th>
                <th>Edit</th>
                <th>Delete</th>
              
                </thead>
                <tbody>

                <?php
                //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                while($res = mysqli_fetch_array($result)) {
                    echo "<tr class=''>";
                    echo "<td class=''>".$res['Payment_Id']."</td>";
                    echo "<td class=''>".$res['Payment_Amount']."</td>";
                    echo "<td class=''>".$res['Payment_Mode']."</td>";
                    echo "<td>".$res['Payment_DateTime']."</td>";
                    echo "<td><a href=\"editwith.php?wit=$res[Application_Id]\" onClick=\"return confirm('Are you sure you want to edit?')\" class='fa fa-edit lg-2'></a></td>";
                    echo "<td><a href=\"delete.php?wit=$res[Application_Id]\" onClick=\"return confirm('Are you sure you want to delete?')\" class='fa fa-trash lg-2'></a></td>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr class="bg-info">
                <th>Confirmation Code</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Payment Mode</th>
                <th>Edit</th>
                <th>Delete</th>
               
                
                </tr>
                </tfoot>
            </table>
        </div>
    <!-- -->
<?php include "footer.php";?>
