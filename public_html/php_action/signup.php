<?php include_once "templates/include/header.php"?>

<main class="container p-0 row mx-auto">
  <section class="container m-5">
    <section class="h3 text-secondary text-center my-4">
      <p><?php if( isset($errorMessage) ) echo $errorMessage; ?></p>
    </section>
    <!--The form posts to user.php with the user details, secondary action is passed to ensure request is completed after signup -->
    <form action="user.php?action=signup&amp;secondary=<?php echo $secondary?>&amp;pursue=<?php if(!empty($pursue)) echo $pursue ?>" class="col-sm-7 col-11 mx-auto align-self-center border border-secondary p-3 rounded" method="post">
      <legend><i class="text-secondary fas fa-user"></i> Create Account</legend>
      <fieldset class="form-group align-items-center">

        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" placeholder="" required autofocus maxlength="255" name="fname"/>


        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" placeholder="" required autofocus="255" name="lname" />


        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" required placeholder="" name="email">


        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" required placeholder="Enter password" name="password">

        <label for="vpwd">Verify password:</label>
        <input type="password" class="form-control" id="vpwd" required placeholder="Re-enter password" name="passverify">

      </fieldset>
      <button class="btn btn-primary" type="submit" name="signup" value="SignUp">Submit</button>
      <p><?php// echo $action?><p>
    </form>

  </section>
</main>


<?php include_once "templates/include/footer.php"?>
