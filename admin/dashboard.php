<?php
$email = $_SESSION['user'];
if(empty($email))
{
    unset($_SESSION['user']);
    session_destroy();
    echo '<meta http-equiv="refresh" content="0">';
}
$sql ="SELECT * from user WHERE email ='$email'";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
   $user = $result->fetch_assoc();
}
?>
<div id="wrap">
        <!-- HEADER SECTION -->
        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top " style="background-color: #<?php echo $header['head_color']; ?>">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">
                    <img src="assets/img/logo/<?php echo $header['logo']; ?>" alt="TechCRM" class="headerimage" />
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            
                    </li>
                            <li>
                                <form method="post" class="logoutform">
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="icon-signout"></i>
                                    <input class="logout" type="submit" name="logout" Value="logout">
                                </form>
                                <?php
                                if(isset($_POST['logout']))
                                {
                                    unset($_SESSION['user']);
                                    session_destroy();
                                    echo '<meta http-equiv="refresh" content="0">';
                                }?>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->
        <!-- MENU SECTION -->
        <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img style="height:200px;width:200px;" class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user/<?php echo $user['image'] ?>" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading" style="color:white;"><?php echo strtoupper($user['name']); ?> </h5>
                </div>
                <br />
            </div>
            <ul id="menu" class="collapse">
                <li><a href="enquiry"><i class="icon-user"></i> Enquiry Information </a></li>
                <li><a href="profile"><i class="icon-user"></i> Admin Profile </a></li>
                <li><a href="">
                    <form method="post" class="logoutform">
                        <i class="icon-signout"></i>
                        <input class="logout" type="submit" name="logout" Value="Logout">
                    </form>
                    <?php
                        if(isset($_POST['logout']))
                        {
                            unset($_SESSION['user']);
                            session_destroy();
                            echo '<meta http-equiv="refresh" content="0">';
                        }?>
                    </a>    
                </li>
            </ul>
        </div>
        <!--END MENU SECTION -->
        <!--PAGE CONTENT -->
        <div id="content">
            <?php 
            if (isset($_GET['enquiry'])) {
                include "pages/enquiry.php";
            }
            elseif (isset($_GET['enquirydetail']) ) {
                include "pages/enquirydetail.php";
            }
            elseif (isset($_GET['profile'])) {
                include "pages/profile.php";
            }
            else
            {
                
               include "pages/enquiry.php";
            }
            ?>
            <div style="clear:both;"></div>
        </div>
    </div>
    <!--END MAIN WRAPPER -->
    <!-- FOOTER -->
    <div id="footer">
        <p>© <?php echo date('Y'); ?> Havells Studio - All Rights Reserved.</p>
    </div>
  <span id="message" style="position: fixed; top:0px; text-align: center; height: auto; padding:10px 0px; width: 400px; left: calc(50% - 200px);z-index: 3000; border:1px solid black;"><?php if(isset($responseMessage)) echo $responseMessage; ?></span>