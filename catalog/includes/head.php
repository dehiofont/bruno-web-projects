
<?php
    $displayName = $titleName = "";
    $pageName = basename($_SERVER['PHP_SELF']);
    
    if($pageName == 'index.php')
    {
        $displayName = "GAMESTORE-HOME";
    }
    else
    {
        $displayName = 'GAMESTORE-'.strtoupper(substr($pageName,0,-4));
    }

    
    echo
    '
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$displayName.'</title>
        <script src="js/script.js" defer></script>
        <link rel="stylesheet" href="css/style.css">
    <head>
    ';

?>