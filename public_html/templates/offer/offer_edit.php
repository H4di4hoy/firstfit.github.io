<?php include_once "templates/include/header.php" ?>

<?php
//Populate the page with the special offer information for editing
  $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $st=$conn->prepare("SELECT * from offer");
  $st->execute();
  $data= $st->fetch();
  $conn= null;
?>

  <main class="container p-0 row mx-auto">

    <h4 class="w-100 text-center border border-info rounded m-0 p-3 bg-warning">EDIT OFFER</h4>
    <fieldset>
      <!--Pass the relevant action in the header to update the offer details, posts to admin.php-->
      <form class="container border rounded border-info pt-3 pb-3 text-center " action="admin.php?action=updateOffer&amp;id=<?php echo $data['id'] ?>" method="post">

        <ul class=" row list-unstyled ">
        <!-- 'id' field -->
        <li class="col-sm-2 col-3 p-2 border rounded border-secondary text-center font-weight-bold">Offer ID:</li>
        <li class="col-sm-10 col-9 p-0 "><input class="border rounded border-secondary p-2 w-100" type="number" name="id"  readonly value="<?php echo $data['id'] ?>"/></li>
        <!-- 'title' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Title:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="title"  placeholder="title" value="<?php echo $data['title'] ?>" /></li>
        <!-- 'summary' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Summary:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 h-100"  name="summary" id="summary" placeholder="Summary of the article" required maxlength="1000" ><?php echo $data['summary']?></textarea></li>
        <!-- 'description' field -->
        <li class=" col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Description:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><textarea class="border rounded border-secondary p-2 w-100 h-100"  name="description" id="description" placeholder="Full description of the article" ><?php echo $data['description']?></textarea></li>
        <!-- 'title' field -->
        <li class=" col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Date:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="date"  placeholder="<?php echo $data['date']?>" readonly value="" /></li>
        <!-- 'img' field -->
        <li class="col-sm-2 col-3 p-2 mt-2 border rounded border-secondary text-center font-weight-bold">Image_URL:</li>
        <li class="col-sm-10 col-9 p-0 mt-2 "><input class="border rounded border-secondary p-2 w-100" type="text" name="img"  placeholder="Insert address of the image" value="<?php echo $data['image_url']?>" /></li>
        </ul>
        <!-- 'save button' -->
        <button class="btn btn-info w-75 mt-2 " type="submit" name="saveChanges" value="Offer changed">Save Changes</button>
        <!-- 'back button' -->
        <a href="admin.php?active=home" class="btn btn-info w-75 text-center mt-1">Back</a>
      </form>
    </fieldset>

  </main>
<?php include_once "templates/include/footer.php" ?>
