<?php include_once "include/header.php" ?>

<?php
//Retrieve the approved testimonial details onto the page
$conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$st= $conn->prepare("SELECT fName, class, title, description from testimonial, user where approval= 1 AND testimonial.email = user.email");
$st->execute();
$results= array();

while( $row= $st->fetch() ) {
  $results[]= $row;
}

$conn= null;

?>
<main class="container">
  <section class="jumbotron h-85 text-white" style="background-image: url(images/jumbo1.jpg); background-size: 100%; ">
      <section class="row text-center">
        <div class="col">
          <h2 class="h1" style="font-family:'Cabin',sans-serif;">Testimonials</h2>
        </div>
      </section>
  </section>

  <?php foreach($results as $data) {?><!--Testimonials load here-->
  <section class="card border-0 mb-3">
    <div class="row no-gutters">

      <figure class="col-sm-2 col-md-2">
        <img src="images/defaultUser.png" class="w-100 rounded" alt="A user's picture">
      </figure>

      <section class="col-md-10">
        <div class="card-body border">
          <p class="h4 card-title"><?php echo $data['fName']?></p>
          <p class="h4 card-title"><?php echo $data['class']?></p>
          <p class="h5 card-text"><?php echo $data['title']?></p>
          <p class="card-text"><?php echo $data['description'] ?></p>
        </div>
      </section>
    </div>
  </section>
<?php } ?>
</main>
<?php include_once "include/footer.php" ?>
