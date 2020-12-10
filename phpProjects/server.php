<?php
define("user", 'root');
define("pass",'ravzdhanju');

    class server
{
    function serverConnnection()
    {
        try
        {
            $connection = new PDO("mysql:host=localhost;dbname=web_project", user, pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $connection;
        }
        catch (PDOException $EXCEPTION) 
        {
            echo "Unsuccessful Connection".$EXCEPTION->getMessage();
        }
    }
}?>