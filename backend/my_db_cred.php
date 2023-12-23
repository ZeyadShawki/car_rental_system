<?php

class MyConnection {
  static  public  function   getConnection() {
        $servername = 'localhost';
       $username = 'root';
        $password = '';
         $dbname = 'CAR_RENTAL_SYSTEM';
        $conn = new mysqli( $servername, $username, $password, $dbname );
        return $conn;
    }
    // Create connection
}