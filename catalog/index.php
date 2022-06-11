<?php
    session_start();

    $createName = $createPass = $createPassV = $loginName = $loginPass = $errMsg = $loginMSG = "";
    $usersContent = array();
    $userLogins = array();
    $loginEC = 0;
    $createEC = "";
    $creationEC = "";
    $login = false;
    $newUserAdded = false; 
    $repeatUserName = false;

    // ESTABLISHING DATABASE CONNECTION**********************************************
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

    $sqllogin = 'SELECT * FROM logins;';
            
    $loginResults = mysqli_query($conn, $sqllogin);

    while($row = mysqli_fetch_array($loginResults, MYSQLI_ASSOC))
    {
        $usersContent += [$row['username'] => $row['password']];
        $userLogins[] = $row['username'];
    }

    //var_dump($usersContent);


    // LOGIN DATABASE LOGIC**************************************************

    if(!empty($_POST['loginSubmit']))
    {
        //echo "poop1";
        if(isset($_POST['loginName']) && isset($_POST['loginPass']) && !empty($_POST['loginName']) && !empty($_POST['loginPass']))
        {
            //echo "poop2";

    
            $pUserName = $_POST['loginName'];
            // $userName = '/' . $_POST['userName'] . '/'; 
            // $password = '/' . $_POST['password'] . '/';
            $loginName = $_POST['loginName']; 
            $loginPass = $_POST['loginPass'];
    
            $match = 0;
            foreach($usersContent as $key => $value)
            {
    
                
                $num2 = 2222;
                $salt1 = 'hjklh2jk3hkj23hklj';
                $salt2 = 'jg13g423g4g234gj2g';
                $temp1 = $salt1.$loginPass.$salt2;
                $temp1 = hash('sha512', $temp1);
                //echo $temp1;
            
    
                //echo "<h1>$value $userName $password $passwordH</h1>";
    
                if( $key == $loginName && ($value == $loginPass || $value == $temp1))
                {
                    $match += 1; 
                    //echo '<h1>yes</h1>';               
                }
            }

            if($match == 0)
            {
                //echo "poop4";
                $loginEC +=1;
                header('location: ?loginEC='.$loginEC.'&loginName='.$_POST['loginName'].'&loginPass='.$_POST['loginPass'].'&hashed='.$passwordH);
            }
            else
            {
                //echo "poop5";
                $login = true;
                $_SESSION['loggedIn'] = true;
                $_SESSION['userName'] = $_POST['loginName'];
                $_SESSION['pass'] = $_POST['loginPass'];
            }
    
        }
        else 
        {
            echo "poop3";
            $loginEC +=1; 
            header('location: ?loginEC='.$loginEC.'&loginName='.$_POST['loginName'].'&loginPass='.$_POST['loginPass'].'&hashed='.$passwordH);
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">

    <?php include_once('includes/head.php');?>

    <body>

        <?php include_once('includes/nav.php');?>

        <!-- <h1><?php echo substr(basename($_SERVER['PHP_SELF']),0,-4); ?></h1> -->

        <div id="top-grid">
            
            <div id="deals">
                <h3>50% OFF NINTENDO GAMES</h3>
            </div>

            <div id="login-user-creation">
                <div class="login-box">
                
                    <?php
                        // LOGIN LOGIC ------------------------------------------------------------->
                        if(empty($_POST['loginSubmit']))
                        {

                            if(isset($_GET['loginEC']) && !empty($_GET['loginEC']))
                            {
                                $loginEC = $_GET['loginEC'];
                            }

                            if(isset($_GET['loginName']) && !empty($_GET['loginName']))
                            {
                                $loginName = $_GET['loginName'];
                            }
                            
                            if(isset($_GET['loginPass']) && !empty($_GET['loginPass']))
                            {
                                $loginPass = $_GET['loginPass'];
                            } 
                    
                            echo
                                '                
                                <h1>USER LOGIN</h1>
                                <br>
                                <form id="login" action="" method="post">
                                    <input value="'.$loginName.'" placeholder="USERNAME" type="text" name="loginName">
                                    <br>
                                    <input value="'.$loginPass.'" placeholder="PASSWORD" type="password" name="loginPass">
                                    <br>
                                    <input value="LOGIN" type="submit" name="loginSubmit">
                                    <br>
                                    <input value="RESET" type="reset">
                                </form>
                                ';

                            if($loginEC)
                            {
                                echo '<h3 class="shortbottom formErrors">Invalid User Name or Password</h3><hr>';
                            }

                            if(empty($_SESSION['loggedIn']) && !empty($_GET['logout']))
                            {
                                $loginMSG = '<h3 class="login-out">USER LOGGED OUT</h3>';
                            }
                            else
                            {
                                $loginMSG = '';
                            }

                        }
                        else
                        {
                            if(!empty($_SESSION['loggedIn']))
                            {
                                $loginMSG = '<h3 class="login-in">USER LOGIN SUCCESSFUL</h3>';
                                
                            }
                            else
                            {
                                $loginMSG = '';
                            }


                            //var_dump($_SESSION['loggedIn'],$_SESSION['userName'],$_SESSION['pass']);
                        } 
                        echo '<br><h4 >'.$loginMSG.'</h4>';                       

                    ?>
                </div>
            </div>


            <div id="product-grid">
                <a href="catalog.php"><img class="index-images" src="images/darksouls.png" alt=""></a>
                <a href="catalog.php"><img class="index-images" src="images/zeldabreathofthewild.png" alt=""></a>
                <br>
                <a href="catalog.php"><img class="index-images" src="images/celeste.png" alt=""></a>
                <a href="catalog.php"><img class="index-images" src="images/supersmashbros.png" alt=""></a>
                <!-- <div class="product-image1">
                    <img class="index-images" src="images/marioodyssey.png" alt="">
                </div>
                
                <div class="product-image2">
                    <img class="index-images" src="images/marioodyssey.png" alt="">
                </div>
                
                <div class="product-image3">
                    <img class="index-images" src="images/marioodyssey.png" alt=""> 
                </div>
                
                <div class="product-image4">
                    <img class="index-images" src="images/marioodyssey.png" alt="">                
                </div> -->
            </div>
        </div>

        <?php include_once('includes/footer.php');?>

    </body>
</html>