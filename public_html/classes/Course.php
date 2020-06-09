<?php

//Course class handles the different classes on the website
class Course {


/**
* @var int The id of the class
*/
public $id= null;

/**
* @var string The title
*/
public $title=null;

/**
* @var string
*/
public $summary=null;

/**
* @var string
*/
public $description= null;

/**
* @var string
*/
public $page_name=null;

/**
* @var string
*/
public $duration=null;

/**
* @var string
*/
public $img_url=null;
/**
* @var string
*/
public $date=null;


  // A constructor to set put the class information into variables
  public function __construct( $data=array() ) {

    if ( isset( $data['class_id'] ) ) $this->id = (int) $data['class_id'];
    if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
    if ( isset( $data['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['summary'] );
    if ( isset( $data['description'] ) ) $this->description = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['description'] );
    if ( isset( $data['page_name_fk'] ) ) $this->page_name = $data['page_name_fk'];
    if ( isset( $data['duration'] ) ) $this->duration = $data['duration'];
    if ( isset( $data['image_url'] ) ) $this->img_url = $data['image_url'];
    if ( isset( $data['date'] ) ) $this->date = $data['date'];

  }

  /**
  *@param int// Gets all class information by ID, can be called without an instance
  */
  public static function getById( $id ) {

     $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
     $sql = "SELECT * FROM class WHERE class_id = :id";
     $st = $conn->prepare( $sql );
     $st->bindValue( ":id", $id, PDO::PARAM_INT );
     $st->execute();
     $row = $st->fetch();
     $conn = null;
     if ( $row ) return new Course( $row );
   }

  //Returns an array of a list of classes, and the number of total classes retrieved
  public static function getList() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM class";
    $st = $conn->prepare( $sql );
    $st->execute();
    $list= array();

      while( $row= $st->fetch() ) {
        $class= new Course($row);
        $list[]= $class;
      }

      $sql = "SELECT FOUND_ROWS() AS totalRows";
      $totalRows = $conn->query( $sql )->fetch();
      $conn= null;
      return ( array( "results"=> $list, "totalRows"=>$totalRows[0] ) );
  }

  /**
  *@param string //Retrieves a class by its page name
  */
  public static function getByPage( $page ) {

     $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
     $sql = "SELECT * FROM class WHERE (page_name_fk = :page)";
     $st = $conn->prepare( $sql );
     $st->bindValue( ":page", $page, PDO::PARAM_STR );
     $st->execute();
     $row = $st->fetch();
     $conn = null;

     if ( $row ) return new Course( $row );
  }

  //Gets the most recently added class
  public static function getNewestClass() {

    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $sql = "SELECT * FROM class ORDER BY date LIMIT 1";
    $st = $conn->prepare( $sql );
    $st->execute();
    $result= $st->fetch();
    $conn= null;

    if($result) return new Course($result);
  }

}//End of Course class
?>
