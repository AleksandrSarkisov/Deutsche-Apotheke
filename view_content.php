<?php
    include("include/db_connect.php");
    include("functions/functions.php");
    header('Content-Type: text/html; charset=utf-8');

    $id = clear_string($_GET["id"]);
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
        <hr>
        <div>
        	<?php 
        		$result = mysql_query("SELECT * FROM table_products WHERE table_products.products_id = '$id'", $link);

        		if(mysql_num_rows($result) > 0){
	        		$row = mysql_fetch_array($result);
	        		do{
	        			if($row["rus_title"]){
			        		echo'
			        			<div id="view_product">
			        				<img src="catalog/'.$row["img"].'">
				        			<div>
				        				<div id="view_title">
					        				<h4>'.$row["ger_title"].'</h4><h4>('.$row["rus_title"].')</h4>
					        			</div>
					        			<hr>
					        			<div id="view_description">
					        				<p>'.$row["description"].'</p>
					        			</div>
					        			<hr>
					        			<div id="view_footer">
					        				<p>'.$row["mini_description"].'</p>
					        				<p> Цена: '.$row["products_price"].'</p>
					        			</div>
					        		</div>
			        			</div>
			        		';
						}
						else{
							echo'
			        			<div id="view_product">
			        				<img src="catalog/'.$row["img"].'">
			        				<div>
				        				<div id="view_title">
					        				<h4>'.$row["ger_title"].'</h4>
					        			</div>
					        			<hr>
					        			<div id="view_description">
					        				<p>'.$row["description"].'</p>
					        			</div>
					        			<hr>
					        			<div id="view_footer">
					        				<p>'.$row["mini_description"].'</p>
					        				<p> Цена: '.$row["products_price"].'</p>
					        			</div>
					        		</div>
			        			</div>
			        		';	
						}
	        		}
	        		while($row = mysql_fetch_array($result));
        		}
        	?>
        </div>
	</div>
</div>
</body>
</html>