<?php include_once "templates/include/header.php" ?>
<?php
//Populates the special offer page which is retrieved when the feature box link is clicked
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$st=$conn->prepare("SELECT * from offer");
$st->execute();
$data= $st->fetch();
$conn= null;

 ?>
    <main class="container p-0 mx-auto">
      <!-- I'm putting the 'background-image' inside the inline css style, so that we cna put the image address modifiable by the site admin through php iput -->
      <!-- <div id="class_banner" class="container rounded text-center pt-5 pb-5" style="background-image: url(images/offer.jpg)">
      </div> -->
      <div class="container p-0">
        <img class="border rounded "src="<?php echo $data['image_url']?>" alt="<?php echo $data['title']?>" style="width:100%; height: auto;">
      </div>
      <!-- The following div is the container with jumbotron class applied.
      I have put a background image for this part using my CSS file -->
      <div class="jumbotron mb-0 pb-5 light-gray">
      <?php echo $data['description']?>
      </div>
    </main>

<?php include_once "templates/include/footer.php" ?>
