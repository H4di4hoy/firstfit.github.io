<?php include_once "templates/include/header.php" ?>
<?php //**Debug** echo $secondary
/*
This page confirms sign up of the user
*/

?>
  <main class="container">
    <section class="row justify-content-start">
      <section class="d-flex flex-column col ">

      <section class="row h2 text-info">  <?php if(isset ($feedback) ) echo $feedback ?> </section>

      <div class="container-fluid align-self-center">
        <!--The link redirects to user.php with the user details, secondary action is passed to ensure any request is completed after signup -->
        <a href='user.php?action=<?php echo $secondary?>&amp;username=<?php echo $username ?>&amp;pursue=<?php echo $pursue?>' class="d-block btn btn-info w-75 mx-auto mt-2">Continue</a>
      </div>
      </section>
    </section>
  </main>
<?php include_once "templates/include/footer.php" ?>
