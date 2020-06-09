<?php include_once "templates/include/header.php" ?>
<?php
/*Retrieve the member's information from the database,
shows the member's most recently created membership
*/
$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sql="SELECT fName,lName, email, pay_scheme, amount FROM user, registration, fee WHERE (user.id= :id) AND user.email= registration.email_fk AND pay_scheme= level_fk";
$st= $conn->prepare($sql);
$st->bindValue( ":id", $userID, PDO::PARAM_INT);
$st->execute();
$row= $st->fetch();
$conn= null;
 ?>

  <main class="container">
    <section class="row justify-content-start">
      <section class="d-flex flex-column col ">
        <!--Populate this section with the membership details of the member-->
        <section class="row h2 text-info">  <?php if(isset ($feedback) ) echo $feedback ?> </section>
        <p class="h3 p-3 text-secondary">Membership Details</p>
        <p class="h4 p-3 text-secondary">Name: <?php echo $row['fName'] ." ". $row['lName']?></p>
        <p class="h4 p-3 text-secondary">Email: <?php echo $row['email']?></p>
        <p class="h4 p-3 text-secondary">Membership Type: <?php if($row['pay_scheme']== 'pb'):?>
          <?php echo "Public" ?>
          <?php elseif($row['pay_scheme']== 'pr'):?>
          <?php echo "Private"?>
          <?php else: echo "VIP"?>
          <?php endif;?></p>
        <p class="h4 p-3 text-secondary">Monthly due: <?php echo $row['amount']?></p>
        <div class="container-fluid align-self-center">
          <a href='member.php?username=<?php echo $username ?>&amp;userid=<?php echo $userID?>' class="d-block btn btn-info w-75 mx-auto mt-2">Return to Home</a>
        </div>
      </section>
    </section>
  </main>
<?php include_once "templates/include/footer.php" ?>
