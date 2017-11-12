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


//GENERATE CODE
$chars = array(0,1,2,3,4,5,6,7,8,9);
$serial = '';
$max = count($chars)-1;
for($i=0;$i<10;$i++){
    $serial .= (!($i % 5) && $i ? '' : '').$chars[rand(0, $max)];
}
//INSERT DATA ON DB
if(isset($_POST['app'])) {
    $Notification_Id_=$_POST['Notification_Id'];
    $Application_Type_=$_POST['Application_Type'];
    $Notification_Message_=$_POST['Notification_Message'];
    $User_Notification_User_Id_=$_POST['User_Notification_User_Id'];
    $Application_Type_=$_POST['Application_Type'];
    
    $sql = "INSERT INTO Notification_Table(Notification_Id, Notification_DateTime, Notification_Message)
VALUES ('$Notification_Id_', NOW(), '$Notification_Message_');";
    $sql .= "INSERT INTO User_Notification_Table(User_Notification_User_Id,User_Notification_Notification_Id)
VALUES ('$User_Notification_User_Id_', '$Notification_Id_')";

    if ($con->multi_query($sql) === TRUE) {
        
        $msg = "<div class='alert alert-success'>
						<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Message Sent!
					</div>";
        
        echo '<meta content="4;index.php" http-equiv="refresh" >';
    
        
    } else {
        
        $msg = "<div class='alert alert-warning'>
						<span class='glyphicon glyphicon-info-sign'></span> $con->error
					</div>";
     
    }

    $con->close();

}

?>

<?php include 'header.php';?>
 <section class="content">
            <div class="box">

                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
                <!-- ADD CONTENT HERE -->
                <ul id="registration-step">
                    <li id="account" class="highlight">New Message</li>
                    <li id="password">To:</li>
                    <li id="general">Confirm</li>
                </ul>
                <form name="frmRegistration" id="registration-form" method="POST">
                    <div id="account-field">

                        <div class="form-group" hidden="">
                            <label for="Notification_Id">Notification_Id</label>
                            <input type="text" class="form-control" placeholder="" readonly value="<?php echo $serial;?>" name="Notification_Id" >
                        </div>
                        <!--<div class="form-group" hidden="">
                            <label for="Application_DateTime">Date/Time</label>
                            <input type="text" readonly="" class="form-control" name="Application_DateTime" value="<?php echo date('l jS \of F Y h:i:s A'); ?>" id="Application_DateTime" required>
                        </div>-->
                         <label for="Notification_Message">Message:</label>
                         <div class="form-group">
                             <textarea cols="0" rows="10" name="Notification_Message" class="form-control" required=""></textarea>
                         </div>
                    </div>
                    <div id="password-field" style="display:none;">
                        <div class="form-group">
                          <a href="javascript:window.open('off_new.php','mypopuptitle','width=700,height=600')"><i class="fa fa-user-plus"></i> New User</a>  
                        </div>
                        
                         <div class="form-group has-feedback">
                                    <select name="User_Notification_User_Id" required class="form-control">

                                         <option selected=""><?php echo $_GET['un'];?></option>
                                          <?php
                                          //include("../connection/db.php");
                                          $query = "SELECT * FROM User_Table";
                                          $result = mysqli_query($con,$query);
                                          while($row = mysqli_fetch_array($result))
                                          {
                                              $User_Id = $row[User_Id];
                                              //$user_lastname = $row[user_lastname];
                                              //$user_firstname= $row[user_firstname];
                                              echo "<option>$User_Id</option>";
                                          }
                                          ?>
                                    </select>
                        </div>
                       
                    </div>
                    

                    <div id="general-field" style="display:none;" class="form-group">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" required> I agree to the <a href="#">terms</a>
                                </label>

                                <button type="submit" name="app" class="btn btn-warning"><i class="fa fa-check"></i></button>

                            </div>
                        </div>

                    </div>


                    <div>
                        <input class="btn btn-primary" type="button" name="back" id="back" value="Back" style="display:none;">
                        <input class="btn btn-primary" type="button" name="next" id="next" value="Next">
                        <!--<input class="btn btn-default" type="submit" name="finish" id="finish" value="Finish" style="display:none;">-->
                    </div>

                </form>
                <style>
                    #registration-step{margin:0;padding:0;}
                    #registration-step li{list-style:none; float:left;padding:5px 10px;border-top:#EEE 1px solid;border-left:#EEE 1px solid;border-right:#EEE 1px solid;}
                    #registration-step li.highlight{background-color:#418EBA;}
                    #registration-form{clear:both;border:1px #EEE solid;padding:20px;}
                    .demoInputBox{padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;background-color: #FFF;width: auto;}
                    .registration-error{color:#FF0000; padding-left:15px;}
                    .message {color: #00FF00;font-weight: bold;width: 100%;padding: 10px;}
                    .btnAction{padding: 5px 10px;background-color: #09F;border: 0;color: #FFF;cursor: pointer; margin-top:15px;}
                </style>
            </div>

<?php include 'footer.php';?>

 <script>
        function validate() {
            var output = true;

            return output;
        }
        $(document).ready(function() {
            $("#next").click(function(){
                var output = validate();
                if(output) {
                    var current = $(".highlight");
                    var next = $(".highlight").next("li");
                    if(next.length>0) {
                        $("#"+current.attr("id")+"-field").hide();
                        $("#"+next.attr("id")+"-field").show();
                        $("#back").show();
                        $("#finish").hide();
                        $(".highlight").removeClass("highlight");
                        next.addClass("highlight");
                        if($(".highlight").attr("id") == $("li").last().attr("id")) {
                            $("#next").hide();
                            $("#finish").show();
                        }
                    }
                }
            });
            $("#back").click(function(){
                var current = $(".highlight");
                var prev = $(".highlight").prev("li");
                if(prev.length>0) {
                    $("#"+current.attr("id")+"-field").hide();
                    $("#"+prev.attr("id")+"-field").show();
                    $("#next").show();
                    $("#finish").hide();
                    $(".highlight").removeClass("highlight");
                    prev.addClass("highlight");
                    if($(".highlight").attr("id") == $("li").first().attr("id")) {
                        $("#back").hide();
                    }
                }
            });
        });
    </script>
