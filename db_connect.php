<?php

  require_once 'C:\Users\Admin\vendor\autoload.php';

  $user = 'root';
  $password = '';
  $db = 'sampledb';

  $link = mysqli_connect('localhost', $user, $password, $db); //or die("Unable to connect");
  $error = mysqli_connect_error();

  if ($error) {
    //echo $error;
    die("Unable to connect");
  }

  $faker = Faker\Factory::create();
  //echo $_email;

  $counter = 0;

  for ($i = 1; $i < 100; $i++) {

    $firstName = $faker->firstName;
    $_firstName = mysqli_real_escape_string($link, $firstName);
    $lastName = $faker->lastName;
    $_lastName = mysqli_real_escape_string($link, $lastName);
    $email = strtolower($firstName)."_".strtolower($lastName)."@fake.com";
    $_email = mysqli_real_escape_string($link, $email);
    $password = "Password_".(string)$i;
    $_password = mysqli_real_escape_string($link, $password);

    $query = "INSERT INTO `Users` (`First_Name`, `Last_Name`, `Email`, `Password`) VALUES ('$_firstName', '$_lastName', '$_email', '$password')";
    $result = mysqli_query($link, $query);
    $queryError = mysqli_error($link);
    if ($result) {
      ++$counter;
    } else {
      continue;
      //printf("Error Message: ".$queryError);
    }
  }

  echo (string)$counter." records successfully added to 'Users'";

  /*

  //$query = "INSERT INTO `Users` (`User_ID`,`First_Name`, `Last_Name`, `Email`) VALUES (1,'Joe', 'Bloggs', 'joe_bloggs@fake.com')";
  $query = "UPDATE `Users` SET `First_Name` = 'Jim' WHERE `User_ID` = 1 LIMIT 1";
  $result = mysqli_query($link, $query);

  if ($result) {
    //echo "Query Successful, Record Updated with LIMIT 1";
    $row = mysqli_fetch_array($result);
    while ($row) {

    }
    //print_r($row);
  }

  */
?>
