<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$dropdown = $_POST['dropdown'];
$message = $_POST['message'];
 
$strValidationMessage = "";
 
$to = "example@rawad.com";
$subject = "New Message";
 
if (isset($_POST['submit']))
{
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $message = $_POST['message'];
 
  $boolValidateOK = 1;
 
  if(trim($name)==="")
  {
    $boolValidateOK = 0;
    $strValidationMessage .= "\nPlease Enter your name.<br />";
  }
 
 
    //Phone Number Valadation
  $phone = str_replace("-","",$phone);
  $phone = str_replace(".","",$phone);
  $phone = str_replace("(","",$phone);
  $phone = str_replace(")","",$phone);
  $phone = str_replace(" ","",$phone);
   
 
  if(!is_numeric($phone)){//Checks if Phone Number are a value of Numbers.
    $boolValidateOK = 0;
    $strValidationMessage .= "The phone is not a number<br/>";  
  }
 
  //Valadating Phone Number
  if(strlen($phone) != 10){
    $boolValidateOK = 0;
    $strValidationMessage .= "Please enter a proper 10-digit phone number<br/>";
  }
 
 //Function Of the Email Address
  function validate_email( $senderemail )
    { // this is a function; it receives info and returns a value.
    $email = trim( $senderemail ); # removes whitespace
   if(!empty($email) ):
    // validate email address syntax
      if( preg_match('/^[a-z0-9\_\.]+@[a-z0-9\-]+\.[a-z]+\.?[a-z]{1,4}$/i', $email, $match) ):
    return strtolower($match[0]); # valid!
 endif;
  endif;
    return false; # NOT valid!
   }// end function validate_email
 
    //Valadating  Email Address
    $emailValidate = validate_email($email);
    if(!$emailValidate)
    {
      $boolValidateOK = 0;
      $strValidationMessage .= "\nEmail Address is Required.<br />";
    }
 
    // This will protect you from Security against email spams
    $badStrings = array("Content-Type:",
      "MIME-Version:",
      "Content-Transfer-Encoding:",
      "bcc:",
      "cc:");
    foreach($_POST as $k => $v){
      foreach($badStrings as $v2){
        if(strpos($v, $v2) !== false){
        // In case of spam, all actions taken here
        //header("HTTP/1.0 403 Forbidden");
        //exit; // stop all further PHP scripting, so mail will not be sent.
 
          $boolValidateOK = 0;
          $strValidationMessage = "There is a security problem with the formatting of this message. ";
          $strValidationMessage .= "Please try again.";
        }
      }
    }
 
    //Validating Message
  if(trim($message)==="")
  {
    $boolValidateOK = 0;
    $strValidationMessage .= "\n Please enter a message!.<br />";
  }
 
 
    if($boolValidateOK == 1)
  {
    if (mail($to, $subject, $message, "From: $name <$email>")){
        $strValidationMessage = "Email Has been Sent.";
      }
      else{
        $strValidationMessage = "Message Failed Please Try again.";
      }
  }
 
}
?>
