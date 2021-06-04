<?php
	class Database
	{
		private static $dbName = 'nodemcu_rfidrc522_mysql' ;
		private static $dbHost = 'localhost' ;
		private static $dbUsername = 'jjhenao48';
		private static $dbUserPassword = 'root';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('La función init no está permitida');
		}
		 
		public static function connect()
		{
		   // One connection through whole application
		   if ( null == self::$cont )
		   {     
			try
			{
			  self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
			}
			catch(PDOException $e)
			{
			  die($e->getMessage()); 
			}
		   }
		   return self::$cont;
		}
		 
		public static function disconnect()
		{
			self::$cont = null;
		}
	}
?>
