<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		include ("db_connect.php");
		include ("../functions/functions.php");

		$search = iconv("UTF-8", "cp-1251", strtolower(clear_string($_POST['text'])));
		$result = mysql_qurery("SELECT * FROM table_products WHERE title LIKE '%$search%", $link);

		if(mysql_num_rows($result) > 0)
		{
			$result = mysql_query("SELECT * FROM table_products WHERE title LIKE '%$search% LIMIT 10", $link);
			$row = mysql_fetch_array($result);
			do
			{
				echo '
					<li> <a href="search.php?q='.$row["title"].'">'.$row["title"].'</a></li>
				';
			}
			while ($row = mysql_fetch_array($result));
		}
	}
?>