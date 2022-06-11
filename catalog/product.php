<?php
    session_start();

    $productNum = 0;
    $inventory = $_SESSION['inventory'];
    $ec = 0;
    $amount = 0;
    
    // if($_SERVER['HTTP_HOST'] == 'localhost')
    // {
    //     define('HOST', 'localhost');
    //     define('USER', 'root');
    //     define('PASS', 'mertion44');
    //     define('DB', 'csis2440');
    // }
    // else
    // {
    //     define('HOST', 'gator4104.hostgator.com');
    //     define('USER', 'fornotti_bruno');
    //     define('PASS', 'Mertion44');
    //     define('DB', 'fornotti_csis2440');
    // }

    // $conn = mysqli_connect(HOST, USER, PASS, DB);

    // $sqlProducts = 'SELECT * FROM product;';
            
    // $productResults = mysqli_query($conn, $sqlProducts);

    // while($row = mysqli_fetch_array($productResults, MYSQLI_ASSOC))
    // {

    //     $game = array("name" => $row['name'],"description" => $row['description'],"image" => $row['image'],"price" => $row['price']);
    //     $inventory[] = $game;
    // }

    

    //mysqli_close($conn);

    if(isset($_GET['productNum']))
    {
        $productNum = $_GET['productNum'];
    }

    if(isset($_POST['productNum']))
    {
        $productNum = $_POST['productNum'];
    }

    if(isset($_POST['amount']))
    {
        $amount = $_POST['amount'];
    }

    if(!empty($_POST['submit']))
    {


        if(empty($_SESSION['loggedIn']))
        {
            header('location: ?ec='.$ec.'&productNum='.$productNum);
        }
        else
        {
            $cart = $inventory[$productNum];
            $cart[quantity] = $amount;
            //$_SESSION['cartAdd'] = $inventory[$productNum];
            $_SESSION['cartAdd'] = $cart;
            header('location: cart.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/head.php');?>
<body>
    <?php include_once('includes/nav.php');?>



    <div>
        <?php
            echo 
                '
                <h1 class="game-inventory">'.$inventory[$productNum]["name"].'</h1>
                <div class="product-on-display">
                    <br>
                    <div class="product-info-text">
                        <img class="product-image" src="images/'.$inventory[$productNum]["image"].'.png" alt="'.$inventory[$productNum]["name"].'">

                        <p>DESCRIPTION : '.$inventory[$productNum]["description"].'</p>
                        <p>PRICE : $'.$inventory[$productNum]["price"].'.00</p>
                        
                        <form action="" method="post">
                            <label for="amount">QUANTITY:</label>
                            
                            <input value="1" min="1" type="number" id="amount" name="amount" step="1">
                            <br>
                            <input type="submit" name="submit" value="ADD TO CART">
                        </form> 
                    </div>
                </div>               
                ';
            
            if(isset($_GET['ec']))
            {
                echo 
                    '
                        <div class="product-error">  
                            <h3>NO ACTIVE USER DETECTED</h3>
                            <p>Please login or create an account to add item to cart</p>
                            <a href="index.php"><button>LOGIN</button></a>
                            <a href="create-account.php"><button>CREATE ACCOUNT</button></a>
                        </div>
                     ';
            }
        ?>                            
    </div>


    <?php include_once('includes/footer.php');?>

</body>
</html>