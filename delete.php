<?php
//Step Two - Build the script that will delete the information from the table in the database 

//store the user id in a variable - post or get? 

$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT); 

//validate whether user id is set and is a number 

if(!empty($user_id) && $user_id !== false) {

    //connect to the database 

    require_once('connect.php'); 

    //create our SQL statement
    
    $sql = "DELETE FROM blogs WHERE user_id = :user_id"; 

    //prepare the statement 

    $statement = $db->prepare($sql); 

    //bindParam 
    $statement->bindParam(':user_id',$user_id ); 

    //execute 
    $statement->execute(); 

    //close db connection 
    $statement->closeCursor(); 
    header("Location: view.php"); 

}
