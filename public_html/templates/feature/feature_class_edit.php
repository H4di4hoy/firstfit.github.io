<?php include_once "templates/include/header.php" ?>

<?php
//Retrieve the most recently added class. Populate the page with existing information to be edited
$id = isset( $_GET['id'] ) ? $_GET['id'] : "";
$data=Course::getById($id);
?>

  <main class="container p-0 row mx-auto">
  <h4 class="w-100 text-center border border-info rounded m-0 p-3 bg-warning">EDIT FEATURE CLASS</h4>
    <fieldset>
      <!--Perform the relevant action in the header to save the feature details, posts to admin.php-->
      <form class="container border rounded border-info pt-3 pb-3 text-center " action="admin.php?action=saveCourse&amp;id=<?php echo $data->id?>" method="post">
        <ul class=" row list-unstyled">
          <!-- 'id' field -->
          <li class="col-sm-2 col-3 p-2 border rounded border-secondary text-center font-weight-bold">Class ID:</li>
          <li class="col-sm-10 col-9 p-0 "><input class="border rounded border-secondary p-2 w-100" type="number" name="id"  readonly value="<?php echo $data->id ?>"/></li>
          <!-- 'title' field -->
          <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Title:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="title"  placeholder="title" value="<?php echo $data->title ?>" /></li>
          <!-- 'summary' field -->
          <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Summary:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 h-100"  name="summary" id="summary" placeholder="Summary of the article" required maxlength="1000" ><?php echo $data->summary?></textarea></li>
          <!-- 'description' field -->
          <li class=" col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Description:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 h-100"  name="description" id="description" placeholder="Full description of the article" ><?php echo $data->description?></textarea></li>
          <!-- 'title' field -->
          <li class=" col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Date:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="date"  placeholder="<?php echo $data->date?>" readonly value="" /></li>
          <!-- 'duration' field -->
          <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Duration:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="duration"  placeholder="Duration of the course" value="<?php echo $data->duration ?>" /></li>
          <!-- 'img' field -->
          <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Image_URL:</li>
          <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="img"  placeholder="Insert address of the image" value="<?php echo $data->img_url?>" /></li>
        </ul>
        <!-- 'save button' -->
        <button class="btn btn-info w-75 mt-2 " type="submit" name="saveChanges" value="Course changed">Save Changes</button>
        <!-- 'back button' -->
        <a href="admin.php" class="btn btn-info w-75 text-center mt-1">Back</a>
        <a href="admin.php?action=deleteCourse&amp;id=<?php echo $id?>&amp;title=<?php echo $data->title ?>" class="d-block mx-auto btn-danger btn-info w-75 text-center mt-1">Delete Class</a>
      </form>
    </fieldset>

  </main>
<?php include_once "templates/include/footer.php" ?>
