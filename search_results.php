<?php require_once('auth.php') ?>
<?php require_once 'header.php'; ?>
<div class="container">
    <?php

    $search = filter_input(INPUT_GET, 'keywords');
    echo "<p class='alert alert-info'> You searched for the following: " . $search . "</p>";

    $search_words = explode(' ', $search);
  
    $sql = "SELECT * FROM blogs WHERE ";

    //making a string that will contain the desired sql command
    $where = "";
    foreach ($search_words as $word) {
        $where = $where . "title LIKE '%$word%' OR body LIKE '%$word%' OR category LIKE '%$word%' OR "; //we continue to build the query
    }

    $where = substr($where, 0, strlen($where) - 4);

    $final_query = $sql . $where;
    //connect to db first!
    require_once('connect.php');
    //prepare
    $statement = $db->prepare($final_query);
    //execute
    $statement->execute();
    //use fetchAll to access the rows in the data, store in $results
    $results = $statement->fetchAll();

    echo "<table class='table table-striped'>";
    foreach ($results as $result) {
        echo "<tr>";
        echo "<td>" . $result['title']  . "</td>";
        echo "<td>" . $result['date'] . "</td>";
        echo "<td>" . $result['body'] . "</td>";
        echo "<td>" . $result['category'] . "</td>";
    }

    //close the table element
    echo "</table>";

    //close cursor
    $statement->closeCursor();

    ?>
</div><!-- close .container-->
<?php require_once 'footer.php'; ?>

