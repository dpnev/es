<?php

if(isset($_POST['email'])) {
 
  $email_to = "info@appliedtech.ru";
  $email_subject = "Effective Solution Contact Form";

  function died($error) {
      // your error code can go here
      echo "We are very sorry, but there were error(s) found with the form you submitted. ";
      echo "These errors appear below.<br /><br />";
      echo $error."<br /><br />";
      echo "Please go back and fix these errors.<br /><br />";
      die();
  }


  // validation expected data exists
  if (!isset($_POST['name']) ||
      !isset($_POST['company']) ||
      !isset($_POST['phone']) ||
      !isset($_POST['email']) ||
      !isset($_POST['message'])) {
      died('We are sorry, but there appears to be a problem with the form you submitted.<br>'.
      'name:'.$_POST['name'].'<br>'.
      'company:'.$_POST['company'].'<br>'.
      'phone:'.$_POST['phone'].'<br>'.
      'email:'.$_POST['email'].'<br>'.
      'message:'.$_POST['message'].'<br>'
      );       
  }

   

  $name = $_POST['name']; // required
  $company = $_POST['company']; // required
  $email = $_POST['email']; // required
  $phone = $_POST['phone']; // not required
  $message = $_POST['message']; // required

  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
  $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
  $email_message = "Contact form details below.\n\n";

   
  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }

   

  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Company: ".clean_string($company)."\n";
  $email_message .= "E-mail: ".clean_string($email)."\n";
  $email_message .= "Phone: ".clean_string($phone)."\n";
  $email_message .= "Message: \n".clean_string($message)."\n";
 
  // create email headers
  $headers = 'From: '.$email."\r\n".
  'Reply-To: '.$email."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  @mail($email_to, $email_subject, $email_message, $headers);
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/thank-you',true, 301);
}
?>