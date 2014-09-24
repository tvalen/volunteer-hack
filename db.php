<?php 

  $url=parse_url(getenv("MYSQL_URL"));

  $server = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"],1);
  $link = mysql_connect($server, $username, $password);

  if ($link) {
	mysql_select_db($db);
	$table_create = "CREATE TABLE IF NOT EXISTS tempusers( user_id int not null auto_increment, user_fname varchar(100) NOT NULL, user_lname varchar(100) NOT NULL, user_email varchar(100),PRIMARY KEY(user_id), UNIQUE(user_fname,user_lname,user_email));";
	mysql_query($table_create);
	
	$user1_insert = "INSERT INTO tempusers(user_fname, user_lname, user_email) values('john','doe','john.doe@foo.com')";
    $user2_insert = "INSERT INTO tempusers(user_fname, user_lname, user_email) values('jane','doe','jane.doe@foo.com')";
	if (!mysql_query($user1_insert) || ! mysql_query($user2_insert)) {
		error_log("Can't insert into MySQL");
	}
	mysql_close($link);  
	
  } else {
	error_log("Can't connect to MySQL");
  }
/*
        try:
            
            log.debug('inserting user 1')
            cur.execute(user1_insert)
            log.debug('inserting user 2')
            cur.execute(user2_insert)
            db.commit()
        except:
            print "users already exist"
*/


?>