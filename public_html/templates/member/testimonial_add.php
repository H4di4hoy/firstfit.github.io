<?php include_once "templates/include/header.php"?>

<?php

//Get the class title from the database to allow the member to select the class for their testimonial
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sql = "SELECT class_id, title FROM class";
$st = $conn->prepare( $sql );
$st->execute();
$data= array();

  while( $row= $st->fetch() ) {
    $data[]= $row;
  }

$conn= null;
?>
  <main class="container p-0 mx-auto">
    <h2 class="text-secondary text-center mt-4">Testimonial</h2>
    <section class="h3 text-secondary text-center mt-4">
      <p><?php if( isset($feedback) ) echo $feedback?></p><!--Show feedback when form is sent-->
    </section>
    <div class="row justify-content-center">
      <div class="col-12 col-md-8  pb-5">
        <!-- the Contact_us form :: username and id are passed in the url along with the relevant action to submit-->
        <form action="member.php?action=testimonial&amp;username=<?php echo $username?>&amp;userid=<?php echo $userID?>" method="post">
          <div class="card border-dark rounded">
            <div class="card-header p-0">
              <div class="bg-info text-white text-center p-2">
                <h3>We want to hear from you!</h3>
                <!-- <p class="m-0">we will replay back soon</p> -->
              </div>
            </div>
            <div class="card-body p-3">

              <!--Body-->
              <!-- Class list -->
              <select class=" w-100 p-2 border border-secondary rounded text-secondary mb-3" name="class" required>
                <option  value=""> Select the class you attended: </option>

                <?php foreach($data as $class) {?><!--Populate the class dropdown list-->
                <option value="<?php echo $class['title']?>"><?php echo $class['title']?></option>
                <?php } ?>
              </select>
              <!-- 'Date' form-group -->
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-calendar-alt text-info"></i></div>
                  </div>
                  <input type="date" class="form-control"  name="date"  required>
                </div>
              </div>
              <!-- 'Name' form-group -->
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                  </div>
                  <input type="text" class="form-control"  name="name" placeholder="Enter your name" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                  </div>
                  <textarea class="form-control" name='title' placeholder="Title" required></textarea>
                </div>
              </div>
              <!-- 'Testimonial' form-group -->
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                  </div>
                  <textarea class="form-control" name='desc' placeholder="Leave your testimonial here" required></textarea>
                </div>
              </div>



            <button class=" btn btn-info btn-block rounded p-2" type="submit" name="submitTest" value="testimonial submitted">Submit</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </main>
<?php include_once "templates/include/footer.php"?>
