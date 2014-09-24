<?php 
	echo("Hello");
	
  $url=parse_url(getenv("MYSQL_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"],1);
  $link = mysql_connect($server, $username, $password);

  $table = "tempusers";
  
  if ($link) {
	mysql_select_db($db);

	$result = mysql_query("SELECT * FROM tempusers", $link);

	
	
	$fields_num = MYSQL_NUM_FIELDS($result);

        ECHO "<h1>Table: {$table} fields: {$fields_num} </h1>";
        ECHO "<table border='1'><tr>";
        // printing table headers
        FOR($i=0; $i<$fields_num; $i++)
        {
            $field = MYSQL_FETCH_FIELD($result);
            ECHO "<td>{$field->name}</td>";
        }
        ECHO "</tr>\n";
        // printing table rows
        WHILE($row = MYSQL_FETCH_ROW($result))
        {
            ECHO "<tr>";

            // $row is array... foreach( .. ) puts every element
            // of $row to $cell variable
            FOREACH($row AS $cell)
            ECHO "<td>$cell</td>";

            ECHO "</tr>\n";
        }
	

	mysql_free_result($result);
	
	mysql_close($link);  
	
  } else {
	echo("Error");
	error_log("Can't connect to MySQL");
  }
?>