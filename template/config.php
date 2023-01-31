<?php

/**
 * Configuration file for database connection
 */

 $host = "localhost";
 $username = "dbconn";
 $password = "yes";
 $dbname = "dbconn";
 $dsn = "mysql:host=$host;dbname=$dbname";
 $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

?>