<style type="text/css">
    body
    {
        background-color: #<?php echo $header['head_color']; ?>;
    }
</style>
<?php
if(isset($_POST['login']))
{
    $status = 1;
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (empty($_POST['email']) and empty($_POST['email']))
    {
        $emailerr = "*PLease Enter Email Id";
        $status = 0;
    }
    else
    {
        $email = test_input($_POST['email']);
        $role = test_input($_POST['role']);
    }
    if (empty($_POST['password'])) {
        $passworderr = "*PLease Enter Password";
        $status = 0;
    }
    else
    {
        $password = test_input(md5($_POST['password']));
    }
    if ($status)
    {
        $sql = "SELECT * from user WHERE email = '$email' AND role = '$role'";
        $result = $conn->query($sql);
        if ($result->num_rows>0)
        {
            $userdata = $result->fetch_assoc();
            
            if ($userdata['password'] == $password)
            {
                $_SESSION['user'] = $email;
                $_SESSION['role'] = strtolower($userdata['role']);
                $_SESSION['name'] = $userdata['name'];
                $_SESSION['uid'] = $userdata['id'];
                echo '<meta http-equiv="refresh" content="0">';
            }
            else
            {
                $passworderr = "*Incorrect Password";
            }    
            
        }
        else
        {
            $emailerr = "**Enter Valid Email Id and Password";
        }
    }  
}
?>
<div class="container">
    <div class="text-center">
        <h4><img src="assets/img/logo/<?php echo $header['logo']; ?>" style="padding: 40px 0;"></h4>
    </div>
    <div class="tab-content" style="max-width: 600px;width: 100%; background-color: white;">
        <div id="login" class="tab-pane active">
            <form class="form-signin" method="post">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                     Enter Email-id and password
                </p>
                <input type="hidden" name="role" value="Super Admin">
                <input type="email" name="email" placeholder="Email" class="form-control" />
                <input type="password" name="password" placeholder="Password" class="form-control" />
                <input class="btn text-muted text-center btn-primary" type="submit" name="login" value="Sign in">
                <div><?php 
                            if(isset($emailerr))
                            {
                                echo $emailerr;
                                echo "<br>";
                            }
                            if(isset($passworderr))
                            {
                                echo $passworderr;
                            }
                            ?>
                </div>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <div class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                <input id="email" type="email"  required="required" placeholder="Your E-mail"  class="form-control" name="email" />
                <br />
                <input id="mailPassword" type="submit" name="forgetpassword" class="btn text-muted text-center btn-success" value="Recover Password">
            </div>
            <div id="mailresponse" style="text-align: center;display: none;"></div>
        </div>
        
    </div>
    <div class="text-center">
        <ul class="list-inline">
            <li>Go to <a class="text-muted" href="/index.php" >Havells Studio</a></li>
            <!-- <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li> -->
        </ul>
    </div>


</div>
