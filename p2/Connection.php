<?php
define('DB_NAME', 'pinar_yucel');
define('DB_USER', 'pinar.yucel');
define('DB_PASSWORD', 'PdePaySb');
define('DB_SERVER', 'localhost');

class Connection
{
    public static function connect()
    {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

        if ($connection->connect_error) {
            die('Failed to connect to MySQL: ' . $connection->connect_error);
        }

        return $connection;
    }
}
