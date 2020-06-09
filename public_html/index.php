<?php include_once "templates/include/header.php"?>

<?php
//Get the special offer details before loading the page
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$st=$conn->prepare("SELECT * from offer");
$st->execute();
$offerData= $st->fetch();
$conn= null;
?>

    <main class="container p-0 mx-auto">

      <div id="banner">
        <p class="h3 pt-5 pl-4 text-uppercase">Welcome to</p>
        <p class="h1 text-primary pl-4 text-uppercase" >First Fit</p>
        <p class="h2 pl-4 text-uppercase">The people's gym</p>
      </div>


      <!-- The following div is the container with jumbotron class applied.
      I have put a background image for this part using my CSS file -->
      <div class="jumbotron">
        <!-- 'text-secondary' makes the text colour gray. -->
        <p class="h2 text-dark">Our gym is finished to the highest standard with a full range of Life fitness…</p>
        <p class="text-secondary text-justify">…strength and conditioning machines from dual and single pulleys, lat pull-downs, chest and shoulder press machines. We also boast a large free weight room which includes 5 squat racks, a Smith Machine and huge selection of plates. Our expert coaches are always available to introduce and encourage you to use our facility to its maximum potential. BetterBody has the ultimate fitness experience at your disposal. Our unique programming will challenge and inspire you to get into great shape and feel healthy. On signing up for any of our long term packages for the gym we include PTs and a consultation, after your initial induction we follow up with progressions from your previous program. eventy years bringing floral arrangements to the city of Limerick.</p>
        <!-- <img class="col-7" src="images/runner.png" alt="runner"> -->
      </div>


      <!-- the features boxes main container -->
      <div class="row justify-content-around">
        <div class="card col-sm-5 col-12">
          <?php $data= Course::getNewestClass(); ?><!--Gets most recently added class from Course.php-->
          <h4 class="mx-auto">New Class</h4>
          <img class="card-img-top mx-auto" src="<?php echo $data->img_url?>" alt="<?php echo $data->title?>"><!--Output class data here-->
          <div class="card-body">
            <p class="h5 card-title"><?php echo $data->title ?></p>
            <p class="card-text"><?php echo $data->summary ?></p>
            <a href="user.php?action=classDetails&amp;pursue=<?php echo $data->page_name?>" class="btn btn-primary">Read More</a><!--End of class output-->
          </div>
        </div> <!-- end-card-1 -->

        <div class="card col-sm-5 col-12">
          <h4 class="mx-auto text-center"><?php echo $offerData['title']?></h4><!--Output the offer data here that was retrieved before loading the page-->
          <img class="card-img-top mx-auto" src="<?php echo $offerData['image_url']?>" alt="<?php echo $offerData['title'] ?>">
          <div class="card-body">
            <p class="h5 card-title"><?php echo $offerData['title']?></p>
            <p class="card-text"><?php echo $offerData['summary'] ?></p>
            <a href="user.php?action=offer" class="btn btn-primary">Read More</a><!--End of offer output-->
          </div>
        </div> <!-- end-card-2 -->

      </div><!-- end of row -->
    </main>

<?php include_once "templates/include/footer.php" ?>
