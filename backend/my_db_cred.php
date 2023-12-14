<?php

class MyConnection {

  static  public  function   getConnection() {
        $servername = 'localhost';
       $username = 'root';
        $password = '';
         $dbname = 'car_rental_system';

        $conn = new mysqli( $servername, $username, $password, $dbname );
        return $conn;
    }

    // Create connection
}