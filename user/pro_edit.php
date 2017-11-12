<?php
include_once ("../connection/db.php");

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
//GET USER DATA

$result1 = mysqli_query($con, "SELECT * FROM User_Table WHERE User_Id='$id'");

while($res = mysqli_fetch_array($result1))
{
    $User_Name= $res['User_Name'];
    $User_Contact= $res['User_Contact'];
    $User_DOB= $res['User_DOB'];
    
}
if (isset($_POST['add'])) {

    //$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    //$image_name = addslashes($_FILES['image']["name"]);
    //$image_size = getimagesize($_FILES['image']['tmp_name']);

    move_uploaded_file($_FILES["image"]["tmp_name"], '../upload/' . $_FILES["image"]["name"]);
    move_uploaded_file($_FILES["doc"]["tmp_name"], '../upload/' . $_FILES["doc"]["name"]);

    $location ='../upload/'. $_FILES["image"]["name"];
    $location1 ='../upload/'. $_FILES["doc"]["name"];

    
    $User_Name_= $_POST['User_Name'];
    $User_Contact_= $_POST['User_Contact'];
    $User_Gender_= $_POST['User_Gender'];
    $User_DOB_= $_POST['User_DOB'];
    
    $result = mysqli_query($con, "UPDATE User_Table SET User_Name='$User_Name_',User_Contact='$User_Contact_',User_Gender='$User_Gender_',User_DOB='$User_DOB_',User_Photo='$location',User_Document_type='$location1' WHERE User_Id=$id");
    
    $msg = "<div class='alert alert-success'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
        </div>";
    
        header('refresh:2; url=index.php');
}

include'header.php';?>
<!-- Add content -->

<div class="">
    <div class="nav-tabs-custom">
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#about" data-toggle="tab">About me</a></li>
            <li><a href="#profile" data-toggle="tab">Profile</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="profile">
                <!-- Post -->

                <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="about">

            </div>
            <!-- /.tab-pane -->

            <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="User_Name" class="col-sm-2 control-label">Full Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $User_Name;?>" id="User_Name" name="User_Name" pattern="[a-zA-Z\s]{4,}" title="Use letters ONLY" placeholder="John Doe">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="User_Contact" class="col-sm-2 control-label">Contact</label>

                        <div class="col-sm-10">
                            <input type="tel" class="form-control" value="<?php echo $User_Contact;?>"  pattern="^[0-9\-\+\s\(\)]*$" title="Input the correct contact as our example" id="User_Contact" name="User_Contact" placeholder="+254724090774">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="User_Gender" class="col-sm-2 control-label">Gender</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="User_Gender" id="User_Gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bday" class="col-sm-2 control-label">Birth Date</label>

                        <div class="col-sm-10">
                        <input type="text" value="<?php echo $User_DOB;?>" name="User_DOB" required id="datepicker" onchange="checkAge(this.value);" class="form-control" placeholder="Date of birth">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">My Photo</label>

                        <div class="col-sm-10">
                            <input type="file" name="image"  id="image" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="doc" class="col-sm-2 control-label">Document</label>

                        <div class="col-sm-10">
                            <input type="file" name="doc"  id="doc" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger" name="add" id="add">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
</div>

<?php
include 'footer.php';

?>
<script type="text/javascript">
    function checkAge(bday)
    {
        if(bday<18)
        {
            alert('You must be 18 or older to continue');
            document.getElementById('add').disabled=true;
        }
        else
        {
            document.getElementById('add').disabled=false;
        }
    }
</script>

