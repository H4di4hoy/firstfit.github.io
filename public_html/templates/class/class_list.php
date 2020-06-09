<?php include_once "templates/include/header.php" ?>

<?php
//Retrieves a list of all classes
$conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sql= "SELECT title, summary, description, page_name_fk, image_url FROM class";
$st= $conn->prepare($sql);
$st->execute();
$results= array();

  while( $row= $st->fetch() ) {
    $results[]= $row;
  }
    $conn= null;
?>


<main class="container border">
<!-- The following div is the container with jumbotron class applied.
I have put a background image for this part using my CSS file -->
  <section class="jumbotron  text-center">
    <h2 class="text-dark">WELCOME TO <span class="text-primary">FIRSTFIT</span> CLASSES</h2>
    <p class="text-secondary">Feel Happy With Us</p>
  </section>

  <section class="container w-75">
  <?php foreach( $results as $data) { ?><!--Class image, title, a link, and summary populate a row-->
    <section class="row m-3" style="background-image: url(<?php echo $data['image_url']?>);background-size: cover; background-repeat: no-repeat;">
      <section class="col">
        <div class="h3">
          <a class="text-dark font-weight-bold" href="user.php?action=classDetails&amp;pursue=<?php echo $data['page_name_fk']?>"><?php echo $data['title'];?></a>
        </div>
        <p class="text-white light-bg"><?php echo $data['summary'];?></p>
      </section>
    </section>
  <?php } ?>
  </section>
</main>
<?php include_once "templates/include/footer.php" ?>
