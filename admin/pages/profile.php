<?php
session_start();
$profile_dir = "assets/img/user/";
$logo_dir = "assets/img/logo/";
$sql = "SELECT * from user WHERE role = 'Super Admin'";
$result = $conn->query($sql);
if ($result->num_rows>0)
{
    
    $profile = $result->fetch_assoc();  
}    
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST['updateProfile']))
{
    $role = $_SESSION['role'];    
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $mobile = '9874563210';
    $set = "";
    $status = 1;
        if (empty($name) || empty($email) || empty($mobile))
        {
            $status=0;
        }
        // if (!empty($_FILES['image']['name']) && $status)
        // {
        //     echo "Image is set\n";
        //     $imagename = $_FILES['image']['name'];

        //     $target_file = $profile_dir . basename($_FILES["image"]["name"]);
        //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //     // Check if image file is a actual image or fake image
        //     $check = getimagesize($_FILES["image"]["tmp_name"]);
        //     if($check == false)
        //     {
        //         echo "Valid size\n";
        //         $status = 0;
        //     }
        //     // Allow certain file formats
        //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
        //     {
        //         echo "Invalid extension";
        //         $status = 0;
        //     }
        //     echo "$status\n";
        //     if($status)
        //     {
        //         if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
        //         {
        //             $set .="image = '$imagename',"; 
        //         } 
        //     }     
        // }
        if ($status)
        {
            //echo $set."\n";
            $set = "name = '$name',email = '$email',phone = '$mobile'";
            $sql = "UPDATE user SET $set WHERE role = '$role' ";
            if ($conn->query($sql) === TRUE)
            {
               $responseMessage =  "User Information Updated successfully";
               echo '<meta http-equiv="refresh" content="0">';
            }
            else
            {
                $responseMessage =  "Connection failed: " . $conn->error;
            }
        } 
    
}
if(isset($_POST['updatePassword']))
{
    $role = $_SESSION['role'];
    $oldpassword = test_input(md5($_POST['currentPassword']));
    $newpassword = test_input(md5($_POST['newPassword']));
    $confirmpassword = test_input(md5($_POST['confirmPassword']));
    $status = 1;
    if ($newpassword == $confirmpassword )
    {
        if (empty($oldpassword) || empty($newpassword) || empty($confirmpassword) )
        {
            $status=0;
        }   
        if ($status)
        {
             $sql = "UPDATE user SET password = '$newpassword' WHERE role = '$role' ";
             if ($conn->query($sql) === TRUE)
            {
               $responseMessage =  "Password Updated successfully";
            }
            else
            {
                $responseMessage =  "Connection failed: " . $conn->error;
            }
        } 
    }
}

if (isset($_POST['updateColor'])) {

    $color = test_input($_POST['color']);
    $color = str_replace("#", "", $color);
    $status = 1;
    if (empty($color))
    {
        $status=0;
    }
    if ($status)
    {
        $sql = "UPDATE header SET head_color = '$color' WHERE id = '1' ";
        if ($conn->query($sql) === TRUE)
        {
            $responseMessage =  "Color Change successfully";
            echo '<meta http-equiv="refresh" content="0">';
        }
        else
        {
            $responseMessage =  "Connection failed: " . $conn->error;
        }
    }
}
if (isset($_POST['updatelogo'])) {
    $target_file = $logo_dir . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check == false)
    {
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
    {
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        $responseMessage = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } 
    else
    {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file))
        {
            $name = $_FILES['logo']['name'];
            $sql = "UPDATE header SET logo = '$name'";
            if ($conn->query($sql) === TRUE)
            {
               $responseMessage =  "Logo Add successfully";
               echo '<meta http-equiv="refresh" content="0">';
            }
            else
            {
                $responseMessage =  "Connection failed: " . $conn->error;
            }
        }
        else
        {
            $responseMessage =  "Sorry, there was an error in uploading your file.";
        }
    }
}
?>
<div class="inner" style="min-height: 500px;">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">Profile</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-2 col-sm-4 col-xs-12 userbox">
            <img src="<?php echo $profile_dir.$profile['image'] ;?>" style="width:200px;height:auto; border:5px solid grey;">
        </div>
        <div class="col-lg-10 col-sm-8 col-xs-12">

            <div style="color: black;">

                <table class="space" style="border-collapse: separate;">
                    <tr>
                        <th>Name:-</th>
                        <td id="name"> <?php echo $profile['name']; ?> </td>
                    </tr>
                    <tr style="">
                        <th>Email:-</th>
                        <td id="email"> <?php echo $profile['email'] ?> </td>
                    </tr>
                    <!-- <tr>
                        <th>MOBILE NO.</th>
                        <td id="mobile"> <?php echo $profile['phone'] ?></td>
                    </tr> -->
                    <tr>
                        <th>About Me:-</th>
                        <td id="heading"> <?php echo $profile['role']; ?></td>
                    </tr>
                </table>
                <div class="update_btns">
                    <a   onclick="div_show('updatePassword')" style="cursor: pointer;">Change Password</a><br>
                    <a   onclick="div_show('updateProfile')" style="cursor: pointer;">Edit Profile</a>
                </div>
                <div id="updatePassword">
                    <!-- Popup Div Starts Here -->
                    <div id="popupUpdate" class="popup">
                        <!-- Contact Us Form -->
                        <form id="form" method="post" name="form">
                            <img id="close" src="assets/img/close.png" onclick="div_hide('updatePassword')">
                            <h2>Change Password</h2>
                             <hr>
                                <input name="currentPassword" placeholder="Currenet Password" type="password">
                                <hr>
                                <input name="newPassword" placeholder="New Password" type="password">
                                <input name="confirmPassword" placeholder="Confirm-Password" type="password">
                                 <!--<textarea id="msg" name="message" placeholder="Message"></textarea>-->
                                <input type="submit" id="submit" name="updatePassword" value="Update">
                        </form>
                    </div>
                    <!-- Popup Div Ends Here -->
                </div>                
                <div id="updateProfile" >
                    <div id="popupUpdate" class="popup">
                    <img id="close" src="assets/img/close.png" onclick="div_hide('updateProfile')">
                        <form id="form" method="post" name="form" enctype="multipart/form-data">
                            
                            <h2>Update Profile</h2>
                            <hr>
                            <input type="text" name="name" id="updatename" placeholder="Name">
                            <input id="updateemail" name="email" placeholder="Email" type="text">
                            <input id="updatemobile" name="mobile" placeholder="mobile no." type="hidden">
                            <!-- <label for="imageInput" class="btn text-muted text-center btn-success" style="width:82%;margin-top: 10px;">change Images</label>
                            <input id="imageInput" type="file" style="display:none" name="image"> -->
                            <input type="submit" id="submit" name="updateProfile" value="Update">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <hr>
    <div class="row">
        <div class="col-sm-6 col-xs-12 logo_box">
            <img src="<?php echo $logo_dir.$header['logo'] ;?>" style="width:200px;height:auto;">
            <form method="post" enctype="multipart/form-data"> 
              <input type="submit" name="updatelogo" style="display:none" id="updatelogo">
              <label for="logoinput" class="btn text-muted text-center btn-success" style=" margin-top: 10px;">Update Logo</label>
              <input id="logoinput" type="file" style="display:none" name="logo" onchange="document.getElementById('updatelogo').click()">
          </form>
        </div>
        <div class="col-sm-6 col-xs-12 color_boxx">
            <form method="POST" class="colorsection">
                <div class="form-group form-inline">
                    <input id="colorpicker" type="color" class="form-control" value="#<?php echo $header['head_color']; ?>">
                    <div style="text-align: center;">--Choose OR Enter Manually--</div>
                    <input type="text" id='headercolor' class="form-control" name="color" value="<?php echo $header['head_color']; ?>">
                    <input type="submit" id="submit" name="updateColor" value="Change Header Background Color">
                </div>    
            </form>
        </div>
        
    </div>
    
    
</div>
