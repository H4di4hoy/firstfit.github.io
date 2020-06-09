<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Europe/Dublin" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=s3013927" );
define( "DB_USERNAME", "s3013927" );
define( "DB_PASSWORD", "zestsums" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "ACTION_PATH", "php_action" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "root" );
define( "ADMIN_PASSWORD", "hadi" );
define( "ADMIN_EMAIL", "abc@live.com" );
require(CLASS_PATH . "/Course.php");
require(CLASS_PATH . "/User.php");

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";

  error_log( $exception->getMessage() );
}

set_exception_handler( 'handleException' );
?>
