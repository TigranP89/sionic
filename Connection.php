<?php

class Connection
{
  private static $instance;
  private function __construct()
  {
  }
  private function __clone()
  {
  }
  public function __wakeup()
  {
  }

  public static function getInstance() {
    if(empty(self::$instance)) {
      define('DB_SERVER','localhost');
      define('DB_USER','tigran_db');
      define('DB_PASS','inf20db23Tigran');
      define('DB_NAME','sionic');

      try {
        self::$instance = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);

        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
    return self::$instance;
  }
}