<?php

//creating an empty array to store error messages 
$errors = array();
//check to see whether data has been entered and whether it is the correct format, provide a heplful error message if not and set the flag variable to true 

if (empty($input_title)) {
  $error_msg_1 = "Please enter Title of your blog";
  array_push($errors, $error_msg_1);
}

if (empty($input_date) || $input_date === false) {
  $error_msg_2 = "Please enter the date";
  array_push($errors, $error_msg_2);
}
if (empty($input_body)) {
  $error_msg_3 = "Please enter Body of your blog";
  array_push($errors, $error_msg_3);
}
if (empty($input_category)) {
  $error_msg_4 = "Please enter Category of your blog";
  array_push($errors, $error_msg_4);
}
if (empty($input_firstname) || empty($input_lastname)) {
  $error_msg_1 = "Please enter first and last name";
  array_push($errors, $error_msg_1);
}

//email has been provided and is in proper format 
if (empty($input_email)) {
  $error_msg_3 = "Please enter a valid email address!";
  array_push($errors, $error_msg_3);
}

//password validation - password provide & is longer than 8 characters 
if (empty($input_password) && strlen($input_password) > 8) {
  $error_msg_4 = "Please enter a password that is longer than 8 characters";
  array_push($errors, $error_msg_4);
}

//password validation - require a strong password that includes an uppercase, lowercase, digit and symbol
if (!preg_match('^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$^', $input_password)) {
  $error_msg_5 =  "Passwords should have one uppercase character, a digit and a symbol!";
  array_push($errors, $error_msg_5);
}

//password validation - passwords don't match 
if ($input_password != $input_password_confirm) {
  $error_msg_6 = "Passwords don't match";
  array_push($errors, $error_msg_6);
}

//photo validation 
//check if the right size and right format 
$ok_files = ['image/gif','image/jpeg','image/jpg', 'image/png']; 

if(in_array($photo_type, $ok_files) === FALSE) {
  $error_msg_7 = "Please submit a photo that is a jpg, png or gif ";
  array_push($errors, $error_msg_7);
}

//check the file size 
if($photo_size < 0 || $photo_size >= 32768) {
  $error_msg_8 = "Please a photo no larger than 32 kb!";
  array_push($errors, $error_msg_8);
}

//check if any errors on upload 
if ($_FILES['photo']['error'] !== 0) {
  $error_msg_9 = "There was an error uploading your file";
  array_push($errors, $error_msg_9);
}

if ($responseData["success"] === false) {
  $error_msg_5 = "No robots please!!";
  array_push($errors, $error_msg_5);
}


?>
