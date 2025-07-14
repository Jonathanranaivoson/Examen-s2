<?php
   function dbconnect()
 {
    static $connect = null;
    
    if ($connect === null){
        $connect = mysqli_connect('localhost', 'root', '', 'basetest'); //'localhost', 'ETU004392', 'KyenYJ6D', 'db_s2_ETU004392'

          if (!$connect){
              die('Erreur de connexion a la base de donnees: ' . mysqli_connect_error());
          }
    }
   return $connect;
 }
?>