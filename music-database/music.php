<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Album List</title>
    <link rel="stylesheet" href="css/style3.css">
  </head>
  <body>
    <?php  include_once('includes/nav.php'); ?>
    <?php
      $albums = array("Daft Punk"=>"Discovery", "Cloud Cult"=>"Feel Good Ghosts", "Cake"=>"Fashion Nugget", "Beatles"=>"Let It Be", "Audio Slave"=>"Out of Exile","Green Day"=>"Dookie", "Weezer"=>"Blue Album", "Queen"=>"A Night at the Opera", "American Rejects"=>"Move Along", "Blink 182"=>"Enema Of The State", );
      $musicLink = array("Daft Punk"=>"https://www.youtube.com/watch?v=PTt_G1Ft3yA", "Cloud Cult"=>"https://www.youtube.com/watch?v=fQyhNfmjcOg&list=PL393114A5917BB02C",
      "Cake"=>"https://www.youtube.com/watch?v=qY_Y2ncwaso", "Beatles"=>"https://www.youtube.com/watch?v=cLQox8e9688&list=PLycVTiaj8OI-aOPBmpwUlhQp83Puf0hLX",
      "Audio Slave"=>"https://www.youtube.com/watch?v=HOWS89a_ODM","Green Day"=>"https://www.youtube.com/watch?v=koyYZc6hS-s", "Weezer"=>"https://www.youtube.com/watch?v=0CNyd9zL44s",
      "Queen"=>"https://www.youtube.com/watch?v=Phg2oyujkt0", "American Rejects"=>"https://www.youtube.com/watch?v=V4nK8vSpSsc&list=PL68169AD1ABA9AE81", "Blink 182"=>"https://www.youtube.com/watch?v=5sfAVdeQUAw", );
      $artists = array_keys($albums);
      shuffle($artists);
    ?>
      <h1>Favorite Albums</h1>
     <table>
       <tr>
         <th>Album</th>
         <th>Artist</th>
       </tr>
       <?php
        $count=0;

        foreach ($artists as $value)
        {
          echo'<tr><td><a href="'.$musicLink[$value].'">'.$albums[$value].'</a></td><td>'.$value.'</td></tr>';
        }
        ?>
     </table>
     <h3>(Hit F5 or Referesh for Randomized List)</h3>
     <div class="centerbox">   
      <img class="guitar" src="https://media.giphy.com/media/QaBCSdKutRe45LoZbX/source.gif" alt="guitar gif">
      <img class="guitar2" src="https://media.giphy.com/media/QaBCSdKutRe45LoZbX/source.gif" alt="guitar gif">
     </div>
  </body>
</html>
