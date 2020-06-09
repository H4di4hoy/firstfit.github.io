<?php include_once "templates/include/header.php" ?>

  <main class="container p-0 row mx-auto">
  <!-- I need to catch and get the id of desired course through the $_get method which should be sent to here inside the url to pass it to my getById method. -->
  <section class="row justify-content-center text-primary"><?php if(isset ($feedback) ) echo $feedback ?></section>

  <h4 class="w-100 text-center border border-info rounded m-0 p-3 bg-success">CREATE FORM</h4>
    <fieldset>
      <!--A new class is created after posting to admin.php-->
      <form class="container border rounded border-info pt-3 pb-3 text-center " action="admin.php?action=createCourse" method="post">

        <ul class=" row list-unstyled ">
        <!-- 'id' field "as the id is defined auto increment in database I comment it here"
        <li class="col-sm-2 col-3 p-2 border rounded border-secondary text-center font-weight-bold">id:</li>
        <li class="col-sm-10 col-9 p-0 "><input class="border rounded border-secondary p-2 w-100" type="number" name="id" /></li> -->
        <!-- 'title' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Title:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="title" required placeholder="title"/></li>
        <!-- 'summary' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Summary:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 h-100"  name="summary" id="summary" placeholder="Summary of the article" required maxlength="1000" ></textarea></li>
        <!-- 'description' field -->
        <li class=" col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Description:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 " rows="5"  name="description" id="description" placeholder="Full description of the article" ></textarea></li>
        <!-- 'title' field -->
        <!-- 'duration' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Duration:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="duration"  placeholder="Duration of the course"/></li>
        <!-- 'img' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Image_URL:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="img"  placeholder="Image url" /></li>

        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Page_URL:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="page"  placeholder="E.g: page.php" required maxlength="100"/></li>
        </ul>
      <!-- 'save button' -->
      <button class="btn btn-info w-75 mt-2 " type="submit" name="create" value="Create Class">Save Changes</button>
      <!-- 'back button' -->
      <a href="admin.php" class="btn btn-info w-75 text-center mt-1">Back</a>
      </form>
    </fieldset>

  </main>
<?php include_once "templates/include/footer.php" ?>
