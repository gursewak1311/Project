<?php

$input_user_login = filter_input(INPUT_POST, 'user_login');
$input_password = filter_input(INPUT_POST, 'password');


if (empty($input_user_login)) {
    echo "<p> Please enter a username or email </p>";
} elseif (empty($input_password)) {
    echo "<p> Please enter a password </p>";
} else {
    try {
        //connect to the db 
        require_once 'connect.php';
        //set up query to grab user info from the table  
        $sql = "SELECT user_id, username, password FROM users WHERE username = :username OR email = :username";
        //prepare 
        $stmt = $db->prepare($sql);
        //bind 
        $stmt->bindParam(':username', $input_user_login);
        //execute 
        $stmt->execute();
       
        if ($stmt->rowCount() == 1) {
           
            if ($row = $stmt->fetch()) {
                $id = $row['user_id'];
                $username = $row['username'];
                $hashedpassword = $row['password'];
                //check if the passwords match using password_verify 
                if (password_verify($input_password, $hashedpassword)) {
                 
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    // Redirect user to members page - only logged in users should be able to view 
                    header("location:view.php");
                } else {
                  
                    $password_err = "The password you entered was not valid.";
                    echo $password_err;
                }
            }
        }
    } catch (Exception $e) {
        $errormessage = $e->getMessage();
        echo "<p> Opps! Something went wrong? </p>";
        echo $errormessage;
    } finally {
        $stmt->closeCursor();
    }
}
