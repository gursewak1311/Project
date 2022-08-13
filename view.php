<?php require_once('header.php'); ?>
<?php require_once('auth.php'); ?>
<?php require_once('navigation.php'); ?>
  <div class="container">
     <header>
       <h1> Blog Site </h1>
       <h2> Create your blog or edit blog </h2>
     </header>
     <main>
       <div class="row">
        <form method="get" action="search_results.php" class="search-form">
          <div class="form-group">
            <label for="keywords"> Search for a blog: </label>
            <input type="text" name="keywords" class="form-control" />
          </div>
          <input type="submit" value="Search" class="btn btn-primary" />
        </form>
       <?php
       try{
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
       }
         catch (PDOException $e) {
          header('Location: error.php');
          $error_message = $e->getMessage();
          $msg = "There was an error when user attempted to view the playlists. Error Message: " . $error_message . ".";
          //send error email to dev/admin 
          mail("jessicagilfillan@gmail.com", "App Error - Show Playlist", $msg);
        } finally {
          $statement->closeCursor();
        }
          ?>
        </div>
      </div>
      <!--end row-->
    </main>
  </div>
  <!--end container-->
</body>
<?php require_once('footer.php'); ?>
