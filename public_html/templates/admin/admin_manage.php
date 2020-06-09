<?php include_once "templates/include/header.php" ?>
<?php

/*All output from the database on the admin control panel
  is retrieved by the controlPanel() function in admin.php
*/

//List of total classes
$results['list'] = $classes['results'];
$results['totalRows'] = $classes['totalRows'];

//Total messages
$messageResults['messages']= $messages['messages'];
$messageResults['totalMessages']= $messages['totalRows'];

//Get messages to read by admin

//Get testimonials

//Set registration "update" query to the database

//Homepage special offer build data
?>

<main class="container p-0 mx-auto">
  <h3 class="text-center bg-info rounded">ADMIN CONTROL PANEL</h3>

  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes" aria-selected="true">Classes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Us</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="testimonials-tab" data-toggle="tab" href="#testimonials" role="tab" aria-controls="testimonials" aria-selected="false">Testimonials</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " id="registration-tab" data-toggle="tab" href="#registration" role="tab" aria-controls="registration" aria-selected="false">Registration</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="homepage_edit-tab" data-toggle="tab" href="#homepage_edit" role="tab" aria-controls="homepage_edit" aria-selected="false">Homepage</a>
    </li>
  </ul>

  <!-- the following div is main container for all tabs -->
  <div class="tab-content" id="myTabContent">

    <!--
    Each section Below is a separate container for different pages(tabs) such as classes, testimonial, home, etc pages.
  -->




  <!--=============================================================-->




  <!-- "Class-details-edit" tab  -->
  <section class="tab-pane fade show active container p-0 mx-auto" id="classes" role="tabpanel" aria-labelledby="classes-tab">
    <div class="table-responsive mt-2">
      <h4 class="text-center text-secondary">CLASS DETAILS EDIT</h4>
      <!--Shows feedback after making any changes-->
      <section class="row justify-content-center text-primary"><?php if(isset ($feedback) ) echo $feedback ?></section>
      <!-- Search_box input -->
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Title.." title="Type in a title">
      <table id="myTable" class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th class="w-25">Date</th>
            <th>Title</th>
          </tr>
        </thead>

        <tbody>  <!--Display a list of all available classes-->
          <?php foreach ( $results['list'] as $course ) { ?>

            <tr onclick="location='admin.php?action=editCourse&amp;id=<?php echo $course->id?>'">
              <td><?php echo $course->date?></td>
              <td>
                <?php echo $course->title?>
              </td>
            </tr>

          <?php } ?>
        </tbody>

        <tfoot class="thead-dark">
          <tr>
            <th><a class="d-block text-warning" href="admin.php?action=createCourse">Add a New Course</a></th>
            <th></th>

          </tr>
        </tfoot>

      </table>

      <p><?php echo $results['totalRows']?> course<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total</p>

      <!-- <p><a href="admin.php?action=newArticle">Add a New Course</a></p> -->

    </div>
  </section>




  <!--=============================================================-->





  <!-- "contact_us_manage" tab  -->
  <section class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <!-- the following article is the container for the cuntactus-mange page -->
    <article class="container p-0 ">
      <h4 class="text-center text-secondary">CONTACT US MANAGE</h4>
      <!--List of messages populate here, allows reading of messages-->
      <?php foreach($messageResults['messages'] as $message) {?>
      <section class="contactus_manage row mt-2 border border-secondary ">
        <!-- contact info column 25% width -->
          <div class="col-md-3 p-2 align-self-center">
            <div class="row ">
               <?php echo "Name: ".$message['fname']?>
            </div>
            <div class="row ">
              <?php echo "Email: ".$message['email']?>
            </div>
            <div class="row ">
              <?php echo "Phone: ". $message['phone']?>
            </div>

          </div>

          <div class="col-md-7">
            <h5>Message:</h5>
            <p><?php echo $message['description']?></p>
          </div>
      </section>
    <?php } ?>
    </article>
  </section>



  <!--=============================================================-->




  <!-- "Testimonials-manage" tab  -->

  <section class="tab-pane fade" id="testimonials" role="tabpanel" aria-labelledby="testimonials-tab">
    <article class="container p-0 ">
      <section class="row justify-content-center text-primary">  <?php if(isset ($feedback) ) echo $feedback ?> </section>
      <h4 class="text-center text-secondary">TESTIMONIAL MANAGE</h4>
      <!--Populates with all available testimonials-->
      <?php foreach($testimonials as $testimonial) {?>
        <section class="testimonial_manage row mt-2 border border-secondary">
          <!-- contact info column 25% width -->
          <div class="col-md-3 p-2 align-self-center">
            <div class="row ">
              <p><?php echo "Name: ". $testimonial['fname']?></p>
            </div>
            <div class="row ">
              <p><?php echo "Date: ". $testimonial['date']?></p>
            </div>
            <div class="row ">
              <p><?php echo "Class: ".$testimonial['class']?></p>
            </div>

          </div>

          <div class="col-md-7">
            <p><?php echo $testimonial['description']?></p>
          </div>
          <!-- with the help of following form element the admin is able to make a testimonial visible or hidden -->
          <form class="col-md-2 float-right text-center p-2" action="admin.php?action=checkTestimonial&amp;id=<?php echo $testimonial['id'] ?>" method="post">
            <select class="w-100" name="check">
              <?php if( $testimonial['approval'] == 1 ): ?>
                <?php echo "<option value='1' selected> Show</option>
                <option value='0'> Hide</option>"?>
              <?php else: ?>
                <?php echo "<option value='1'> Show</option>
                <option value='0' selected> Hide</option>"?>
              <?php endif; ?>
            </select>
            <button type="submit" class="btn btn-info mt-2" name="button">submit</button>
          </form>
        </section>
      <?php } ?>
    </article>
  </section>




  <!--=============================================================-->



  <!-- "Registration-edit" tab  -->
  <section class="tab-pane fade" id="registration" role="tabpanel" aria-labelledby="registration-tab">
    <article  id="registration_page" class="container p-0 mt-2 mx-auto">
      <h4 class="text-center text-secondary">REGISTRATION EDIT</h4>
      <section class="row justify-content-center text-primary"><?php if(isset ($feedback) ) echo $feedback ?></section>
      <div class="row justify-content-center mb-5">

        <!-- Public plan- features box -->
        <div class="col-md-3 card border-secondary p-0 mt-4" >
          <div class="card-header text-center">Public <i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">Public Class</h5>
            <p class="card-text">You can enjoy small size classes with at most 12 trainees.</p>
            <!-- The price it self (170) should be read from the database  -->
            <p>Fee: <?php echo $pricingDetails[0]["amount"] ?></p>

            <form class="text-center" action="admin.php?action=setFees&amp;level=pb" method="post">
              <label for="public">New Fee: </label>
              <!-- the following value should be rea from database -->
              <input id="public" type="text" name="fee">

              <button type="submit" class="btn btn-primary w-100 mt-2" name="pb" value="setPublicFee">submit</button>
            </form>

          </div>
        </div>
        <!-- Private plan- features box -->
        <div class="col-md-3 card border-info p-0 mt-4 ml-md-3 mr-md-3" >
          <div class="card-header text-center">Private <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">Private Class</h5>
            <p class="card-text">You will have your own dedicated trainer during the course only for you.</p>
            <p>Fee:<?php echo $pricingDetails[1]["amount"] ?></p>

            <form class="text-center" action="admin.php?action=setFees&amp;level=pr" method="post">
              <label for="private">New Fee:</label>
              <input id="private" type="text" name="fee">

              <button type="submit" class="btn btn-primary w-100 mt-2" name="pr" value="setPrivateFee">submit</button>
            </form>

          </div>
        </div>
        <!-- VIP plan- features box -->
        <div class="col-md-3 card border-warning p-0 mt-4" >
          <div class="card-header text-center">VIP <i class="fas fa-medal"></i><i class="fas fa-medal"></i><i class="fas fa-medal"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">VIP Class</h5>
            <p class="card-text">In addition to a personal trainer, you will enjoy using all gym's facilities for free.</p>
            <p class="">Fee: <?php echo $pricingDetails[2]["amount"] ?></p>


            <form class="text-center" action="admin.php?action=setFees&amp;level=vp" method="post">
              <label for="vip">New Fee:</label>
              <input id="vip" type="text" name="fee">
              <button type="submit" class="btn btn-primary w-100 mt-2" name="vp" value="setVipFee">submit</button>
            </form>


          </div>
        </div>
      </div>

    </article>
  </section>




  <!--=============================================================-->




  <!-- "homepage-edit" tab: allows editing of the index.php feature boxes  -->
  <section class="tab-pane fade" id="homepage_edit" role="tabpanel" aria-labelledby="homepage_edit-tab">
    <!-- the features boxes main container -->
    <h4 class="text-center text-secondary mt-2">Homepage Edit</h4>
    <section class="row justify-content-center text-primary">  <?php if(isset ($feedback) ) echo $feedback ?> </section>
    <article class="row justify-content-around">

      <div class="card col-sm-5 col-12 mx-auto">
        <h4 class="mx-auto">New Class</h4>
        <img class="card-img-top mx-auto" src="<?php echo $newestClass->img_url;?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?php echo $newestClass->title;?></h5>
          <p class="card-text"><?php echo $newestClass->summary;?></p>
          <!-- creating a form so that upon button press, it is redirected to the edit page with the id of the item to be edited-->
          <form class="" action="admin.php?action=editFeature&amp;id=<?php echo $newestClass->id;?>" method="post">
            <button type="submit" name="editFeature" class="btn btn-primary">Edit</button>
          </form>

        </div>
      </div> <!-- end-card-1 -->

      <div class="card col-sm-5 col-12 mx-auto">
        <h4 class="mx-auto">Special Offer</h4>
        <img class="card-img-top mx-auto" src="<?php echo $offerData['image_url']?>" alt="<?php echo $offerData['title']?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $offerData['title']?></h5>
          <p class="card-text"><?php echo $offerData['summary']?></p>
          <!-- creating a form so that upon button press, it is redirected to the offer edit page-->
          <form class="" action="admin.php?action=editFeature" method="post">
            <button type="submit" name="editOffer" class="btn btn-primary">Edit</button>
          </form>
        </div>
      </div> <!-- end-card-2 -->
    </article><!-- end of row -->
  </section>

</div><!-- end of tabs container -->

</main>
<?php include_once "templates/include/footer.php" ?>
