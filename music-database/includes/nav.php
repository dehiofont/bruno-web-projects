<?php
$pageName = basename($_SERVER['PHP_SELF']);
//$fileNames = array("index.php", "palindrome.php", "about.php", "contact.php");
$dir = scandir(".");
$fileNames[] = "index.php";
foreach($dir as $d)
{
  if(substr($d, -4) === ".php" && $d !== "index.php")
  {
    $fileNames[] = $d;
  }
}

echo '<div class="centerbox4">';
  echo'<nav><ul>';
    foreach ($fileNames as $value)
    {

      if($pageName === $value)
      {
        $class =' class="active" ';
      }
      else
      {
        $class = '';
      }

      if($value === "index.php")
      {
        $navText = "Home";
        //$value = ".";
      }
      else
      {
        $navText = ucfirst(substr($value, 0,-4));
      }

      
      echo '<li><a '.$class. ($value == $pageName || $value =="." ? "" : "href =\"$value\"").'>' .$navText.'</a></li>';


      //echo '<p>'.$value.'</p>';

    }
    echo'</nav></ul>';
  echo '</div>';
?>
