  <?php require_once('header.php'); ?>
  <div class="container">
    <header>
      <h1> Blogs </h1>
      <h2> Share Your Blog With The World </h2>
    </header>
    <main>
      <?php

      if (isset($_POST['submit'])) 
      {
        if (!empty($_POST['g-recaptcha-response'])) 
        {      
          $input_firstname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_SPECIAL_CHARS);
          $input_lastname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_SPECIAL_CHARS);
          $input_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
          $input_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
          $input_password = filter_input(INPUT_POST, 'password');
          $input_password_confirm = filter_input(INPUT_POST, 'password_confirm');
          /* image */
          $photo = $_FILES['photo']['name'];
          $photo_type = $_FILES['photo']['type'];
          $photo_size = $_FILES['photo']['size'];
          $photo_tmp = $_FILES['photo']['tmp_name'];
          $photo_error = $_FILES['photo']['error'];
          $id = null;
          $id = filter_input(INPUT_POST, 'user_id');

          //recaptcha 
          $secret = '6Le1F50gAAAAAEWFlAxCxPUiqqduEehNvxDcL-dE';
          $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

          $responseData = json_decode($verifyResponse, true);

          //form validation 
          require('validate.php');

          //if there are errors, display them 
          if (!empty($errors)) {
            echo "<div class='error_msg alert alert-danger'>";
            foreach ($errors as $error) {
              echo "<p>" . $error . "</p>";
            }
            echo "</div>";
            //no errors, go ahead and process the form 
          } else {
            try {
              //connect to database 
              require_once('connect.php');

              //move the uploaded image from temporary directory to images folder 
              $target = 'images/'. $photo;
              move_uploaded_file($photo_tmp, $target);

              //hash the password 
              $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

              // set up SQL command to insert data into table

              $sql = "INSERT INTO users (first_name, last_name, email, username, password, profile_image) VALUES (:firstname, :lastname, :email, :username, :password, :profile_image)"; 


              //call the prepare method of the PDO object, return PDOStatement Object
              $statement = $db->prepare($sql);

              //bind parameters
              $statement->bindParam(':firstname', $input_firstname);
              $statement->bindParam(':lastname', $input_lastname);
              $statement->bindParam(':email', $input_email);
              $statement->bindParam(':username', $input_username);
              $statement->bindParam(':profile_image', $photo);
              $statement->bindParam(':password', $hashed_password);

              //execute the query 
              $statement->execute();

              //redirect the user to the login page to allow them to login 
              header("Location: login.php");
            } catch (Exception $e) {
              $error_message = $e->getMessage();
              error_log($error_message, 3, "my-error-file.log");
              //redirect user to custom error page 
              header("Location: error.php");
            } finally {
              //close the db connection 
              $statement->closeCursor();
            }
          }
        } else {
          echo "<p class='alert alert-danger'> Please let us know you are not a robot! </p>";
        }
      }
      ?>
      <div class="row">
        <!--the HTML registration form-->
        <div class="col-md-6">
          <!--add enctype to form -->
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form" enctype="multipart/form-data">
            <!-- add hidden input with user id if editing -->
            <input type="hidden" name="user_id">
            <div class="form-group">
              <label for="fname"> Your First Name </label>
              <input type="text" name="fname" class="form-control" id="fname" required>
            </div>
            <div class="form-group">
              <label for="lname"> Your Last Name </label>
              <input type="text" name="lname" class="form-control" id="lname" required>
            </div>
            <div class="form-group">
              <label for="email"> Your Email </label>
              <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
              <label for="username"> Username </label>
              <input type="text" name="username" class="form-control" id="username" required>
            </div>
            <div class="form-group">
              <label for="password"> Password </label>
              <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group">
              <label for="password_confirm"> Password Confirm </label>
              <input type="password" name="password_confirm" class="form-control" id="password_confirm"  required>
            </div>
            <!--add input type = file -->
            <div class="form-group">
              <label for="profile"> Profile Pic </label>
              <input type="file" name="photo" id="profilepic">
            </div>
            <!-- add the recpatcha widget -->
            <div class="g-recaptcha" data-sitekey="6Le1F50gAAAAAA9waue8UTpCtjdtROoye5rPmtOm"></div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
          </form>
        </div>

      </div>
      <!--end row-->
    </main>
    <!-- require global footer -->
    <?php require_once('footer.php'); ?>
