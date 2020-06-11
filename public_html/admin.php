<?php
require_once("config.php");
session_start();

//Check the action value passed in the URL
$action= isset($_GET['action']) ? $_GET['action']: "";

//If there is a user logged-in store their name in this variable for future use
$username= isset($_SESSION['username']) ? $_SESSION['username']: "";

if ( empty($username) ) {
  header("Location: index.php");
  exit();
}

$feedback;

  //Call the function based on $action from GET
  switch($action) {

  case "getMessages":
  getMessages();
  break;

  case "createCourse":
  createCourse();
  break;

  case "editCourse":
  editCourse();
  break;

  case "saveCourse":
  saveCourseChanges();
  break;

  case "deleteCourse":
  deleteCourse();
  break;

  case "editFeature":
  editFeature();
  break;

  case "updateOffer":
  updateOffer();
  break;

  case "checkTestimonial":
  checkTestimonial();
  break;

  case "setFees":
  setRegistrationFees();
  break;

  case "logout":
  logout();
  break;

  default:
  controlPanel();

  }

  //Inserts new data into the database when a class is created
  function createCourse() {

    global $feedback;

    if( isset($_POST['create']) ) { //When the admin submits the form
      $newTitle= $_POST['title'];
      $newSum= $_POST['summary'];
      $newDesc= $_POST['description'];
      $newDuration= $_POST['duration'];
      $newImage= $_POST['img'];
      $pageUrl= $_POST['page'];

      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql= "INSERT INTO page (page_name) VALUES (:page);
      INSERT INTO class (title, summary, description, duration, page_name_fk, image_url) VALUES (:title, :summary, :descr, :duration, :page, :img);";
      $st= $conn->prepare($sql);
      $st->bindValue( ":page", $pageUrl, PDO::PARAM_STR);
      $st->bindValue( ":title", $newTitle, PDO::PARAM_STR);
      $st->bindValue( ":summary", $newSum, PDO::PARAM_STR);
      $st->bindValue( ":descr", $newDesc, PDO::PARAM_STR);
      $st->bindValue( ":duration", $newDuration, PDO::PARAM_STR);
      $st->bindValue( ":img", $newImage, PDO::PARAM_STR);
      $st->execute();
      //$newRows= $st->rowCount();

      $conn= null;
      $feedback= "Class added successfully";
      controlPanel(); //Goes back to the admin control panel with updated information
    }
    else { //The admin just requested the course create page
      //$feedback= "Course Create was not set!";
      require(TEMPLATE_PATH. "/class/course_create.php");
    }
  }

  //Gets the course edit page
  function editCourse() {

    global $username, $feedback;
    require(TEMPLATE_PATH. "/class/course_edit.php");
  }

  //Saves any changes made in the course edit page when the save changes button is clicked
  function saveCourseChanges() {

    global $feedback;

    if (isset ($_POST['saveChanges']) && isset($_GET['id']) ) {
      $newTitle= $_POST['title'];
      $newSum= $_POST['summary'];
      $newDesc= $_POST['description'];
      $newDate= $_POST['date'];
      $newDuration= $_POST['duration'];
      $newImage= $_POST['img'];
      $classID= $_GET['id'];


      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql ="UPDATE class SET title= :title, summary= :summary, description= :descr, duration= :duration, image_url= :img WHERE class_id= :id AND EXISTS (SELECT * FROM (SELECT * FROM class WHERE class_id= :id) tempTable)";
      $st= $conn->prepare( $sql );
      $st->bindValue( ":title", $newTitle, PDO::PARAM_STR);
      $st->bindValue( ":summary", $newSum, PDO::PARAM_STR);
      $st->bindValue( ":descr", $newDesc, PDO::PARAM_STR);
      $st->bindValue( ":duration", $newDuration, PDO::PARAM_STR);
      $st->bindValue( ":img", $newImage, PDO::PARAM_STR);
      $st->bindValue( ":id", $classID, PDO::PARAM_INT);
      $st->execute();
      $conn= null;

      $feedback= "Class was updated successfully";
    }
    else { //Debugging: if the form variables were not set
      $feedback= "Check or ID is not set!";
    }

    //Actions are followed by redirection to admin panel using this function.
    controlPanel();

  }

  //Allows the admin to delete a course, admin must confirm before deletion
  function deleteCourse() {

    global $feedback, $id, $classTitle;

    $id= $_GET['id'];

    if( isset($_GET['title']) ) { //Display this variable in the confirm_delete page as the title of the class to delete
    $classTitle= $_GET['title'];
    }

    //**Debug** echo $id;

    if($_GET['action'] == 'deleteCourse' && isset ($_GET['pursue']) ) { //When the form has been submitted and delete is confirmed

      if( isset($_GET['id']) && $_GET['pursue']== 'confirm' ) {// makes sure class id and confirm were set in the url

        $conn= $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql ="DELETE FROM class WHERE class_id= :id";
        $st= $conn->prepare($sql);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $conn= null;
        $feedback= "Class deleted successfully";
      }
      else { //Else something went wrong in the query or the header parameters
        $feedback= "ID was not set!";
      }
      controlPanel(); //Go to admin panel after deletion is complete
    }
    else { //Confirm before deleting
     require(TEMPLATE_PATH."/class/confirm_delete.php");
    }

  }

  //Gets the special offer from the database
  function getOffer() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $st=$conn->prepare("SELECT * from offer");
    $st->execute();
    $data= $st->fetch();
    $conn= null;

    return $data;
  }

  //Called when the admin changes feature boxes on index page
  function editFeature() {


    if( isset( $_POST['editFeature']) ) { //When admin submits the relevant form
      //load the corresponding feature edit page
      require(TEMPLATE_PATH."/feature/feature_class_edit.php");
    }
    else if( isset( $_POST['editOffer']) ) {
      //load the corresponding offer edit page
      require(TEMPLATE_PATH."/offer/offer_edit.php");
    }
  }

  //Saves the changes from the offer_edit page
  function updateOffer() {

    global $feedback;

    if(isset($_POST['saveChanges'])) { //When the form is submitted

      $title= $_POST['title'];
      $summ= $_POST['summary'];
      $desc= $_POST['description'];
      $img= $_POST['img'];
      $id= $_GET['id'];

      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql ="UPDATE offer SET title = :title, summary= :summary, description= :description,
      image_url= :img WHERE id = :id";
      $st= $conn->prepare($sql);
      $st->bindValue( ":title", $title, PDO::PARAM_STR);
      $st->bindValue( ":summary", $summ, PDO::PARAM_STR);
      $st->bindValue( ":description", $desc, PDO::PARAM_STR);
      $st->bindValue( ":img", $img, PDO::PARAM_STR);
      $st->bindValue( ":id", $id, PDO::PARAM_INT);
      $st->execute();
      $conn= null;

      $feedback="Offer updated successfully";
      controlPanel(); //go back to admin panel
    }
    else { //Else something went wrong in the query or the header parameters
      $feedback="Save changes was not set!";
      controlPanel(); //go back to admin panel
    }

  }

  //Allows the admin to check the testimonials whether they should be displayed or not
  function checkTestimonial() {

    global $feedback;

    if( isset($_POST['check']) && isset($_GET['id']) ) { //When the form is submitted
      $check= $_POST['check'];
      $id= $_GET['id'];

      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql ="UPDATE testimonial SET approval = :ck WHERE id = :id";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":ck", $check, PDO::PARAM_STR);
      $st->bindValue( ":id", $id, PDO::PARAM_INT);
      $st->execute();
      $conn= null;

      $feedback= "Testimonial updated successfully";
    }
    else { // Something went wrong in the query or the header parameters
      $feedback= "Check or ID is not set!";
    }

    controlPanel(); //Go back to admin panel

  }

  //Logs out from a single point (user.php)
  function logout() {
    header("Location: user.php?action=logout");
  }

  //Loads the registration fees for each membership level
  function getRegistrationDetails() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM fee";
    $st = $conn->prepare( $sql );
    $st->execute();
    $data= array();

    while( $row= $st->fetch() ) {
    $data[]= $row;
    }

    $conn= null;

    return $data; //Returns rows as an array
  }

  //Retrieves messages sent to the admin via the contact_us form
  function getMessages() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM contact_us";
    $st = $conn->prepare( $sql );
    $st->execute();
    $results= array();

    while($row=$st->fetch()) {
      $results[]= $row;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn= null;

    //returns results as an array of messages and total messages retrieved
    return (array("messages"=> $results, "totalRows"=> $totalRows[0]));
  }

  //Retrieves all testimonials for the admin to review
  function getTestimonials() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT testimonial.id, fname, description, approval, date, class FROM testimonial, user WHERE user.email=testimonial.email";
    $st = $conn->prepare( $sql );
    $st->execute();
    $results= array();

    while($row=$st->fetch()){
      $results[]= $row;
    }
    $conn= null;
    return $results;
  }

  //Allows the admin to change the registration fees
  function setRegistrationFees() {

    global $feedback;

    if( isset($_POST['fee']) && isset($_GET['level']) ) { //When the form is submitted with required values
      $newAmount= $_POST['fee'];
      $level= $_GET['level'];

      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql= "UPDATE fee SET amount = :amount WHERE level_fk = :level";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":amount", strval($newAmount), PDO::PARAM_STR);
      $st->bindValue( ":level", $level, PDO::PARAM_STR);
      $result= $st->execute();
      $conn= null;

      $feedback= "Fees updated successfully";
    }
    else { // Something went wrong in the query or the header parameters
      $feedback= "Fees or level is not set!";
    }

    controlPanel(); //Return to admin panel
  }

  //Default behaviour of admin.php. Retrieves information to be displayed and goes to admin panel
  function controlPanel() {

    global $username, $feedback, $active;

    $classes = Course::getList(); //List of course objects and totalRows
    $newestClass= Course::getNewestClass(); //A single course object sorted as most recent
    $offerData= getOffer();
    $messages= getMessages(); //A list of messages and totalRows
    $testimonials= getTestimonials(); // A list of all testimonials
    $pricingDetails= getRegistrationDetails(); //A list of different pricing levels

    require(TEMPLATE_PATH. "/admin/admin_manage.php");

  }

?>
