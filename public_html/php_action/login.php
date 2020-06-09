<?php include_once "templates/include/header.php" ?>

<?php

if( !empty($action) ) { //Store the initial action in $seconary, it will be used later by $_GET
$secondary= $action;
//**debug** echo $secondary;
}


?>
<main class="container p-0 row mx-auto">
  <section id="login" class="container">

    <section class="h3 text-secondary text-center my-4">
      <!--Shows an error message if login is incorrect or ay other prompt-->
      <p><?php if( isset($errorMessage) ) echo $errorMessage; ?></p>
    </section>

    <form class="col-sm-7 col-11 mx-auto align-self-center border border-secondary p-3 rounded" action="user.php?action=login&amp;secondary=<?php echo $secondary?>&amp;pursue=<?php echo $pursue ?>" method="post">

      <legend><i class="text-secondary fas fa-user"></i> Login</legend>
      <fieldset class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" required placeholder="Enter Email" name="email">


        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" required placeholder="Enter password" name="password">

      </fieldset>
      <button class="btn btn-primary" type="submit" name="login" value="Login">Submit</button>
      <p><?php// echo $action?><p>
        <!--Sign up requires the relevant action and if a request was made it is stored in $secondary -->
      <p>Need to create an account? <span><a href="user.php?action=signup&amp;secondary=<?php echo $secondary?>&amp;pursue=<?php echo $pursue ?>">Register here</a><p>

    </form>




  </section>
</main>

<?php include_once "templates/include/footer.php" ?>
