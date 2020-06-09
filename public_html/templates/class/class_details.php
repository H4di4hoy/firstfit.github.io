<?php include_once "templates/include/header.php" ?>
<?php

/*

$pursue stores page name in order to get the page
that was requested from the class_list page

Page is populated with the relevant class details

*/
//**debug** echo $pursue;
$data=Course::getByPage($pursue);
?>

  <main class="container p-0 mx-auto">
  <!-- I'm putting the 'background-image' inside the inline css style, so that we cna put the image address modifiable by the site admin through php iput -->
    <div id="class_banner" class="container rounded text-center py-5" style="background-image: url(<?php echo $data->img_url?>); ">
      <p class="h2"><?php echo $data->title;?></p>
      <p class="h5 light_background px-5 "><?php echo $data->summary;?></p>
    </div>

    <!-- The following div is the container with jumbotron class applied.
    I have put a background image for this part using my CSS file -->
    <div class="jumbotron mb-0 pb-5 light-gray">
      <p class="h3 text-center text-dark">What to expect</p>
      <p class="text-secondary text-justify"><?php echo $data->description;?></p>
      <div class="d-flex justify-content-center">
        <a href="member.php?action=register&amp;username=<?php echo $username?>&amp;userid=<?php echo $userID?>" class="btn btn-primary text-white w-50 mt-2"><p class="h3">Register Now</p></a>
      </div>
    </div>
  </main>

<?php include_once "templates/include/footer.php" ?>
