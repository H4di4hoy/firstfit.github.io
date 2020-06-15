<?php
//Config file, contains main directories for (Class, Member, Admin, Templates) and ADMIN credentials
require_once("config.php");

session_start();


//Check the action value passed in the URL
$action= isset($_GET['action']) ? $_GET['action']: "";
//**Debug** echo $action;

//If there is a user logged-in store their name in this variable for future use
$username= isset($_SESSION['username']) ? $_SESSION['username']: "";


$userID= isset($_SESSION['userID']) ? $_SESSION['userID']: "";


//Stores the page name requested in an initial action before login requirements
$pursue= isset($_GET['pursue']) ? $_GET['pursue'] : "";
//**Debug** echo $_GET['pursue'];

//**Debug** var_dump($_SESSION);

$errorMessage; //Stores error messages if any errors occur


//Call the function based on $action from GET
  switch($action) {

    case "login":
    login();
    break;

    case "signup":
    signUp();
    break;

    case "logout":
    logout();
    break;

    case "classes":
    classesList();
    break;

    case "classDetails":
    classDetails();
    break;

    case "timetable":
    showTimetable();
    break;

    case "contact":
    contactUs();
    break;

    case "testimonial":
    showTestimonials();
    break;

    case "offer":
    showOffer();
    break;

    default:
    homepage();

  }

//Logs in the user and admin, then redirects to index or to a requested page after verification
  function login() {

    global  $action, $pursue, $username, $userID, $errorMessage;

    if ( isset($_POST['login']) ) { //When the user submits the form
      //echo '$_POST'. "is set";
      if ( $_POST['email'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) { //If admin is logging in
        //Set the session key and go to homepage
        $_SESSION['username']= ADMIN_USERNAME;
        $username= $_SESSION['username'];
        require("index.php");
      }
      else if( User::checkCredentials($_POST) == true ) { //If the credentials are verified
        //**Debug** echo "Credentials verified<br>";
        //Get user ID from database to start a user session
        $user= new User; //A new user object with uninitialised data is created
        $userDetails= $user->getUserDetails($_POST['email']);

        $_SESSION['username']= $userDetails['fName'];
        $username= $_SESSION['username'];

        $_SESSION['userID']= $userDetails['id'];
        $userID= $_SESSION['userID'];

        if( empty($pursue) ) { //If no initial requests
          require("index.php");
        }
        else {
          $action= $_GET['secondary'];
          switchAction($action);
        }
      }
      else { //Login details were not correct
        $errorMessage= "Incorrect Login. Try Again";
        require(ACTION_PATH. "/login.php");
      }
    }//if
      else { //Goes to login when the login link is clicked
        //**Debug**  echo "Login required";
        require(ACTION_PATH. "/login.php");
      }
  }

/* This function handles user signing up with a new email and password
  When the form is submitted, proceed through signup, if not submitted,
  go to signup form by default.
*/
function signUp() {

global $username, $pursue, $secondary;
//echo $pursue;


if( isset($_GET['secondary']) ) { //Follows up with this action after sign up
  $secondary= $_GET['secondary'];
  //**Debug** echo $secondary;
}

  if( isset( $_POST['signup'] ) ) {
    //**Debug** echo "Sign up is set";
    //**Debug** var_dump($_POST);
    $results= array();

    if( User::checkUserEmail($_POST['email']) == false ) { //If the email is not already existing

      if($_POST['password'] == $_POST['passverify']) { //Ensure password match
        $newUser= new User;
        $newUser->storeFormValues($_POST); //Store the user details in the $newUser object
        // **Debug** echo "User details stored";

        $newUser->insert(); //Save the user data to the database

        // **Debug** echo "User data saved in the database";
        $_SESSION['username']= $newUser->firstName;
        $feedback="You are now Signed Up!";

        require(ACTION_PATH."/confirm_signup.php");
      }
      else {
        $errorMessage= "Passwords do not match";
        require(ACTION_PATH."/signup.php");
      }

    }
    else {
      $errorMessage= "An account with this email already exists";
      require(ACTION_PATH."/signup.php");
    }
  }
  else { //When sign up is clicked
    require(ACTION_PATH."/signup.php");
  }

}


  // Logs out the user
  function logout() {
    //**Debug** echo "Logout is called";
    global $username, $userID;

    $username=null;
    $userID= null;

    unset($_SESSION['username']);

    require("index.php");
  }

  //List the classes on the class_list page
  function classesList() {

  global $username, $userID;

  require(TEMPLATE_PATH."/class/class_list.php");
  }

  //Goes to the class details page if the user is logged in
  function classDetails() {

    global $username, $userID, $pursue, $errorMessage;

    if( empty($username) ) { //As long as the user is not logged in, go to login function which brings the login page
      $errorMessage= "Please log in first";
      login();
    }

    if(!empty($username)) { //If login is successful upon return from the login function, go to details

      require(TEMPLATE_PATH."/class/class_details.php");
    }
  }

  //Goes to contact_us page and sends the inquiry when user submits
  function contactUs() {

   global $username, $userID;

   if( isset($_POST['sendMessage']) ) {

     $email= $_POST['email'];
     $name= $_POST['name'];
     $phone= $_POST['phone'];
     $desc= filter_var($_POST['desc'], FILTER_SANITIZE_STRING);

     $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
     $sql= "INSERT INTO contact_us (fname, email, phone, description) VALUES (:fname, :email, :phone, :descr)";
     $st= $conn->prepare($sql);
     $st->bindValue( ":fname",$name, PDO::PARAM_STR);
     $st->bindValue( ":email",$email, PDO::PARAM_STR);
     $st->bindValue( ":phone",$phone, PDO::PARAM_INT);
     $st->bindValue( ":descr",$desc, PDO::PARAM_STR);
     $st->execute();
     $conn= null;

     $feedback="Thank you. We will be in contact with you ASAP";

     require(TEMPLATE_PATH. "/contact_us.php");
   }
   else {
      require(TEMPLATE_PATH. "/contact_us.php");
   }
  }

  //Shows the testimonial page populated with member testimonials
  function showTestimonials() {

    global $username, $userID;
    require(TEMPLATE_PATH."/testimonial.php");
  }

  //Goes to the special offer page
  function showOffer() {

    global $username, $userID;
    require(TEMPLATE_PATH."/offer/offer_details.php");
  }

  //Goes to homepage, its the default action of user.php
  function homepage() {
    require("index.php");
  }

  /*This function is explicitly called to perform a secondary action after login
  usually only needed when user requests class details after signing up*/
  function switchAction($action) {

    switch($action) {

      case "login":
      login();
      break;

      case "signup":
      signUp();
      break;

      case "logout":
      logout();
      break;

      case "classes":
      classesList();
      break;

      case "classDetails":
      classDetails();
      break;

      case "timetable":
      showTimetable();
      break;

      case "contact":
      contactUs();
      break;

      case "testimonial":
      showTestimonials();
      break;

      case "offer":
      showOffer();
      break;

      default:
      homepage();

    }
  }


?>
