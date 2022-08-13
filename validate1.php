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

if ($responseData["success"] === false) {
  $error_msg_5 = "No robots please!!";
  array_push($errors, $error_msg_5);
}


?>
