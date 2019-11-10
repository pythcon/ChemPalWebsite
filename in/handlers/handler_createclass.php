<!------------------------------AUTHENTICATION----------------------->
        <?php
            session_set_cookie_params(600);
            session_start();
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
            ini_set('display_errors' , 1);
            include ("../../account.php");
            include("../../functions.php");
            $db = mysqli_connect($hostname, $username, $password, $project);
            mysqli_select_db($db, $project); 
            
            gatekeeper();

            //GET ALL INFO FROM PREVIOUS FORM
            $email              = $_SESSION['email'];
            $className          = $_POST["className"];
            $classDescription   = $_POST["classDescription"];
            $endDate            = $_POST["endDate"];
            $studentArrayString = "";

            if (isset($_POST['submit'])){
                if (!empty($_POST['checkbox'])){
                    foreach ($_POST['checkbox'] as $selected){
                        $studentArrayString .= $selected.",";
                    }
                }
            }
            

            $s = "INSERT INTO class VALUES('$email', '$className', '$classDescription', '$endDate', '$studentArrayString')"; 
            $t = mysqli_query($db,$s) or die("Error submitting query"); 
            
            echo"
            <script>
                alert(\"Class created.\");
                window.location.replace(\"/in/dashboard.php\");
            </script>";
        ?>
<!------------------------------------------------------------------->