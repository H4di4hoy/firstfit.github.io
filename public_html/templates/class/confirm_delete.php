<?php include_once "templates/include/header.php" ?>
  <main class="container">
    <section class="row justify-content-center">
      <section class="d-flex flex-column col-6 ">
        <!--Asks admin to confirm deletion of class before proceeding-->
        <p class="h2 p-3 text-center text-secondary">Delete <?php echo $classTitle?>?</p>
        <div class="container-fluid align-self-center">
          <!--If admin clicks yes, action is delete and the class is deleted by its id -->
          <a href='admin.php?action=deleteCourse&amp;pursue=confirm&amp;id=<?php echo $id?>' class="d-block btn btn-info w-75 mx-auto mt-2">Yes</a>
          <!--Cancels delete and returns to course edit page -->
          <a href='admin.php?action=course_edit' class="d-block btn btn-info w-75 mx-auto mt-2">No</a>
        </div>
      </section>
    </section>
  </main>
<?php include_once "templates/include/footer.php" ?>
