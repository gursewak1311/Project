<?php

try {
    //data source name 
    $dsn = 'mysql:host=172.31.22.43;dbname=Gursewak200507206';
    //username
    $username = 'Gursewak200507206'; 
    //password
    $password = 'PQj1tJ_xwl';
    $db = new PDO($dsn, $username, $password);
    //set the errormode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
  $error_message = $e->getMessage();
              error_log($error_message, 3, "my-error-file.log");
              //redirect user to custom error page 
              header("Location: error.php");
}
?>
