<?php
//Member= logged in user
//This script handles member's requests/actions
require_once("config.php");


$action= isset($_GET['action']) ? $_GET['action']: ""; //Check the action value passed in the URL
//**Debug** echo $action;
$username= isset($_GET['username']) ? $_GET['username']: ""; //If there is a user logged-in store their name in this variable for future use
//**Debug** echo $username;

$userID= isset($_GET['userid']) ? $_GET['userid']: ""; //Stores the user id for later use
//**Debug** echo $userID;

$pursue= isset($_GET['pursue']) ? $_GET['pursue'] : ""; //Stores initial requests

$feedback;  //Stores any feedback messages

  //Call the function based on $action from GET
  switch($action) {

    case "register":
    registerMember();
    break;

    case "testimonial":
    addTestimonial();
    break;

    case "logout":
    logout();
    break;

    default:
    homepage();

  }

  function registerMember() {

    global $username, $userID;
    //Member is already logged in by now

     if( isset($_POST['registerpublic']) ) {
       //Set membership as group
       setMemberShip($_POST['registerpublic']);
     }
     else if( isset($_POST['registerprivate']) ) {
       //Set membership as one-on-one
       setMemberShip($_POST['registerprivate']);
     }
     else if( isset($_POST['registervip']) ){
       //Set membership as Full access
       setMemberShip($_POST['registervip']);
     }
     else { //When member clicks on register for a class
       require(ACTION_PATH."/registration.php");
     }

  }

  //Creates a registration record for the user with their membership details
  function setMemberShip($type) {

    global $username, $userID, $feedback;

    $email= User::getDetailsByID($userID);

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql= "INSERT INTO registration (email_fk, pay_scheme) VALUES (:email, :type)";
    $st= $conn->prepare($sql);
    $st->bindValue( ":email", $email['email'], PDO::PARAM_STR);
    $st->bindValue( ":type", $type, PDO::PARAM_STR);
    $st->execute();
    $conn= null;

    $feedback="You are now registered";

    require(ACTION_PATH."/confirm_registration.php");

  }

  //Allows a member to share their experience
  function addTestimonial() {

    global $username, $userID;

    if(isset($_POST['submitTest']) ) { //When the form is submitted
      $class= $_POST['class'];
      $email= User::getDetailsByID($userID);
      $date= $_POST['date'];
      $title= $_POST['title'];
      $desc= filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
      //**debug** var_dump($_POST)

      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $sql = "INSERT INTO testimonial (class, email, date, title, description) VALUES (:class, :email, :dt, :title, :descr)";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":class", $class, PDO::PARAM_STR);
      $st->bindValue( ":email", $email['email'], PDO::PARAM_STR);
      $st->bindValue( ":dt", $date, PDO::PARAM_STR);
      $st->bindValue( ":title", $title, PDO::PARAM_STR);
      $st->bindValue( ":descr", $desc, PDO::PARAM_STR);
      $st->execute();
      $conn= null;

      $feedback= "Thank you for sharing!";

      require(TEMPLATE_PATH. "/member/testimonial_add.php");
    }
    else { //When member clicks on add testimonial
      require(TEMPLATE_PATH. "/member/testimonial_add.php");
    }

  }

  //Goes to homepage
  function homepage() {

    global $username, $userID;
    require("index.php");

  }

  /*A member is logged out from the user.php script in order to unset the session details from
  a single point*/
  
  function logout() {
    header("Location: user.php?action=logout");
  }



?>
