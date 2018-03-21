<?php
   class database
    {
        private static $host="localhost";
        private static $dbnam="montpellierhorizon";
        private static $user="root";
        private static $pass="";
        
        private static $connection = NULL;
        
        public static function connect()
        {
            try
            {
                self::$connection= new PDO("mysql:host=".self::$host.";dbname=".self::$dbnam,self::$user,self::$pass);
            }
            catch(PDOException $e)
            {
                die($e->getmessage());
            }
            return self::$connection;
        }
        
        public static function disconnect()
        {
           self::$connection= NULL; 
        }
        
    }
?>