<?php
    function getData($name, &$result){
        global $bad;
        global $db;
        if (!isset ($_POST[ $name ])){
            $bad = true;
        }
        if ($_POST[$name] == ""){
            $bad = true;
        }

        $result = mysqli_real_escape_string ($db, $_POST[$name]);
    }
//------------------------------------------------------------------//
    function auth ($u, $p, &$t, &$reset){
        global $db;
        
        $s = "SELECT * FROM login WHERE email = '$u' and password='$p'";
        
        $t = mysqli_query($db, $s) or die("Error Querying Database.");
        
        $num_rows = mysqli_num_rows($t);
        
        if ($num_rows>0){
            return true;
        }
        else{
            return false;
        }
    }
//--------------------------------------------------------------------//
    function redirect($message, $targetfile, $delay){
        global $db;
        echo $message;
        
        header("refresh: $delay, url = $targetfile");
        
        exit();
    }
//---------------------------------------------------------------------//
    function gatekeeper(){
        global $db;
        //check if authenticated
        if (!$_SESSION['logged']){
            echo"
            <script>
                alert(\"Not logged in...\");
                window.location.replace(\"/vr/index.html\");
            </script>";
            exit();
        }
    }