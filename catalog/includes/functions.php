<?php
    $pName =
                [
                    'Diablo III',
                    'Mario Odyssey',
                    'Zelda: Breath of the Wild',
                    'Darkest Dungeon',
                    'Slay the Spire',
                    'Super Smash Bros.',
                    'Zelda: Links Awakening',
                    'Grindstone',
                    'Mario Rabbids',
                    'Animal Crossing',
                    'Mario Kart 8',
                    'Luigi Mansion 3',
                    'Splatoon 2',
                    'Untitled Goose Game',
                    'Octopath Traveler',
                    'Risk of Rain 2',
                    'Hades',
                    'Pokemon Sword',
                    'Celeste',
                    'Dark Souls'
                ];
    $pDescription =
                        [
                            'Developer: Blizzard - Game Type: Action RPG - Theme: Medieval Fantasy',
                            'Developer: Nintendo - Game Type: Exploration Platformer - Theme: Mixed Fantasy',
                            'Developer: Nintendo - Game Type: Open World Adventure RPG - Theme: Medieval Fantasy',
                            'Developer: Redhook - Game Type: Turn Based RPG - Theme: Medieval Fantasy',
                            'Developer: Mega Crit Games - Game Type: Card Rogue Like - Theme: Fantasy',
                            'Developer: Nintendo - Game Type: Fighting - Theme: Mixed Fantasy',
                            'Developer: Nintendo - Game Type: Adventure RPG - Theme: Medieval Fantasy',
                            'Developer: Cappybara Games - Game Type: Puzzle - Theme: Viking Fantasy',
                            'Developer: Ubisoft - Game Type: Strategy RPG - Theme: Mixed Fantasy',
                            'Developer: Nintendo - Game Type: Creation Adventure Sim - Theme: Island Fantasy',
                            'Developer: Nintendo - Game Type: Racing - Theme: Kart Racing Fantasy',
                            'Developer: Nintendo - Game Type: Exploration Adventure - Theme: Paranormal',
                            'Developer: Nintendo - Game Type: 3rd Person Shooter - Theme: Squid Sci-fi',
                            'Developer: House House - Game Type: Exploration Adventure - Theme: Modern Slice of Life',
                            'Developer: Square Enix - Game Type: Turn Based RPG - Theme: Medieval Fantasy',
                            'Developer: Hopoo Games - Game Type: 3rd Person Shooter - Theme: Sci-fi',
                            'Developer: Super Giant Games - Game Type: Action Rogue Like - Theme: Greek Mythos',
                            'Developer: Nintendo - Game Type: Turn Based Collection RPG - Theme: Animal Fantasy',
                            'Developer: Matt Makes Games - Game Type: Platformer - Theme: Mental Health Fantasy',
                            'Developer: From Software - Game Type: Action RPG - Theme: Medieval Fantasy',
                            'Developer: Mega Crit Games - Game Type: Card Rogue Like - Theme: Fantasy'
                        ];
    $pImage =
                [
                    'diablo3',
                    'marioodyssey',
                    'zeldabreathofthewild',
                    'darkestdungeon',
                    'slaythespire',
                    'supersmashbros',
                    'zeldalinksawakening',
                    'grindstone',
                    'mariorabbids',
                    'animalcrossing',
                    'mariokart8',
                    'luigimansion3',
                    'splatoon2',
                    'untitledgoosegame',
                    'octopathtraveler',
                    'riskofrain2',
                    'hades',
                    'pokemonsword',
                    'celeste',
                    'darksouls'
                ];
    $pPrice =
                [
                    '30',
                    '50',
                    '50',
                    '35',
                    '20',
                    '50',
                    '40',
                    '15',
                    '15',
                    '50',
                    '40',
                    '50',
                    '50',
                    '15',
                    '40',
                    '20',
                    '25',
                    '50',
                    '15',
                    '30'
                ];

    var_dump($pName);
    echo "<br>";
    echo "<br>";
    var_dump($pDescription);
    echo "<br>";
    echo "<br>";
    var_dump($pImage);
    echo "<br>";
    echo "<br>";
    var_dump($pPrice);
    echo "<br>";

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

    if(isset($_POST['submit']) && !empty($_POST['submit']))
    {    



        for($i=0;$i<20;$i++)
        {
            // $pName[] = $_POST['name'.$i];
            // $pDescription[] = $_POST['desc'.$i];
            // $pImage[] = $_POST['image'.$i];
            // $pPrice[] = $_POST['price'.$i];

            $sqlAddInfo = "INSERT INTO product (name, description, image, price) VALUES ('".$pName[$i]."', '".$pDescription[$i]."', '".$pImage[$i]."', '".$pPrice[$i]."')";

            if(mysqli_query($conn, $sqlAddInfo))
            {
                echo
                '
                    <h1>SUCCESS<h1>
                ';
            }
            else
            {
                echo"<h1>SOMETHING WENT WRONG </h1>" . $pName[$i];
            }

            //echo $pName[$i].' '.$pDescription[$i].' '.$pImage[$i].' '.$pPrice[$i];
        }

        //var_dump($pName);
            

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <?php
            // for($i=0;$i<20;$i++)
            // {
            //     echo 
            //         '
            //         <input placeholder="name'.$i.'" type="text" name="name'.$i.'">
            //         <br>
            //         <input placeholder="desc'.$i.'" type="text" name="desc'.$i.'">
            //         <br>
            //         <input placeholder="image'.$i.'" type="text" name="image'.$i.'">
            //         <br>
            //         <input placeholder="price'.$i.'" type="text" name="price'.$i.'">
            //         <br>
            //         <hr>
            //         ';
            // }

        

        ?>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>