<!DOCTYPE html>
<?php
    session_start();
    include("../account.php");
    include("../functions.php");
    
     $db = mysqli_connect($hostname, $username, $password, $project);

    if (mysqli_connect_errno())
      {	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
      }
    mysqli_select_db($db,$project);
    
    
    $email = $_SESSION['email'];
    $firstName = $_SESSION['firstname'];
    $lastName = $_SESSION['lastname'];
?>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ChemPal | Dashboard</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel="stylesheet" href="../css/dashboardStyle.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

</head>
<body>
<!-- partial:index.partial.html -->
<body>
  <div id="wrapper" class="menuDisplayed">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="profileTab">
                <div class="chemPalLogo">
                </div>
                <div class="profileInfo" style="background: url(../profile/ToddMurphy.png);">
                </div>
                <div class="profileInfoText">
                    <?php
                        echo $firstName. " ". $lastName. "<br> Washington Township High School";
                    ?>
                </div>
            </li>
            <br>
            <li class="liElement"><a href="#"><span class="showClasses">My Classes</span></a>
            </li>
            <!-- PHP CODE for pulling classes from db-->
            <?php
                $s = "SELECT * FROM class WHERE email='$email'"; 
                $t = mysqli_query($db,$s) or die("Error submitting query"); 
                while ( $r = mysqli_fetch_array($t,MYSQLI_ASSOC) ) {
                    $class 				= $r[ "className" ];
                    
                    echo "<li class='liElement classMenu'><a href=''>&nbsp;$class</a></li>";
                    
                }
            
            ?>
            <!-- PHP CODE for pulling classes from db-->
            <li class="liElement"><a href="createclass.php">Create Class</a></li>
        </ul>
    </div>
    
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
            <h1 class="text-center">Create a Class</h1>
            <p class="text-center"></p>
          <div class="infoContainer">
            <div class="createContainer">
                <form action="handlers/handler_createclass.php" method="post" name="classForm">
                    <div class="createOptions">
                            <label>Class Name:</label>
                            <input type="text" name="className">
                            <br>
                            <h2 class="createClassHeading">RUN TIME</h2>
                            <div class="indented">
                                <br>
                                <label>From:</label>
                                <input type="text" name="startDate">
                                <br>
                                <label>To:&nbsp;</label>
                                <input type="text" name="endDate">
                            </div>
                            <br>
                            <label>Description:</label>
                            <br>
                            <textarea name="classDescription"></textarea>
                    </div>
                    <div class="studentContainer">
                        <div class="studentCheckboxes">
                            <?php
                                $s = "SELECT * FROM students"; 
                                $t = mysqli_query($db,$s) or die("Error submitting query"); 
                                while ( $r = mysqli_fetch_array($t,MYSQLI_ASSOC) ) {
                                    $student = $r['firstName']. " " .$r['lastName'];
                                    $email   = $r['email'];
                                    echo "<input type='checkbox' name='checkbox[]' value='$email'>&nbsp;$student <br>";

                                }

                            ?>
                        </div>
                        <input type="submit" value="submit" name="submit">
                    </div>
                </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- partial -->
  
  <script  src="../js/dashboardScript.js"></script>
  <script  src="../js/dashboardSubMenu.js"></script>

</body>
</html>