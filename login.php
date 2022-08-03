<?php require_once('header.php'); ?>
<div class="container">
    <header>
        <h1> Blogs </h1>
        <h2> Login </h2>
    </header>
    <main class="view">
        <div class="row">
            <div class="col-md-8">
                <form action="login_process.php" method="post">
                    <div class="form-group">
                        <label> Username or Email </label>
                        <input type="text" name="user_login" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label> Password </label>
                         <input type="password" name="password" required class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                </form>
            </div>
        </div>
        <!--end row-->
    </main>
    <!--require global footer here -->
    <?php require_once('footer.php'); ?>
