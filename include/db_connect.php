<?php
	$db_host = 'localhost';
	$db_user = 'admin';
	$db_pass = 'MisterX10';
	$db_database = 'db_da';

	$link = mysql_connect($db_host, $db_user, $db_pass);

	mysql_select_db($db_database, $link) or die ("Нет соединения с БД".mysql_error());
	mysql_query("Set names cp1251");
?>