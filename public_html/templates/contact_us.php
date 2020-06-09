<?php include_once "include/header.php" ?>
  <main class="container p-0 mx-auto">

  <h2 class="text-secondary text-center mt-4">Contact Us</h2>
  <section class="h3 text-secondary text-center mt-4">
    <p><?php if( isset($feedback) ) echo $feedback?></p><!--Show a feedback message if any-->
  </section>
    <div class="row justify-content-center">
      <div class="col-12 col-md-8  pb-5">

        <!-- the Contact_us form -->
        <!--Posts user information to be stored in the database for later retrieval-->
        <form action="user.php?action=contact" method="post">
          <div class="card border-dark rounded">
          <div class="card-header p-0">
          <div class="bg-info text-white text-center p-2">
          <h3><i class="fa fa-envelope"></i> Contact us</h3>
          <!-- <p class="m-0">we will replay back soon</p> -->
          </div>
          </div>
            <div class="card-body p-3">

            <!--Body-->
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
                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                  </div>
                  <input type="email" class="form-control"  name="email" placeholder="example@gmail.com" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-phone-alt text-info"></i></div>
                  </div>
                  <input type="tel" class="form-control"  name="phone" placeholder="phone number" required>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                  </div>
                  <textarea class="form-control" name="desc" placeholder="Leave your message here" required></textarea>
                </div>
              </div>



            <button class=" btn btn-info btn-block rounded p-2" type="submit" name="sendMessage" value="MessageSent">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
<?php include_once "include/footer.php" ?>
