<?php require_once('auth.php') ?>
<?php require_once 'header.php'; ?>
<div class="container">
    <?php
   
    $search = filter_input(INPUT_GET, 'keywords');
    echo "<p class='alert alert-info'> You searched for the following: " . $search . "</p>";

    //let's use explode to break a search phrase into keywords 

    $search_words = explode(' ', $search);

    //we use the explode function to break apart our search phrase. The first parameter is the boundary (i.e. where we should split it up - in this case it would be spaces between the words )

    //let's build the start of our query 
    $sql = "SELECT * FROM blogs WHERE ";

    $where = "";
    foreach ($search_words as $word) {
        $where = $where . "title LIKE '%$word%' OR "; //we continue to build the query 
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
