<?php
//User class handles member details


class User {

// 1. Define some user properties

/**
* @var string The email of the user
*/
  public $email= null;

/**
*@var string
*/
  public $password= null;

/**
*@var string
*/
  public $firstName= null;
/**
*@var string
*/
  public $lastName= null;

/**
*@var string
*/
  public $userType;


/**
*@param assoc A constructor to store the user data in variables
*/
public function __construct( $data= array() ) {
  //**debug** var_dump($data);
  if(isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $this->email= $data['email'];
  }

  if(isset($data['password'])) {
    $this->password= $data['password'];
  }

  if(isset($data['fname']) && isset($data['lname'])){
    $this->firstName= preg_replace ( "/[^a-zA-Z]/", "", $data['fname'] );
    $this->lastName= preg_replace ( "/[^a-zA-Z]/", "", $data['lname'] );
  }
}

/**
* @param assoc This function calls the constructor
*/

public function storeFormValues($userData) {
    //**Debug** var_dump($userData);
    $this->__construct($userData);
}

/**
*@param assoc Gets user data from the database to be verified in user.php
*
*/
public static function checkCredentials($userData) {

//**Debug** var_dump($userData);

  $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $sql= "SELECT email, pwd FROM user WHERE(email= :useremail)";
  $st= $conn->prepare($sql);
  $st->bindParam(":useremail", $userData['email'], PDO::PARAM_STR);
  $st->execute();
  $row= $st->fetch();
  $conn= null;

  if($row) {
    if($row['email']== $userData['email'] && $row['pwd']== $userData['password']) {
      return true; //User credentials are valid (match) and exist
    }
  }
  else {
    //**Debug** echo "User not in database or query error";
    return false; //Credentials incorrect or do not exist
  }
}

/**
*@param string //Gets user details by email as the key value
*/
public function getUserDetails($userEmail) {

    $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql= "SELECT id, fName FROM user WHERE(email= :useremail)";
    $st= $conn->prepare($sql);
    $st->bindParam(":useremail", $userEmail, PDO::PARAM_STR);
    $st->execute();
    $row= $st->fetch();
    $conn= null;

    return $row;

}

/**
*@param int //Gets user details by id
*/
public static function getDetailsByID($id) {

  $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $sql= "SELECT email FROM user WHERE(id= :id)";
  $st= $conn->prepare($sql);
  $st->bindParam(":id", $id, PDO::PARAM_STR);
  $st->execute();
  $row= $st->fetch();
  $conn= null;

  return $row;
}

/**
*@param string Checks if the email exists in the records
*/
public static function checkUserEmail($userEmail) {

    //**Debug** echo "checking user email..<br>";
    $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql= "SELECT email FROM user WHERE(email= :useremail)";
    $st= $conn->prepare($sql);
    $st->bindParam(":useremail", $userEmail, PDO::PARAM_STR);
    $st->execute();
    $row= $st->fetch();
    $conn= null;

    //**Debug** var_dump($st->execute());

    if($row) {
      //**Debug** echo "email match was found";
      return true; //Email already exists
    }
    else {
      //**Debug** echo "no match for email, good to go";
      return false; //User can use their email
    }
}

/**
*@param assoc Saves user data to the database
*/

public function insert() {

  $conn= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
  $sql= "INSERT INTO user (email, pwd, fName, lName) VALUES (:email, :password, :fname, :lname)";
  $statement= $conn->prepare($sql);
  $statement->bindValue(":email", $this->email, PDO::PARAM_STR);
  $statement->bindValue(":password", $this->password, PDO::PARAM_STR);
  $statement->bindValue(":fname", $this->firstName, PDO::PARAM_STR);
  $statement->bindValue(":lname", $this->lastName, PDO::PARAM_STR);
  $statement->execute();
  $conn= null;
  }

} //End of User class
