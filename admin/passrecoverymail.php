<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    function return_error($error)
    {
        echo json_encode(array('success'=>0, 'message'=>$error));
        die();
    }
    include "database.php";
    $email = $_POST['email'];
    $sql = "SELECT * from user where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows>0)
    {
        $maildata = $result->fetch_assoc();

        $email_to = $email; 
        $email_from = "akshay.kalra@repindia.com"; // must be different than $email_from 
        $email_subject = "Password Recovery Mail";
        $name = $maildata['name'];

        function randomPassword() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 12; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
        $randompass = randomPassword();
        $password = md5($randompass);
        $addsql = "UPDATE user SET password = '$password' WHERE email = '$email' ";
        if ($conn->query($addsql) === TRUE)
        {
           $message = "Your Account Details\r\nName : $name\r\nEmail : $email_to\r\nPassword : $randompass\r\n\r\n **Please change your password after login";
            // check for empty required fields
            if (!isset($name) || !isset($message))
            {
                return_error('Please fill in all required fields.');
            }
            // form validation
            $error_message = "";

            // name
            $name_exp = "/^[a-z0-9 .\-]+$/i";
            if (!preg_match($name_exp,$name))
            {
                $this_error = 'Please enter a valid name.';
                $error_message .= ($error_message == "") ? $this_error : "<br/>".$this_error;
            }        

            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if (!preg_match($email_exp,$email))
            {
                $this_error = 'Please enter a valid email address.';
                $error_message .= ($error_message == "") ? $this_error : "<br/>".$this_error;
            } 

            // if there are validation errors
            if(strlen($error_message) > 0)
            {
                return_error($error_message);
            }

            // prepare email message
            $email_message = "Form details below.\n\n";

            function clean_string($string)
            {
                $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                return str_replace($bad, "", $string);
            }

            $email_message = $message;

            // create email headers
            $headers = 'From: '.$email_from."\r\n".
            'Reply-To: '.$email."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            if (@mail($email_to, $email_subject, $email_message, $headers))
            {
                echo json_encode(array('success'=>1, 'message'=>'New password has been sent to your email id.')); 
            }

            else 
            {
                echo json_encode(array('success'=>0, 'message'=>'An error occured. Please try again later.')); 
                die();        
            }
        }
        else
        {
            $responseMessage =  "Connection failed: " . $conn->error;
        }
    }
    else
    {
        return_error("This email not Registered");
    }
}
?>