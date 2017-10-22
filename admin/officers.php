<?php include "header.php";?>
    <!-- -->
<?php

include "../connection/db.php";
// Check connection


$result = mysqli_query($con, "SELECT * FROM Login_Table WHERE Login_Rank='1' ");
?>
    
         <div class="card-content table-responsive">
            <table class="table table-striped table-bordered" id="table1">
                <thead class="bg-blue-gradient">
                <th>Document ID</th>
                <th>Login Username</th>
                <th>Login Rank</th>
                <th>Edit</th>
                <th>Delete</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>

                <?php
                //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
                while($res = mysqli_fetch_array($result)) {
                    echo "<tr class=''>";
                    echo "<td class=''>".$res['Login_Id']."</td>";
                    echo "<td class=''>".$res['Login_Username']."</td>";
                    echo "<td>".$res['Login_Rank']."</td>";
                    echo "<td><a href=\"editwith.php?wit=$res[Login_Id]\" onClick=\"return confirm('Are you sure you want to edit?')\" class='fa fa-edit lg-2'></a></td>";
                    echo "<td><a href=\"delete.php?wit=$res[Login_Id]\" onClick=\"return confirm('Are you sure you want to delete?')\" class='fa fa-trash lg-2'></a></td>";
                }
                ?>
                </tbody>
                <tfoot>
                <tr class="bg-info">
                <th>Document ID</th>
                <th>Login Username</th>
                <th>Login Rank</th>
                <th>Edit</th>
                <th>Delete</th>
                <th></th>
                <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    <!-- -->
<?php include "footer.php";?>