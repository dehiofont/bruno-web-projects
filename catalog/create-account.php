<?php
    session_start();

    $newUserName = $newUserPass = $newUserPassV = $errMsg = '';
    $ec = "";    
    $userLogins = array();
    $newUserAdded = false; 
    $repeatUserName = false;
    
    if($_SERVER['HTTP_HOST'] == 'localhost')
    {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', 'mertion44');
        define('DB', 'csis2440');
    }
    else
    {
        define('HOST', 'gator4104.hostgator.com');
        define('USER', 'fornotti_bruno');
        define('PASS', 'Mertion44');
        define('DB', 'fornotti_csis2440');
    }
    
    $conn = mysqli_connect(HOST, USER, PASS, DB);

    $sql = 'SELECT * FROM logins;';
    $results = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
    {
        $userLogins[] = $row['username'];
    }

    //mysqli_close($conn);

    if(!empty($_POST['userName']) && isset($_POST['userName']))
    {
        $newUserName = $_POST['userName'];

        for($i = 0; $i < count($userLogins); $i++)
        {
            if($userLogins[$i] == $newUserName)
            {
                $repeatUserName = true;
            }
        }
    }

    if(!empty($_POST['password']) && isset($_POST['password']))
    {

        $newUserPass = $_POST['password'];
    }

    if(!empty($_POST['passwordV']) && isset($_POST['passwordV']))
    {
        $newUserPassV = $_POST['passwordV'];
    }

    $correctSecretCode = false;


    if(!empty($_POST['userName']) || !empty($_POST['password']))
    {

        if(!preg_match("/\b[a-zA-Z0-9]{3,15}\b/", $newUserName))
        {
            $ec .= "1";
        }

        if($repeatUserName == true)
        {
            $ec .= "2";
        }

        if($_POST['password'] != $newUserPassV)
        {
            $ec .= "3";
        }

        if(strlen($_POST['password']) < 8)
        {
            $ec .= "4";
        }

        if(empty($_POST['password']) || !isset($_POST['password']))
        {
            $ec .= "5";
        }

        if(!preg_match("/\d/", $_POST['password']))
        {
            $ec.="6";
        }

        if($ec)
        {
            header('location: ?ec='.$ec.'&userName='.$_POST['userName'].'&password='.$_POST['password'].'&passwordV='.$_POST['passwordV']);
        }
        

    }
    else if(!empty($_POST['submit']))
    {        
        $ec .= "9";
        header('location: ?ec='.$ec.'&userName='.$_POST['userName'].'&password='.$_POST['password'].'&passwordV='.$_POST['passwordV']);
    } 



?>


<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php');?>
<body>
<?php include_once('includes/nav.php');?>
    
    <?php
        if(empty($_POST['submit']))
        {
            echo '
                    <div>
                        <p class="creation-message" id="passMatchReq"></p>
                        <p class="creation-message" id="passLengthReq"></p>
                        <p class="creation-message" id="passNumReq"></p>
                    </div>
                ';
        }
    ?>
    <div class="creation-box">
        <div class="login-box">
            <?php
                if(empty($_POST['submit']))
                {
                    if(!empty($_GET['userName']) && isset($_GET['userName']))
                    {
                        $newUserName = $_GET['userName'];
                    }
                    if(!empty($_GET['password']) && isset($_GET['password']))
                    {
                        $newUserPass = $_GET['password'];
                    }
                    if(!empty($_GET['passwordV']) && isset($_GET['passwordV']))
                    {
                        $newUserPassV = $_GET['passwordV'];
                    }

                    echo
                    '                                  

                        <div class="innerform login2">
                            <h1 class="creationTitle">CREATE NEW USER</h1>
                            <hr>
                            <form class="login2" action="" method="post">
                                
                                    <h3>USERNAME</h3>
                                    <input value="'.$newUserName.'" name="userName" type="text">
                                    
                                    <h3>PASSWORD</h3>
                                    <input value="'.$newUserPass.'" id="cPassword" name="password" type="password">
                                    

                                    <h3>VERIFY PASSWORD</h3>
                                    <input value="'.$newUserPassV.'" id="vcPassword" name="passwordV" type="password">
                                    
                                    <br>
                                    <br>
                                    <br>
                                    <hr>
                                    <input id="create-button" name="submit" type="submit" value="Create Account">
                                    <br>
                                    <input style="margin-top:10px;" class="reset-button" type="reset">
                            </form>
                            <hr>
                        </div>
                        <br>
                        
                        
                    ';

                    if(isset($_GET['ec']) && !empty($_GET['ec']))
                    {
                        $ec = $_GET['ec'];
                    }

                    if($ec)
                    {
                        for($i=0; $i < strlen($ec); $i++)
                        {
                            switch($ec[$i])
                            {
                                case 9 :
                                case 1 :
                                    $errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid User Name Entry</h3><p class="shorttop formErrors">Minimum of 3 Characters and No Spaces</p><hr><br>'; if($ec != 9) break;
                                case 2 :
                                    if($ec != 9){$errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid User Name Entry</h3><p class="shorttop formErrors">User Name Already Exists</p><hr><br>'; break;}
                                case 3 :
                                    if($ec != 9){$errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid Password</h3><p class="shorttop formErrors">Passwords Do Not Match</p><hr><br>'; break;}
                                case 4 :
                                    $errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid Password Length</h3><p class="shorttop formErrors">Password Is Less Than 8 Characters</p><hr><br>'; if($ec != 9) break;
                                case 5 :
                                    $errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid Password</h3><p class="shorttop formErrors">Password Field Is Empty</p><hr><br>'; if($ec != 9) break;
                                case 6 :
                                    $errMsg .= '<hr><h3 class="shortbottom formErrors">Invalid Password Type</h3><p class="shorttop formErrors">Missing Number Requirement In Password</p><hr><br>'; if($ec != 9) break;

                            }
                        }
                        echo '<div class="errorBox">'.$errMsg.'</div>';
                    }
                }
                else
                {

    
                    $salt1 = 'hjklh2jk3hkj23hklj';
                    $salt2 = 'jg13g423g4g234gj2g';
                    $newUserPass = $salt1.$newUserPass.$salt2;
                    $newUserPass = hash('sha512', $newUserPass);

                    //$conn = mysqli_connect(HOST, USER, PASS, DB);
                    //$sqlAddUser = 'INSERT INTO logins (username, password) VALUES ($newUserName, $newUserPass)'; 
                    $sqlAddUser = "INSERT INTO logins (username, password) VALUES ('".$newUserName."', '".$newUserPass."')";
                    
                    echo '<div class="creation-box">';
                        echo '<div class="login-box">';
                            if(mysqli_query($conn, $sqlAddUser))
                            {
                                echo
                                '
                                    <h1>NEW USER '.$newUserName.' CREATED</h1>
                                    <a href="."><button>HOME</button></a>
                                ';
                            }
                            else
                            {
                                echo"<h1>SOMETHING WENT WRONG</h1>";
                                echo'<a href=""><button>BACK</button></a>';
                            }
                        echo '</div>';
                    echo ' </div>';
                    





                    //mysqli_close($conn);

                }
            ?>
        </div>
    </div>
    <div class="buffer2"></div> 
    <?php include_once('includes/footer.php');?>

</body>
</html>

