<?php
    session_start();
    include("account.php");
    include("functions.php");

//error reporting code
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors' , 1);

//DB Connection
    $db = mysqli_connect($hostname, $username, $password, $project);

    if (mysqli_connect_errno())
      {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
      }
    print "Successfully connected to MySQL.<br>";
    mysqli_select_db($db,$project);

    $delay = 3;

//get data
    getData("username", $email);
    getData("password", $pass);

//check to see if data is good
    if ($bad) exit("Bad Data");

//hash password
    $pass = md5($pass);

    if (!auth($email, $pass, $t, $reset)){
        redirect("<span style=\"color:red;\">Incorrect Credentials...Redirecting...</span>", "/index.html", $delay);
    }
//only get here if youre authenticated
    $_SESSION["logged"] = true;
    $_SESSION["email"] = $email;

//store first and last name
    $row = mysqli_fetch_array($t,MYSQLI_ASSOC);
    $_SESSION["firstname"] = $row["firstName"];
    $_SESSION["lastname"] = $row["lastName"];

//redirect to dashboard
//passed authentication
    redirect("<span style=\"color:green;\">You have successfully logged in...</span>", "/in/dashboard.php", $delay);
?>