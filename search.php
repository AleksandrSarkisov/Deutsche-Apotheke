<?php
    include("include/db_connect.php");
    include("functions/functions.php");

    header('Content-Type: text/html; charset=utf-8');
    $search = clear_string($_GET["q"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск - <?php echo $search; ?></title>

    <link rel="icon" type="image/png" href="img/icon.png">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/TextChange.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <nav class="menu nav">
            <div id="menu-list">
                <ul>
                    <hr>
                    <li><a href="#medications">Лекарства</a></li>
                    <hr>
                    <li><a href="#vitamin">Витамины</a></li>
                    <hr>
                    <li><a href="#gestation">Беременность</a></li>
                    <hr>
                    <li><a href="#doppelherz">Doppelherz</a></li>
                    <hr>
                    <li><a href="#for_kids">Для детей</a></li>
                </ul>
            </div>
        </nav>
        <div id="header">
            <img id="logo" src="img/logo2.png" alt="">
            <form id="search" method="GET" action="search.php?q=">
                <input type="text" name="q" placeholder="Поиск товара" value="<?php echo $search; ?>">
                <button><img src="img/search-icon.png"></button>
            </form>
        </div>
        <hr>
        <div id="search-products">
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE full_title LIKE '%$search%' ", $link);
                    if (mysql_num_rows($result) > 0)
                    {
                        $row = mysql_fetch_array($result);
                        do
                        {
                            echo '
                                <div class="product">
                                    <img src="catalog/'.$row["img"].'">
                                    <strong class="product_title">'.$row["ger_title"].'</strong>
                                    <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                    <div class="product_count_price">
                                        <strong>'.$row["mini_description"].'</strong>
                                        <strong>'.$row["price"].'&#8364;</strong>
                                    </div>
                                </div>
                            ';
                        }
                        while($row = mysql_fetch_array($result));
                    } else
                    {
                        echo '<h3>По Вашему запросу товаров не найдена. Проверьте коррекность вводимого товара.</h3>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>