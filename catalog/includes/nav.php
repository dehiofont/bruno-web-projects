<?php
	$pageName = basename($_SERVER['PHP_SELF']);
	$dir = scandir(".");
	$fileNames[] = "index.php";
    $navLink = "";
    $rearrange = array();

    foreach($dir as $d)
	{
		if((substr($d, -4) === ".php") && ($d !== "index.php" && $d !== "cart.php" && $d !== "logout.php")) $fileNames[] = $d;
	}

    $fileNames[] = "cart.php";
    $fileNames[] = "logout.php";

    // foreach($dir as $d)
	// {
	// 	if((substr($d, -4) === ".php") && ($d !== "index.php")) $fileNames[] = $d;
	// }

	
	echo'<nav><ul>';

        //echo '<li><h1>GAME STORE</h1></li>';

		foreach ($fileNames as $fileName)
		{

            $navText = strtoupper(substr($fileName, 0,-4));

            if ($fileName === "index.php")  
            {
                $navText = "VOLO GAMES";
                //$fileName = ".";
            }

            if ($fileName === "catalog.php")  
            {
                $navText = "INVENTORY";
                //$fileName = ".";
            }

			if($pageName === $fileName)
            {
                //$class=' class="link-inactive" ';  
                
                if($navText == "VOLO GAMES")
                {
                    $navLink = '<li><span class="home-link link-inactive">'.$navText.'</span></li>';
                }
                else
                {
                    $navLink = '<li><span class="nav-links link-inactive">'.$navText.'</span></li>';
                }
            }
            else
            {
                if($navText == "VOLO GAMES")
                {
                    $navLink = '<li><a  href="'.$fileName.'"><span class="home-link">'.$navText.'</span></a></li>';
                }
                else
                {
                    $navLink = '<li><a href="'.$fileName.'"><span class="nav-links">'.$navText.'</span></a></li>';
                }
                
                
                
                $class='';
                $navText = "poop";
            }

            if ($fileName === "product.php")  
            {
                $navLink = "";
                //$fileName = ".";
            }

            if(empty($_SESSION['loggedIn']) && ($fileName == 'cart.php' || $fileName == 'logout.php'))
            {
                //$navLink == "";
                //echo "barf";
            }
            else if(isset($_SESSION['loggedIn']) && $fileName == 'create-account.php')
            {
                //$navLink == "";
            }
            else
            {
                echo $navLink;
            }




			
			//if (strtolower($fileName) !== "palindrome.php" || strtolower($pageName) === "palindrome.php") 
            
            

			//echo "<li> ".($pageName != $fileName ? ." <a $class href=\" $navLink \"> $navText </a> ". : $navText )."</li>";

			// echo '<li>'.($pageName != $fileName ? .' <a '.$class.' href="'.$navLink.'">'.$navText.' </a> '. : $navText ).'</li>';
            // echo '<li><a '.$class.($fileName === "palindrome.php" ? "" : "href=\"$fileName\"").'">'.$navText.'</a></li>';
            //echo 'link: '.$navLink;
		}
        if(isset($_SESSION['userName']) && $_SESSION['loggedIn'])
        {
            echo '<li><span class="user-name">ACTIVE USER: '.$_SESSION['userName'].'<span></li>';
            //var_dump($_SESSION);
        }
        else
        {
            echo '<li><span class="user-name">ACTIVE USER: NONE<span></li>';
        }
        // else
        // {
        //     //var_dump($_SESSION);
        //     //echo "NOT LOGGED IN";
        // }
        //echo '<li><span class="user-name">'.$_SESSION['userName'].'<span></li>';

	echo '</ul></nav>';
    

    

?>
