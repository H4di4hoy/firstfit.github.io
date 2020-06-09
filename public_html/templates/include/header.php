<?php require_once("config.php"); ?>
<?php global $username, $userID; //Use these variables at every stage in the header ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Source+Sans+Pro:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <!--Fontawesome-->
   <link rel="stylesheet" href="fontawesome/css/all.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css" />
    <title>First Fit</title>
  </head>

  <body class="container">
    <header>
      <nav class="container navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand text-uppercase" href="index.php">First Fit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainTopNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainTopNav">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="user.php?">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="user.php?action=classes">Classes</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="user.php?action=contact">Contact us</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="user.php?action=testimonial">Testimonials</a>
            </li>

            <li class="nav-item">

              <!--Header adapts to public, member, or admin permissions-->
              <?php if( !empty($username) && $username== ADMIN_USERNAME ): ?><!--Admin header-->
                <?php echo
                "<li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown'>Admin</a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='admin.php?'>Admin Panel</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='admin.php?action=logout'>Logout</a>
                  </div>
                </li>"?>
              <?php elseif(!empty( $username )) : ?><!--Member header-->
                  <?php echo
                  "<li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle font-weight-bold' id='navbarDropdown' role='button' data-toggle='dropdown'>$username</a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                      <a class='dropdown-item' href='member.php?action=testimonial&amp;userid=$userID&amp;username=$username'>Write a testimonial</a>
                      <div class='dropdown-divider'></div>
                      <a class='dropdown-item' href='member.php?action=logout'>Logout</a>
                    </div>
                  </li>"?>
              <?php else:?><!--Public header-->
                <?php echo"<a class='nav-link' href='user.php?action=login'>Log In</a>" ?>
              <?php endif ;?>

            </li>
          </ul>
          <section>
          <?php if(!empty( $username )) : ?><!--Username is displayed if logged in-->
          <?php echo "<section class='p-1 rounded bg-dark'>
            <p class='my-1 text-light'>
              <span>Welcome $username</span>
            </p>
          </section>"?>
          <?php endif; ?>
          </section>
        </div>
      </nav>

    </header>
