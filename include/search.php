<?php
    header('Content-Type: text/html; charset=utf-8');
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include ("db_connect.php");
		include ("../functions/functions.php");

		$search = strtolower(clear_string($_POST['text']));
		$result = mysql_query("SELECT * FROM table_products WHERE full_title LIKE '%$search%'", $link);

		if(mysql_num_rows($result) > 0)
		{
			$result = mysql_query("SELECT * FROM table_products WHERE full_title LIKE '%$search%' LIMIT 10", $link);
			$row = mysql_fetch_array($result);
			do
			{
				echo '
					<li><a href="search.php?q='.$row["full_title"].'">'.$row["full_title"].'</a></li>
				';
			}
			while ($row = mysql_fetch_array($result));
		}
	}
?>