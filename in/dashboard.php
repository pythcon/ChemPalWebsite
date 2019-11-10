<!DOCTYPE html>
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
    
<?php
    session_start();
    $email = $_SESSION['email'];
    $firstName = $_SESSION['firstname'];
    $lastName = $_SESSION['lastname'];
?>
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
    <div class="restOfPage">
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <a href="#" class="btn" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                <h1 class="text-center">Welcome to ChemPal</h1>
                <h2 class="small text-center">Some sub heading</h2>
                <p class="text-center">SOME TEXT</p>
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