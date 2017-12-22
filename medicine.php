<?php
    include("include/db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
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
            <form id="search">
                <input type="text" name="" placeholder="Поиск товара">
                <button><img src="img/search-icon.png"></button>
            </form>
        </div>
        <hr>
        <div id="medications">
            <h1>Лекарства</h1>
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE category = 'medication'", $link);
						if(mysql_num_rows($result) > 0)
						{
							$row = mysql_fetch_array($result);
							do
							{
								echo '
									<div class="product">
										<img src="catalog/'.$row["img"].'">
                                        <strong class="product_title">'.$row["title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                        <div class="product_count_price">
                                            <strong>'.$row["count"].'</strong>
                                            <strong>'.$row["price"].'&#x20ac;</strong>
                                        </div>
									</div>
								';
							}
							while ($row = mysql_fetch_array($result));
						}
				?>
            </div>
        </div>
        <hr>
        <div id="vitamin">
            <h1>Витамины</h1>
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE category = 'vitamin'", $link);
                        if(mysql_num_rows($result) > 0)
                        {
                            $row = mysql_fetch_array($result);
                            do
                            {
                                echo '
                                    <div class="product">
                                        <img src="catalog/'.$row["img"].'">
                                        <strong class="product_title">'.$row["title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                        <div class="product_count_price">
                                            <strong>'.$row["count"].'</strong>
                                            <strong>'.$row["price"].'&#x20ac;</strong>
                                        </div>
                                    </div>
                                ';
                            }
                            while ($row = mysql_fetch_array($result));
                        }
                ?>
            </div>
        </div>
        <hr>
        <div id="gestation">
            <h1>Беременность</h1>
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE category = 'gestation'", $link);
                        if(mysql_num_rows($result) > 0)
                        {
                            $row = mysql_fetch_array($result);
                            do
                            {
                                echo '
                                    <div class="product">
                                        <img src="catalog/'.$row["img"].'">
                                        <strong class="product_title">'.$row["title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                        <div class="product_count_price">
                                            <strong>'.$row["count"].'</strong>
                                            <strong>'.$row["price"].'&#x20ac;</strong>
                                        </div>
                                    </div>
                                ';
                            }
                            while ($row = mysql_fetch_array($result));
                        }
                ?>
            </div>
        </div>
        <hr>
        <div id="doppelherz">
            <h1>Doppelherz</h1>
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE category = 'doppelherz'", $link);
                        if(mysql_num_rows($result) > 0)
                        {
                            $row = mysql_fetch_array($result);
                            do
                            {
                                echo '
                                    <div class="product">
                                        <img src="catalog/'.$row["img"].'">
                                        <strong class="product_title">'.$row["title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                        <div class="product_count_price">
                                            <strong>'.$row["count"].'</strong>
                                            <strong>'.$row["price"].'&#x20ac;</strong>
                                        </div>
                                    </div>
                                ';
                            }
                            while ($row = mysql_fetch_array($result));
                        }
                ?>
            </div>
        </div>
        <hr>
        <div id="for_kids">
            <h1>Для детей</h1>
            <div class="block_products">
                <?php
                    $result = mysql_query("SELECT * FROM table_products WHERE category = 'for_kids'", $link);
                        if(mysql_num_rows($result) > 0)
                        {
                            $row = mysql_fetch_array($result);
                            do
                            {
                                echo '
                                    <div class="product">
                                        <img src="catalog/'.$row["img"].'">
                                        <strong class="product_title">'.$row["title"].'</strong>
                                        <strong class="product_rus_title">'.$row["rus_title"].'</strong>
                                        <div class="product_count_price">
                                            <strong>'.$row["count"].'</strong>
                                            <strong>'.$row["price"].'&#x20ac;</strong>
                                        </div>
                                    </div>
                                ';
                            }
                            while ($row = mysql_fetch_array($result));
                        }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>