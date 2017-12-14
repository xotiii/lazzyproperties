<?php

$dsn = getenv('MYSQL_DSN');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

try{
    $dbh = new pdo( $dsn,
                    $user,
                    $pass);
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $ex){
    echo 'Connection failed: ' . $ex->getmessage();
}
?>