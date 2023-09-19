<?php 
class Database{

    // une methode staatic est une methode qu'on peut executer sans instancier la classe dans laquelle elle est implementée (crée)
    public static function dbConnect(){
      $conn=null;
      try{
        $conn=new PDO("mysql:host=localhost;dbname=biblio_db","root","");
      }catch (PDOException $e){
        $conn=$e->getMessage();
      }
      return $conn;
    }
}