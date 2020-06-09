<?php include_once "templates/include/header.php" ?>

<?php

/*Retrieve class titles to populate dropdown list,
 a registration includes the class, fee, and correspoding membership type
 */

$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sql = "SELECT title FROM class;";
$st = $conn->prepare( $sql );
$st->execute();
$data= array();

while( $row= $st->fetch() ) {
$data[]= $row;
}

/* **Debug**
var_dump($data);
echo $data[0]["title"];
*/
//Get the fee values from the database
$sql = "SELECT * FROM fee";
$st = $conn->prepare( $sql );
$st->execute();
$data2= array();

while( $row2= $st->fetch() ) {
$data2[]= $row2;
}
$conn= null;

   ?>

    <main  id="registration_page" class="container p-0 mx-auto">
      <h4 class="text-center mt-4">Registration Plans</h4>
      <section class="row justify-content-center mb-5">

        <section class="col-md-3 card border-secondary p-0 mt-4">
          <div class="card-header text-center">Public <i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">Public Class</h5>
            <p class="card-text">You can enjoy small size classes with at most 12 trainees.</p>
            <p>Fee: <?php echo $data2[0]["amount"]?></p>

            <form class="text-center" action="member.php?action=register&amp;username=<?php echo $username?>&amp;userid=<?php echo $userID?>" method="post">
              <label for="public">Choose your desired class:</label>
              <select id="public" class="w-100" name="vip">
                <?php foreach( $data as $results ) {?>
                <option value=""><?php echo $results['title']?></option>
                <?php }?>

              </select>
              <button type="submit" class="btn btn-primary w-100 mt-2" name="registerpublic" value="pb">Register</button>
            </form>

          </div>
        </section>
        <!-- Private Class- features box -->
        <section class="col-md-3 card border-info p-0 mt-4 ml-md-3 mr-md-3" >
          <div class="card-header text-center">Private <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">Private Class</h5>
            <p class="card-text">You will have your own dedicated trainer during the course only for you.</p>
            <p>Fee: <?php echo $data2[1]["amount"] ?></p>

            <form class="text-center" action="member.php?action=register&amp;username=<?php echo $username?>&amp;userid=<?php echo $userID?>" method="post">
              <label for="private">Choose your desired class:</label>
              <select id="private" class="w-100" name="vip">
                <?php foreach( $data as $results ) {?>
                <option value=""><?php echo $results['title']?></option>
                <?php }?>

              </select>
              <button type="submit" class="btn btn-primary w-100 mt-2" name="registerprivate" value="pr">Register</button>
            </form>

          </div>
        </section>
        <!-- VIP Class- features box -->
        <section class="col-md-3 card border-warning p-0 mt-4" >
          <div class="card-header text-center">VIP<i class="fas fa-medal"></i><i class="fas fa-medal"></i><i class="fas fa-medal"></i></div>
          <div class="card-body text-dark">
            <h5 class="card-title">VIP Class</h5>
            <p class="card-text">In addition to a personal trainer, you will enjoy using all gym's facilities for free.</p>
            <p class="">Fee: <?php echo $data2[2]["amount"] ?></p>


            <form class="text-center" action="member.php?action=register&amp;username=<?php echo $username?>&amp;userid=<?php echo $userID?>" method="post">

              <label for="vip">Choose your desired class:</label>

              <select id="vip" class="w-100" name="vip">
                <?php foreach( $data as $results ) {?>
                <option value=""><?php echo $results['title']?></option>
                <?php }?>
              </select>

              <button type="submit" class="btn btn-primary w-100 mt-2" name="registervip" value="vp">Register</button>
            </form>

          </div>
        </section>
      </section>
    </main>
<?php include_once "templates/include/footer.php" ?>
