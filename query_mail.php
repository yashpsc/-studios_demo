<?php
require 'config.php';
$errorMSG = $name = $email = $phone = $location = $city = $pincode = $comment = $success = "";
if (isset($_POST)) 	
{
	function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;   
    }
    // NAME
    if(empty($_POST["name"])) {
        $errorMSG = "Name is required ";
    } else {
         $name = test_input($_POST['name']);
        if(!preg_match("/^[a-zA-Z ]*$/", $name)){
            $errorMSG = "Only letters and spaces are allowed in name";
        }
    }
    $email = test_input($_POST['email']); 
    $phone = test_input($_POST['phone']);
    $location = test_input($_POST['location']);
    // if (empty($_POST["city"])) {
    //     $city = '';
    // }else{
    //     $city = test_input($_POST['city']);
    // }
    if (empty($_POST["pincode"])) {
        $pincode = '';
    }else{
        $pincode = test_input($_POST['pincode']);
    }
    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST['comment']);
    } 
    $ip = $_SERVER['REMOTE_ADDR'];
    $formstatus = 'Open';

    $conn = getConnection();

    if( $errorMSG == "")
    {
        $query = "INSERT INTO enquire (name, email, phone, location, pincode, comment, status, ip) VALUES ('$name', '$email', '$phone', '$location', '$pincode', '$comment', '$formstatus', '$ip')";
        if (mysqli_query($conn, $query)) 
        {
            // $headers  = 'MIME-Version: 1.0' . "\r\n";
            // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // $rec_headers  = 'MIME-Version: 1.0' . "\r\n";
            // $rec_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // $email_to = "ishajuly13@gmail.com,akshay.kalra@repindia.com,ravindra.verma@repindia.com";
            
            // $from = "akshay.kalra@repindia.com";
            // $email_subject = "Havells Studio Enquiry - ".$email;
            // $rec_subject = "Thank You";
            // $rec_message = "<html><body>";
            // $rec_message .= "Dear Sir/Madam,<br><br>";
            // $rec_message .= "Thank you for contacting us someone from our team will connect with you shortly.<br><br>";
            // $rec_message .= "We looking forward to connect with you soon.<br><br>";
            // $rec_message .= "Regards,<br> Team Havells";
            // $rec_message .= "</body></html>";
     
            // // Error fuction 
            // function clean_string($string) {
            // $bad = array("content-type","bcc:","to:","cc:","href");
            // return str_replace($bad,"",$string);
            // }
            // $email_message = "<h2><u>Havells Studio</h2></br>The details provided by the enquirer are as mentioned below-<br><br>";
            // $email_message .= "<strong>Name  </strong><strong> : </strong>".clean_string($name)."<br>";
            // $email_message .= "<strong>Phone  </strong><strong> : </strong>".clean_string($phone)."<br>";
            // $email_message .= "<strong>Email Id  </strong><strong> : </strong>".clean_string($email)."<br>";
            // $email_message .= "<strong>Location  </strong><strong> : </strong>".clean_string($location)."<br>";
            // $email_message .= "<strong>Pincode </strong><strong> : </strong>".clean_string($pincode)."<br><br>";
            // $email_message .= "<strong>Comment </strong><strong> : </strong>".clean_string($comment)."<br><br>";
       
            // // create email headers
            // $headers .= 'From: '.$from."\r\n".
            // 'Reply-To: '.$email."\r\n" .
            // 'X-Mailer: PHP/' . phpversion();
            // $rec_headers .= 'From: '.$from ."\r\n".
            // 'Reply-To: '.$email_to."\r\n" .
            // 'X-Mailer: PHP/' . phpversion();

            // // send mail
            // $success =  @mail($email_to, $email_subject, $email_message, $headers); 
            // $rec_success =  @mail($email, $rec_subject, $rec_message, $rec_headers); 
            // if ($success && $errorMSG == ""){
            //     echo "success";
            // }else{
            //     if($errorMSG == ""){
            //         echo "Something went wrong :(, mail not sent";
            //     } else {
            //         echo $errorMSG;
            //     }
            // }
            echo "success";
        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
	}
    
}else{
    echo "Oops!! Something went wrong :(";
}

?>