<?php require_once('header.php'); ?>
<?php require_once('auth.php'); ?>

   <div class="container">
     <header>
       <h1> Blog Site </h1>
       <h2> Create your blog or edit blog </h2>
     </header>
     <main>
       <?php

        //intialize variables

        $title = null;
        $date = null;
        $body = null;
        $category = null;

        $user_id = null;
        $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


        if (!empty($user_id) && $user_id !== false) {
          //connect to db
          require_once('connect.php');
          //set up sql query
          $sql = "SELECT * FROM blogs WHERE user_id = :user_id;";
          //prepare query
          $statement = $db->prepare($sql);
          //bind
          $statement->bindParam(':user_id', $user_id);
          //execute
          $statement->execute();
          //use fetchAll method
          $records = $statement->fetchAll();

          foreach ($records as $record) {
            $title = $record['title'];
            $date = $record['date'];
            $body = $record['body'];
            $category = $record['category'];
          }
          //close db connection
          $statement->closeCursor();
        }

        //if the form has been submited, process the form information
        if (isset($_POST['submit'])) {
          //check whether the recaptcha was checked by the user
          if (!empty($_POST['g-recaptcha-response'])) {
            //create variables to store form data, using filter input to validate & sanitize
            /*https://www.php.net/manual/en/filter.filters.sanitize.php*/
            $input_title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $input_date = filter_input(INPUT_POST, 'date');
            $input_body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
            $input_category = filter_input(INPUT_POST, 'category');

            //if editing, capture the id from the hidden input
            $id = null;
            $id = filter_input(INPUT_POST, 'user_id');


            $secret = '6Le1F50gAAAAAEWFlAxCxPUiqqduEehNvxDcL-dE';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

            $responseData = json_decode($verifyResponse, true);


            require('validate1.php');

            if (!empty($errors)) {
              echo "<div class='error_msg alert alert-danger'>";
              foreach ($errors as $error) {
                echo "<p>" . $error . "</p>";
              }
              echo "</div>";
            } else {

              try {
                //connect to database
                require_once('connect.php');


  
                if (!empty($id)) {
                  $sql = "UPDATE blogs SET title = :title, date = :date, body = :body, category = :category WHERE user_id = :id";
                } else {
                  $sql = "INSERT INTO blogs (title, date, body, category) VALUES (:title, :date, :body, :category);";
                }

                //call the prepare method of the PDO object, return PDOStatement Object
                $statement = $db->prepare($sql);

                //bind parameters
                $statement->bindParam(':title', $input_title);
                $statement->bindParam(':date', $input_date);
                $statement->bindParam(':body', $input_body);
                $statement->bindParam(':category', $input_category);

                //bind user id if needed
                if (!empty($id)) {
                  $statement->bindParam(':id', $id);
                }
                //execute the query
                $statement->execute();

                //close the db connection
                $statement->closeCursor();
                //redirect the user to the updated playlist page
                header("Location: view.php");
              } catch (PDOException $e) {
                 require_once('error.php');
              }
            }
          } else {
            echo "<p class='alert alert-danger'> Please let us know you are not a robot! </p>";
          }
        }
        ?>
       <div class="row">
         <div class="col-md-6">
           <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form">

             <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
             <div class="form-group">
               <label for="title"> Title </label>
               <input type="text" name="title" class="form-control" id="title" value="<?php echo $title; ?>" required>
             </div>
             <div class="form-group">
               <label for="date"> Date </label>
               <input type="date" name="date" class="form-control" id="date" value="<?php echo $date; ?>" required>
             </div>
             <div>
               <label for="body"> Body of the blog </label>
               <input type="body" name="body" class="form-control" id="body" value="<?php echo "$body"; ?>" required>
             </div>

             <div class="form-group">
               <label for="category"> category </label>
               <select name="category" class="form-select form-select-lg form-control" id="category">
                 <option selected>Choose category</option>
                 <option value="food"> Food </option>
                 <option value="travel"> Travel </option>
                 <option value="health"> Health </option>
                 <option value="lifestyle"> Lifestyle </option>
                 <option value="fashion"> Fashion </option>
                 <option value="photography"> Photography </option>
                 <option value="personal"> Personal </option>
                 <option value="diy"> DIY craft </option>
                 <option value="parenting"> Parenting </option>
                 <option value="music"> Music </option>
                 <option value="business"> Business </option>
                 <option value="sports"> Sports </option>
                 <option value="news"> News </option>
                 <option value="movie"> Movie </option>
               </select>
             </div>

             <!-- add the recpatcha widget -->
             <div class="g-recaptcha" data-sitekey="6Le1F50gAAAAAA9waue8UTpCtjdtROoye5rPmtOm"></div>
             <input type="submit" name="submit" value="Submit" class="btn btn-primary">
           </form>
         </div>

       </div>
       <!--end row-->
     </main>
   </div>
   <!--end container-->

<?php require_once('footer.php'); ?>
