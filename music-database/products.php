<?php
    $styles = array("shirt_short", "shirt_long", "tanktop", "jersey", "hoodie");
    $bands = array("beatles", "queen", "wings", "creedence", "beach_boys", "billy_joel", "steve_miller", "elton_john", "bob_dylan", "rolling_stones");
    $colors = array("white", "black", "red", "green", "blue");
    $sizes = array("x_large", "large", "medium", "small", "x_small");
    $shift = false;
    $valueNames = array("f"=>"", "l"=>"", "e"=>"", "p"=>"", "a"=>"", "bs"=>"", "cs"=>"", "ss"=>"", "sts"=>"", "ec"=>"");
    $titleNames = array("f"=>"First Name : ", "l"=>"Last Name : ", "e"=>"Email : ", "p"=>"Phone : ", "a"=>"Address : ", "bs"=>"Band Selection : ", "cs"=>"Color Selection : ", "ss"=>"Size Selection : ", "sts"=>"Style Selection : ", "ec"=>"");
    $validateEntry = false;
    $errorMessage="";
    $finalShirt = false;

    $f = $l = $e = $p = $a = $bs = $cs = $ss = $sts = $ec = "";

    $fband = $fcolor = $fsize = $fstyle = "";
    



    if(!empty($_POST['submit']))
    {
        foreach($_POST as $key => $values)
        {
            if($key != 'submit')
            {
                $valueNames[$key] = $_POST[$key];
            }

            if(!empty($_POST[$key] && $key !== 'submit'))
            {
                $validateEntry = true;
            }
        }

        // var_dump($_POST);
        // echo'<br>';
        // var_dump($valueNames);
    }

    

    if($validateEntry)
    {      
      //Checking to see if the name has only spaces and letters
      if(!preg_match("/^[(a-zA-Z-'. ]+$/", $_POST['f']) || preg_match("/^\s+|\s+$/", $_POST['f']))
      {
        $ec .= "1";
      }
      //Checking to see if the name has only spaces and letters
      if(!preg_match("/^[(a-zA-Z-'. ]+$/", $_POST['l']) || preg_match("/^\s+|\s+$/", $_POST['l']))
      {
        $ec .= "2";
      }
      //Checking to see if the email has the correct format xxxxx@xxxxx.xxx
      if(!preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $_POST['e']))
      {
        $ec .= "3";
      }
      //Checking the phone number
      if(!preg_match("/^[\(]\d{3}[\)]\d{3}[-]\d{4}$/", $_POST['p']))
      {
        $ec .= "4";
      }
      //Checking the address
      if(!preg_match("/^\s*\S+(?:\s+\S+){2}/", $_POST['a']))
      {
        $ec .= "5";
      }
      //checking the band selection
      if(!isset($_POST['bs']))
      {
        $ec .= "6";
      }
      if(!isset($_POST['cs']))
      {
        $ec .= "7";
      }
      if(!isset($_POST['ss']))
      {
        $ec .= "8";
      }
      if(!isset($_POST['sts']))
      {
        $ec .= "9";
      }


  
      if($ec)
      {
        header('location: ?f='.$valueNames['f'].'&l='.$valueNames['l'].'&e='.$valueNames['e'].'&p='.$valueNames['p'].'&a='.$valueNames['a'].'&bs='.$valueNames['bs'].'&cs='.$valueNames['cs'].'&ss='.$valueNames['ss'].'&sts='.$valueNames['sts'].'&ec='.$ec);
      }
    }
    else if(!empty($_POST['submit']) && !$validateEntry)
    {
      $ec = "10";
      header('location: ?f='.$valueNames['f'].'&l='.$valueNames['l'].'&e='.$valueNames['e'].'&p='.$valueNames['p'].'&a='.$valueNames['a'].'&bs='.$valueNames['bs'].'&cs='.$valueNames['cs'].'&ss='.$valueNames['ss'].'&sts='.$valueNames['sts'].'&ec='.$ec);
    }
    //var_dump($ec);
    //var_dump($_POST);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/style2.css">
    <script type="text/javascript" src="js/script.js" defer></script>
    <script>let fband = 33 ; </script>
</head>
<body class="zoom" onload="changeBand(), changeShirtAttribute(), changeSize()">
    <?php  include_once('includes/nav.php'); ?>
    <h1 class="tshirttitle">Shirt Creator!</h1>

    <div class="Tshirt">
        <?php
            if(empty($_POST['submit']))
            {

                //setting values for form fields
                foreach($_GET as $key => $g)
                {
                    if(!empty($g))
                    {
                        $valueNames[$key] = $_GET[$key];
                    }
                }


                // if(!empty($_GET['f']))
                // {
                //   $f = $_GET['f'];
                // }
                // else
                // {
                //   $f = "";
                // }
                // if(!empty($_GET['l']))
                // {
                //   $l = $_GET['l'];
                // }
                // else
                // {
                //   $l = "";
                // }
                // if(!empty($_GET['e']))
                // {
                //   $e = $_GET['e'];
                // }
                // else
                // {
                //   $e = "";
                // }
                // if(!empty($_GET['p']))
                // {
                //   $p = $_GET['p'];
                // }
                // else
                // {
                //   $p = "";
                // }
                // if(!empty($_GET['a']))
                // {
                //   $a = $_GET['a'];
                // }
                // else
                // {
                //   $a = "";
                // }

                //$bs = "queen";

                echo '<form action="" method="post">';

                    #BAND SELECTION
                    echo '<select name="bs" id="bandselect" onchange="changeBand()">';
                        echo '<option '.($bs ? "" : "selected").' disabled hidden >Band Selection</option>';
                            foreach($bands as $s) 
                            {
                                echo '<option '.($valueNames['bs'] == $s ? "selected" : "").' value="'.$s.'">'.ucfirst($s).'</option>';
                            }
                    echo '</select>';

                    //COLOR SELECTION -->
                    echo '<select name="cs" id="colorselect" onchange="changeShirtAttribute()">';
                        echo'<option disabled selected hidden>Color Selection</option>';
                            foreach($colors as $s) 
                            {
                                echo '<option '.($valueNames['cs'] == $s ? "selected" : "").' value="'.$s.'">'.ucfirst($s).'</option>';
                            }
                    echo '</select>';

                    //SIZE SELECTION -->
                    echo '<select name="ss" id="sizeselect" onchange="changeSize()">';
                        echo '<option disabled selected hidden>Size Selection</option>';
                            foreach($sizes as $s) 
                            {
                                echo '<option '.($valueNames['ss'] == $s ? "selected" : "").' value="'.$s.'">'.ucfirst($s).'</option>';
                            }
                    echo '</select>';
                    
                    //STYLE SELECTION -->
                    echo '<select name="sts" id="styleselect" onchange="changeShirtAttribute()">';
                        echo '<option disabled selected hidden>Style Selection</option>';
                            foreach($styles as $s) 
                            {
                                echo '<option '.($valueNames['sts'] == $s ? "selected" : "").' value="'.$s.'">'.ucfirst($s).'</option>';
                            }
                    echo '</select>';

                    //CUSTOMER SHIPPING INFO
                    echo '<div class="centerbox">';
                        echo '<div class="custinfo">';
                            echo '<label for="">Customer Shipping Info</label>';
                            echo '<input value="'.$valueNames['f'].'" type="text" name="f" placeholder="First Name">';
                            echo '<input value="'.$valueNames['l'].'" type="text" name="l" placeholder="Last Name">';
                            echo '<input value="'.$valueNames['e'].'" type="text" name="e" placeholder="Email">';
                            echo '<input value="'.$valueNames['p'].'" type="text" name="p" placeholder="Phone">';
                            echo '<input value="'.$valueNames['a'].'" type="text" name="a" placeholder="Address">';
                            echo '<br>';
                            echo '<input type="submit" name="submit">';
                            echo '<input type="reset">';
                        echo '</div>';
                    echo '</div>';
                echo '</form>';

                if(!empty($_GET['ec'])) $ec = $valueNames['ec']; else $ec = ""; 

                //var_dump($ec);            
                for($i=0; $i < strlen($ec); $i++)
                {                        
                    switch($ec[$i])
                    {
                        case 10:
                        case 1:
                            $errorMessage .= "<p>Invalid First Name Entry ( words and spaces only )</p><br>";
                            if($ec != 10) break; 
                        case 2:
                            $errorMessage .= "<p>Invalid Last Name Entry ( words and spaces only )</p><br>";
                            if($ec != 10) break;
                        case 3:
                            $errorMessage .= "<p>Invalid Email Entry ( xxxx@xxxx.com format )</p><br>";
                            if($ec != 10) break; 
                        case 4:
                            $errorMessage .= "<p>Invalid Phone Entry ( (xxx)xxx-xxxx format )</p><br>";
                            if($ec != 10) break;    
                        case 5:
                            $errorMessage .= "<p>Invalid Address Entry (st number and name required)</p><br>";
                            if($ec != 10) break; 
                        case 6:
                            $errorMessage .= "<p>Missing Band Selection ( select a band )</p><br>";
                            if($ec != 10) break;
                        case 7:
                            $errorMessage .= "<p>Missing Color Selection ( select a color )</p><br>";
                            if($ec != 10) break; 
                        case 8:
                            $errorMessage .= "<p>Missing Size Selection ( select a size )</p><br>";
                            if($ec != 10) break;      
                        case 9:
                            $errorMessage .= "<p>Missing Style Selection ( select a style )</p>";
                            if($ec != 10) break;  
                    }
                }

                if(!empty($errorMessage))
                {
                    echo '<div class="centerbox3">';
                        echo' <div class="errorContainer">';
                            echo '<h1>ERROR</h1>';
                            echo '<hr>';
                            echo $errorMessage;    
                        echo '</div>';
                    echo '</div>';
                }


            }
            else
            {
                $ec="";
                echo '<div class="centerbox2">';
                    echo'<div id="success" class="custinfo">';
                        echo '<h1>SUBMITTED!</h1>';
                        echo "<hr>";
                        echo '<h2>Shipping Info</h2>';
                        echo '<hr>';
                        foreach($valueNames as $key => $values)
                        {
                            if($key == 'bs')
                            {
                                echo '<hr>';
                                echo '<h2>Order Info</h2>';
                                echo '<hr>';
                            }
                            echo '<p>'.$titleNames[$key].$values.'</p>' ;

                        } 
                    echo'</div>';
                echo'</div>';
                $fband = $valueNames['bs']; 
                $fcolor = $valueNames['cs']; 
                $fsize = $valueNames['ss']; 
                $fstyle = $valueNames['sts']; 
                //echo $fcolor
                

            }
            
        ?>
    </div>
    


    <div class="shirtbox">
            <img id="s_stylecolor" src="img/<?php if(!empty($fstyle)) echo $fstyle; else echo 'shirt_short';?>/<?php if(!empty($fcolor)) echo $fcolor.'.png'; else echo 'black.png';?>" alt="">
    </div>
    <div id="bandpic" class="<?php if(!empty($fstyle) && $fstyle =='tanktop') echo 'bandboxtank'; else echo 'bandbox' ?>" >
        <img id="s_band" src="img/band/<?php if(!empty($fband)) echo $fband.'.png'; else echo 'beatles.png';?>" alt="">
    </div>
    <div class="sizebox">
        <h1 id="s_size"><?php if(!empty($fsize)) echo strtoupper($fsize); else echo 'MEDIUM';?></h1>
    </div>

    <div class="space"></div>

    <!-- <iframe class="gif" src="https://giphy.com/embed/3oEduR8JONr03Z8TuM" width="400" height="580" frameBorder="0" class="giphy-embed" allowFullScreen> -->


    
    <!-- <div class="testing">
        <h1 id="t_stylecolor">test</h1>
        <h1 id="t_band"></h1>
        <h1 id="t_size"></h1>
    </div> -->






    
</body>
</html>