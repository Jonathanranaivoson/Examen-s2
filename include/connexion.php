<?php
   function dbconnect()
 {
    static $connect = null;
    
    if ($connect === null){
        $connect = mysqli_connect('localhost', 'root', '', 'basetest');

          if (!$connect){
              die('Erreur de connexion a la base de donnees: ' . mysqli_connect_error());
          }
    }
   return $connect;
 }
?>