<?php
    include("include/db_connect.php");
    include("functions/functions.php");
    header('Content-Type: text/html; charset=utf-8');

    $id = clear_string($_GET["id"]);
    $action = clear_string($_GET["action"]);

    switch ($action){
        case 'clear':
            $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'", $link);
        break;
        
        case 'delete':
            $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'", $link);
        break;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина товаров</title>

    <link rel="icon" type="image/png" href="img/icon.png">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontAwesomeBootstrap/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/shop-script.js"></script>
    <script type="text/javascript" src="js/TextChange.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="menu nav">
            <div id="menu-list">
                <ul>
                    <hr>
                    <li><a href="index.php">Главная</a></li>
                    <hr>
                    <li><a href="medicine.php">Каталог</a></li>
                    <hr>
                </ul>
                <div id="cart">
                    <a href="cart.php?action=oneclick"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина пуста</a>
                </div>
            </div>
        </nav>
        <div id="header">
            <a href="index.php"><img id="logo" src="img/logo2.png" alt=""></a>
            <div id="block_search">
                <div id="block-header">    
                    <form id="search" method="GET" action="search.php?q=" autocomplete="off">
                        <input id="input_search" type="text" name="q" placeholder="Поиск товара">
                        <button><img src="img/search-icon.png"></button>
                    </form>
                    <ul id="result-search">
                        
                    </ul>
                </div>
            </div>
        </div>
        <?php
            $action = clear_string($_GET["action"]);
            switch($action){
                case 'oneclick':

                echo'
                    <div id="block_step">
                        <div id="step_name">
                            <ul>
                                <li><a href="cart.php?action=oneclick" class="active"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина товаров</a></li>
                                <li><a href="cart.php?action=confirm"><span class="glyphicon glyphicon-user"></span> Контактная информация</a></li>
                                <li><a href="cart.php?action=completion"><span class="glyphicon glyphicon-ok"></span> Завершение</a></li>
                            </ul>
                        </div>
                        <div id="cart_header">
                            <p>Шаг 1 из 3</p>
                            <a href="cart.php?action=clear"><button type="button" class="btn btn-danger">Очистисть</button></a>
                        </div>
                    </div>
                    <hr>
                ';

 
                $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);

                if(mysql_num_rows($result) > 0 )
                {
                    $row = mysql_fetch_array($result);
                    echo'
                        <div class="block_products" style="justify-content: flex-start;">
                    ';

                    do{
                        $int = $row["cart_price"] * $row["cart_count"];
                        $all_price = $all_price + $int;

                        if($row["rus_title"]){
                            echo '
                                <div class="product">
                                    <img src="catalog/'.$row["img"].'">
                                    <a href="view_content.php?id='.$row["products_id"].'">
                                        <strong class="product_title">'.$row["ger_title"].'</strong>
                                        <br>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong></a>
                                    <div class="product_count_price">
                                        <div class="count">
                                            <span cart_id="'.$row["cart_id"].'" class="count_deduct">-</span>
                                            <input type="text" id="input_id'.$row["cart_id"].'" cart_id="'.$row["cart_id"].'" class="cart_count" maxlength="3" value="'.$row["cart_count"].'" pattern="[0-9]{3}">
                                            <span cart_id="'.$row["cart_id"].'" class="count_addition">+</span>
                                        </div>
                                        <strong class="price" id="product'.$row["cart_id"].'" price="'.number_format($row["cart_price"], 2, '.', ' ').'">'.$int.'&#8364;</strong>
                                    </div>
                                    <div id="delete_product">
                                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><button type="button" class="btn btn-danger">Удалить</button></a>
                                    </div>
                                </div>
                            ';
                        }
                        else{
                            echo '
                                <div class="product">
                                    <img src="catalog/'.$row["img"].'">
                                    <a href="view_content.php?id='.$row["products_id"].'"><strong class="product_title">'.$row["ger_title"].'</strong></a>
                                    <br>
                                    <div class="product_count_price">
                                        <div class="count">
                                            <span cart_id="'.$row["cart_id"].'" class="count_deduct">-</span>
                                            <input type="text" id="input_id'.$row["cart_id"].'" cart_id="'.$row["cart_id"].'" class="cart_count" maxlength="3" value="'.$row["cart_count"].'" pattern="[0-9]{3}">
                                            <span cart_id="'.$row["cart_id"].'" class="count_addition">+</span>
                                        </div>
                                        <strong class="price" id="product'.$row["cart_id"].'" price="'.number_format($row["cart_price"], 2, '.', ' ').'">'.$int.'&#8364;</strong>
                                    </div>
                                     <div id="delete_product">
                                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><button type="button" class="btn btn-danger">Удалить</button></a>
                                    </div>
                                </div>
                            ';
                        }
                    }
                    while($row = mysql_fetch_array($result));
                    echo'
                        </div>
                        <div id="result_price">
                            <h2> Итог: <strong>'.number_format($all_price, 2, '.', ' ').'&#8364;</strong></h2>
                            <a href="cart.php?action=confirm"><button type="button" class="btn btn-success">Далее</button></a>
                        </div>
                    ';
                }
                else{
                    echo '<div id="empty_cart"><h2>Корзина пуста</h2></div>';
                }

                break;
                case 'confirm':

                echo'
                    <div id="block_step">
                        <div id="step_name">
                            <ul>
                                <li><a href="cart.php?action=oneclick"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина товаров</a></li>
                                <li><a href="cart.php?action=confirm" class="active"><span class="glyphicon glyphicon-user"></span> Контактная информация</a></li>
                                <li><a href="cart.php?action=completion"><span class="glyphicon glyphicon-ok"></span> Завершение</a></li>
                            </ul>
                        </div>
                        <div id="cart_header">
                            <p>Шаг 2 из 3</p>
                            <a href="cart.php?action=clear"><button type="button" class="btn btn-danger">Очистисть</button></a>
                        </div>
                    </div>
                    <hr>
                ';

                break;
                case 'completion':

                echo'
                    <div id="block_step">
                        <div id="step_name">
                            <ul>
                                <li><a href="cart.php?action=oneclick"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина товаров</a></li>
                                <li><a href="cart.php?action=confirm"><span class="glyphicon glyphicon-user"></span> Контактная информация</a></li>
                                <li><a href="cart.php?action=completion" class="active"><span class="glyphicon glyphicon-ok"></span> Завершение</a></li>
                            </ul>
                        </div>
                        <div id="cart_header">
                            <p>Шаг 3 из 3</p>
                            <a href="cart.php?action=clear"><button type="button" class="btn btn-danger">Очистисть</button></a>
                        </div>
                    </div>
                    <hr>
                ';

                break;

                default:

                echo'
                    <div id="block_step">
                        <div id="step_name">
                            <ul>
                                <li><a href="cart.php?action=oneclick" class="active"><span class="glyphicon glyphicon-shopping-cart"></span> Корзина товаров</a></li>
                                <li><a href="cart.php?action=confirm"><span class="glyphicon glyphicon-user"></span> Контактная информация</a></li>
                                <li><a href="cart.php?action=completion"><span class="glyphicon glyphicon-ok"></span> Завершение</a></li>
                            </ul>
                        </div>
                        <div id="cart_header">
                            <p>Шаг 1 из 3</p>
                            <a href="cart.php?action=clear"><button type="button" class="btn btn-danger">Очистисть</button></a>
                        </div>
                    </div>
                    <hr>
                ';

 
                $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products",$link);

                if(mysql_num_rows($result) > 0 )
                {
                    $row = mysql_fetch_array($result);
                    echo'
                        <div class="block_products" style="justify-content: flex-start;">
                    ';

                    do{
                        $int = $row["cart_price"] * $row["cart_count"];
                        $all_price = $all_price + $int;

                        if($row["rus_title"]){
                            echo '
                                <div class="product">
                                    <img src="catalog/'.$row["img"].'">
                                    <a href="view_content.php?id='.$row["products_id"].'">
                                        <strong class="product_title">'.$row["ger_title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong></a>
                                    <div class="product_count_price">
                                        <div class="count">
                                            <span cart_id="'.$row["cart_id"].'" class="count_deduct">-</span>
                                            <input type="text" id="input_id'.$row["cart_id"].'" cart_id="'.$row["cart_id"].'" class="cart_count" maxlength="3" value="'.$row["cart_count"].'" pattern="[0-9]{3}">
                                            <span cart_id="'.$row["cart_id"].'" class="count_addition">+</span>
                                        </div>
                                        <strong class="price" id="product'.$row["cart_id"].'" price="'.number_format($row["cart_price"], 2, '.', ' ').'">'.$int.'&#8364;</strong>
                                    </div>
                                    <div id="delete_product">
                                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><button type="button" class="btn btn-danger">Удалить</button></a>
                                    </div>
                                </div>
                            ';
                        }
                        else{
                            echo '
                                <div class="product">
                                    <img src="catalog/'.$row["img"].'">
                                    <a href="view_content.php?id='.$row["products_id"].'"><strong class="product_title">'.$row["ger_title"].'</strong></a>
                                    <br>
                                    <div class="product_count_price">
                                        <div class="count">
                                            <span cart_id="'.$row["cart_id"].'" class="count_deduct">-</span>
                                            <input type="text" id="input_id'.$row["cart_id"].'" cart_id="'.$row["cart_id"].'" class="cart_count" maxlength="3" value="'.$row["cart_count"].'" pattern="[0-9]{3}">
                                            <span cart_id="'.$row["cart_id"].'" class="count_addition">+</span>
                                        </div>
                                        <strong class="price" id="product'.$row["cart_id"].'" price="'.number_format($row["cart_price"], 2, '.', ' ').'">'.$int.'&#8364;</strong>
                                    </div>
                                     <div id="delete_product">
                                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><button type="button" class="btn btn-danger">Удалить</button></a>
                                    </div>
                                </div>
                            ';
                        }
                    }
                    while($row = mysql_fetch_array($result));
                    echo'
                        </div>
                        <div id="result_price">
                            <h2> Итог: <strong>'.number_format($all_price, 2, '.', ' ').'&#8364;</strong></h2>
                            <a href="cart.php?action=confirm"><button type="button" class="btn btn-success">Далее</button></a>
                        </div>
                    ';
                }
                else{
                    echo '<div id="empty_cart"><h2>Корзина пуста</h2></div>';
                }

                break;
            }
        ?>

    </div>
</div>
</body>
</html>