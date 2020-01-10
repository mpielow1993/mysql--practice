<?php
/*

Create a user sign-up form that will

Ask for email and password
Check that the email and password have been entered
Check that the email address is not duplicated
Signs the user up

*/

$user = 'root';
$password = '';
$db=  'sampledb';

$link = mysqli_connect('localhost', $user, $password, $db);
$connectionError = mysqli_connect_error();

if ($connectionError) {
  die("Connection Failed");
}

session_start();
  //$test = true;
  $keys = array('firstName', 'lastName', 'email', 'password', 'passwordConfirmation');
  $attributes = array();
  $errorCounter = 0;
  foreach($keys as $key)
    if (array_key_exists($key, $_POST)) {
      if ($_POST[$key] == '') {
        echo "<p>".ucwords(preg_replace('/[A-Z]/', " $0", $key))." cannot be empty</p>";
        ++$errorCounter;
      } else {
        if ($key == 'email') {
          $_email = mysqli_real_escape_string($link, $_POST[$key]);
          $query = "SELECT `User_ID` FROM `Users` WHERE `Email` = '".$_email."'";
          $result = mysqli_query($link, $query);
          $rows = mysqli_num_rows($result); //number of rows returned
          //print_r($rows);
          if ($rows > 0) {
            echo "<p>Email address '".$_POST[$key]."' is already in use</p>";
            ++$errorCounter;
          }
        }
      }
    }

    if ($_POST[$keys[3]] != $_POST[$keys[4]]) {
      echo "<p>Password &amp; Password Confirmation must match</p>";
      ++$errorCounter;
    }

    if($errorCounter == 0) {
      $_keys = array();
      for ($i = 0; $i < sizeof($keys); $i++) {
        $_keys[$i] = mysqli_real_escape_string($link, $_POST[$keys[$i]]);
      }
      /*
      $_firstName = mysqli_real_escape_string($link, $_POST['firstName']);
      $_lastName = mysqli_real_escape_string($link, $_POST['lastName']);
      $_email = mysqli_real_escape_string($link, $_POST['email']);
      $_password = mysqli_real_escape_string($link, $_POST['password']);
      */
      $query = "INSERT INTO `Users` (`First_Name`, `Last_Name`, `Email`, `Password`) VALUES ('$_keys[0]', '$_keys[1]', '$_keys[2]', '$_keys[3]')";
      $result = mysqli_query($link, $query);
      //$queryError = mysqli_error($link);
      if ($result) {
        echo "<p>Signup Successful</p>";

        //Adds the email to a session variable
        $_SESSION['email'] = $_POST['email'];
        //echo $_SESSION['email'];

        //header(str) is a redirect in PHP
        header("Location: session.php");
      } else {
        echo "<p>Signup Failed</p>";
        //printf("Error Message: ".$queryError);
      }
    }


  //print_r($attributes);

  /*

  $query = "INSERT INTO `Users` (`User_ID`, `First_Name`, `Last_Name`, `Email`, `Password`) VALUES ('$attributes[firstName]', '$attributes[lastName]', '$attributes[email]', '$attributes[password]')";
  $result = mysqli_query($link, $query);

  if($result) {
    die("Record Insert Failed");
  }

  */

/*

for ($i = 0; $i < sizeof($attributes); $i++) {
  $attributes[$i] = $_POST[''.$attributes[$i].''];
  if (!$$attributes[$i]) {
    $test = false;
  }
}
echo $test;

echo $firstName;
echo $lastName;
echo $email;
echo $password;
echo $confirmPassword;

*/



//$test1 = 'test1';
//$test2 = 'test2';
//$test3 = $$test1;
//echo $test3;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap-jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <style>
    /*
      html {
        background: no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      */

      .container {
        margin-top: 3em;
        margin-left: auto;
        margin-right: auto;
        width: 60%;
      }

      h1 {
        margin-bottom: 1em;
      }

      #submit {
        margin-left: auto;
        margin-right: auto;
        width: 40%;
      }

      .form-group.center {
        text-align: center;
        margin-top: 2em;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <h1>Sign Up</h1>
      <div id="errorMessage"></div>
      <form action="signup_form.php" method="post" id="form">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" id="firstName" class="form-control">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" id="lastName" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="form-control">
        </div>
        <div class="form-group center">
          <input type="submit" value="Submit" id="submit" class="btn btn-primary">
        </div>
      </form>
    </div>
  </body>
</html>
<script>
  /*
  $('#submit').click(function(e) {
      $('#form').submit()
    let error = "";
    let success = "";

    if ($('#firstName').val() == "";) {
      error = "<p>First Name cannot be empty</p>";
    }

    if ($('#lastName').val() == "";) {
      error = "<p>Last Name cannot be empty</p>";
    }

    if ($('#email').val() == "";) {
      error = "<p>Email cannot be empty</p>";
    }

    if ($('#password').val() == "";) {
      error = "<p>Password cannot be empty</p>";
    }

    if ($('#passwordConfirmation').val() == "";) {
      error = "<p>Password Confirmation cannot be empty</p>";
    }

    if ($('#password').val() != $('#passwordConfirmation').val();) {
      error = "<p>Password and Password Confirmation do not match</p>";
    }

  });
  */
</script>
