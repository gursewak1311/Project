<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
  <div class="container">
     <header>
       <h1> Blog Site </h1>
       <h2> Create your blog or edit blog </h2>
     </header>
     <main>
       <?php
       //connect to our db
          require_once('connect.php');

          //set up SQL statement
          $sql = "SELECT * FROM blogs;";

          //prepare the query
          $statement = $db->prepare($sql);

          //execute
          $statement->execute();

          //use fetchAll to Fetch all remaining rows in a result set
          $records = $statement->fetchAll();

          // echo out the top of the table

          echo "<table class='table'><tbody>";

          foreach ($records as $record) {
            echo "<tr><td>"
              . $record['title'] . "</td><td>" . $record['date'] . "</td><td>" . $record['body'] . "</td><td>" . $record['category'] . "</td>

              <td>
              <a href='delete.php?id=". $record['user_id'] ."' class='btn btn-danger' onclick='return confirm(\"Are you sure? \");' > Delete blog </a>
              </td>
              <td>
              <a href='home.php?id=". $record['user_id'] ."' class='btn btn-primary' > Update blog </a>
              </td>
          </tr>";
          }

          echo "</tbody></table>";

          $statement->closeCursor();
          ?>
        </div>
      </div>
      <!--end row-->
    </main>
  </div>
  <!--end container-->
</body>
<?php require_once('footer.php'); ?>
