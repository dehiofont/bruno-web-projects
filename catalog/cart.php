<?php
    session_start();

    //  print_r($_SESSION['cartAdd']);
    // echo '<br>';

    // print_r($_SESSION['cart']);
    // echo '<br><br><br><br>';

    $totalPrice = 0;

    if(!empty($_SESSION['cartAdd']))
    {
        if(empty($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
            $_SESSION['cart'][] = $_SESSION['cartAdd'];
            //echo '<p>poop0</p>';
        }
        else
        {
            addToCart($_SESSION['cartAdd']);
            //echo '<p>poop1</p>';
        }           
    }

    $_SESSION['cartAdd'] = array();




    if(isset($_POST['updateCart']))
    {

        for($i = 0; $i < count($_SESSION['cart']); $i++)
        {
            $_SESSION['cart'][$i]['quantity'] = $_POST['item'.$i];

            if($_SESSION['cart'][$i]['quantity'] == 0)
            {
                echo '<br><br>';
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);

            }
        }
    }

    if(isset($_SESSION['cart']))
    {
        for($i = 0; $i < count($_SESSION['cart']); $i++)
        {
            $totalPrice += $_SESSION['cart'][$i]['quantity'] * $_SESSION['cart'][$i]["price"];
        }   
    }
    




    //------------------FUNCTIONS------------------------------------

    function addToCart($item)
    {   $dupe = false;
        $id ="";
        for($i = 0; $i < count($_SESSION['cart']); $i++)
        {        
            if($_SESSION['cart'][$i]['name'] == $item['name'])
            {
                $dupe = true;
                $id = $i;
            }
        }

        if($dupe)
        {
            $_SESSION['cart'][$id]['quantity'] += $item['quantity'];
            //echo '<p>poop2</p>';
        }
        else
        {
            $_SESSION['cart'][] = $item;
            //echo '<p>poop3</p>';
        }
        
    }



    // $inventory = $_SESSION['inventory'];
    // $cart = array();

    // if(isset($_SESSION['cart']))
    // {
    //     $cart = $_SESSION['cart'];
    // }


    // print_r($_SESSION['cartAdd']);
    // echo '<br>';
    // print_r($_SESSION['cart']);
    // echo '<br>';
    // echo $_SESSION['cart'][0]["quantity"];
    // echo '<br>';
    // var_dump($cart);
    // echo '<br>';

    // if(!empty($_SESSION['cartAdd']) && !empty($cart))
    // {
    //     addToCart($_SESSION['cartAdd']);
    // }
    // else
    // {
    //     $cart[] = $_SESSION['cartAdd'];
    //     $_SESSION['cart'] = $cart;
    // }

    // unset($_SESSION['cartAdd']);
    
    // var_dump($cart);

    

    // function addToCart($item)
    // {
    //     for($i = 0; $i < count($cart); $i++)
    //     {
    //         if($cart[$i]['name'] == $item[$i]['name'])
    //         {
    //             $cart[$i]['quantity'] += $item[$i]['quantity'];
    //         }
    //         else
    //         {
    //             $cart[] = $item;
    //         }
    //     }
        
    //     $_SESSION['cart'] = $cart;
    // }

    // function removeFromCart($item)
    // {
    //     for($i = 0; $i < count($cart); $i++)
    //     {
    //         if($cart[$i]['name'] == $item[$i]['name'])
    //         {
    //             unset($cart[$i]);
    //         }
    //     }

    //     $_SESSION['cart'] = $cart;
    // }

    
?>

<!DOCTYPE html>
<html lang="en">
    <?php include_once('includes/head.php');?>
    <body>
        
        <?php include_once('includes/nav.php');?>


        <?php

            if(empty($_SESSION['cart']))
            {
                echo 
                    '
                        <h1>YOUR CART IS EMPTY</h1>
                        <img src="https://blogmedia.dealerfire.com/wp-content/uploads/sites/539/2019/10/Ghost-Town-Feature_b.jpg">
                    ';
            }

            if(!isset($_POST['orderSubmitted']) && !empty($_SESSION['cart']))
            {
                echo
                "
                    <h1 class='game-inventory'>".strtoupper($_SESSION['userName'])."'S SHOPPING CART</h1>
                    <hr>                    
                ";
                echo'<form action="" method="post">';
                    echo '<div class"top-cart">';
                        for($i = 0; $i < count($_SESSION['cart']); $i++)
                        {
                            echo
                            '
                                <div class="cart-items">
                                    <img class="cart-image" src="images/'.$_SESSION['cart'][$i]["image"].'.png" alt="">

                                    <h3>'.$_SESSION['cart'][$i]["name"].'</h3>

                                    <p>UNIT PRICE: '.$_SESSION['cart'][$i]["price"].'.00</p>
                                    
                                    <p>QUANTITY: </p>
                                    <input class="item-amount" name="item'.$i.'" min="0" type="number" value="'.$_SESSION['cart'][$i]["quantity"].'">

                                    <p>TOTAL : '.($_SESSION['cart'][$i]["price"] * $_SESSION['cart'][$i]["quantity"]).'.00</p>
                                    
                                </div>
                            ';
                        }
                    echo '</div>';
                echo'<hr><br><input type="submit" name="updateCart" value="UPDATE CART AMOUNTS"></form><br><hr>';

                echo
                    '
 
                        

                        <hr>

                        <div>
                            <h3 class="grand-total">GRAND TOTAL.............................................................'.$totalPrice.'.00</h3> 
                        </div>
                        
                        <hr>

                        <form action="" method="post">
                        <input type="submit" name="orderSubmitted" value="PLACE ORDER">
                        </form>
                    ';
            }
            else if(!empty($_SESSION['cart']))
            {
                echo
                    '
                        <h1 class="game-inventory">THANK YOU '.strtoupper($_SESSION['userName']).' FOR YOUR PURCHASE!</h1>
                        <hr>
                        <h3>YOUR RECIEPT</h3>
                    ';
                echo'<div class="reciept">';
                for($i = 0; $i < count($_SESSION['cart']); $i++)
                {
                    echo
                    '
                        
                            <div class="r-items">
                                <img class="cart-image" src="images/'.$_SESSION['cart'][$i]["image"].'.png" alt="">

                                <h3>'.$_SESSION['cart'][$i]["name"].'</h3>

                                <p>UNIT PRICE: '.$_SESSION['cart'][$i]["price"].'.00</p>

                                <p>QUANTITY: '.$_SESSION['cart'][$i]["quantity"].'</p>

                                <p>TOTAL : '.($_SESSION['cart'][$i]["price"] * $_SESSION['cart'][$i]["quantity"]).'.00</p>
                                <hr>
                            </div>
                        
                    ';
                }
                echo
                '
                    <div>
                        <h3>GRAND TOTAL................'.$totalPrice.'.00</h3> 
                    </div>
                    <div class="buffer2"></div> 
                ';
                echo'</div>';

                
            }
            
        ?> 
        <div class="buffer"></div> 

        <?php include_once('includes/footer.php');?>

    </body>
</html>