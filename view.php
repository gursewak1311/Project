<?php require_once('header.php'); ?>
<body class="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
