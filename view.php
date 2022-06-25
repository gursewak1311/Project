<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Blog/CMS site </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>
<body class="home">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blog</a>
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

          // Step One - Add Edit & Delete Button to the UI to allow users to edit & delete 
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
    <footer>
      <p> &copy; <?php echo getdate()['year']; ?>  </p>
    </footer>
  </div>
  <!--end container-->
</body>

</html>
