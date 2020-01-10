<?php
  session_start();
  if ($_SESSION['email']) {
    echo "Welcome to the Login Page '".$_SESSION['email']."'";
  } else {
    header("Location: signup_form.php");
  }

  /*
  -Creating a cookie
  setcookie("customerID", "1234", time() + 60 * 60 * 24);

  -Deleting a cookie (only executes on page reload)
  setcookie("customerID", "", time() - 60 * 60);

  -Updating a cookie
  $_COOKIE['customerID'] = "TEST";

  echo $_COOKIE["customerID"];
  */
?>
