<?php
    session_start();

    $inventory = array();
    
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

    $sqlProducts = 'SELECT * FROM product;';
            
    $productResults = mysqli_query($conn, $sqlProducts);

    while($row = mysqli_fetch_array($productResults, MYSQLI_ASSOC))
    {
        //$inventory[] = $row['id'];
        $game = array("id" => $row['id'],"name" => $row['name'],"description" => $row['description'],"image" => $row['image'],"price" => $row['price']);
        $inventory[$row['id']] = $game;
    }

    mysqli_close($conn);

    $_SESSION['inventory'] = $inventory;

    //var_dump($inventory);



    
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once('includes/head.php');?>
    <body>
        <?php include_once('includes/nav.php');?>



        <h1 class="game-inventory">GAME STORE INVENTORY</h1>
        <hr>
        <div id="inventory-grid">
            <?php
                for($i = 1; $i < count($inventory); $i++)
                {
                    echo '
                            <div class="pdisplay" id="pdisplay'.($i + 1).'">
                                <h3>'.$inventory[$i]["name"].'</h3>
                                <a href="product.php?productNum='.$i.'"><img class="catalog-image" id="cata-img-'.($i+1).'" src="images/'.$inventory[$i]["image"].'.png" alt="'.$inventory[$i]["name"].'"></a>
                                <p>PRICE : $'.$inventory[$i]["price"].'.00</p>
                                <a href="product.php?productNum='.$i.'"><button>VIEW PRODUCT DETAILS</button></a>
                                
                            </div>
                            <br><br>
                        ';
                }


                // <form action="/action_page.php">
                // <label for="amount">AMOUNT:</label>
                // <input value="0" type="number" id="amount'.$i.'" name="amount'.$i.'" step="1">
                // <input type="submit" name="submit" value="ADD TO CART">
                // </form>
            ?>


        </div>
        <?php include_once('includes/footer.php');?>
            
    </body>
</html>

