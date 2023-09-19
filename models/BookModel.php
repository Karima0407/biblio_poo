<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/biblio_poo/models/database.php";
class Book {
    public static function addBook($title,$author,$publication){
        $db=Database::dbConnect();
        // preparer la requete 
        $request=$db->prepare("INSERT INTO books (title,author,publication) VALUES (?,?,?)");
        // execution de la requete
        try{
         $request->execute(array($title,$author,$publication));
         header("Location: http://localhost/biblio_poo/views/list_book");

        }catch (PDOException $e){
           echo $e->getMessage();
        }
    }

    // methode pour recuperer la liste des livres 
    public static function listBook(){
        // se connecter a la data base
        $db=Database::dbConnect();
        // preparer la requete
        $request=$db->prepare("SELECT * FROM books");
        // executer la requete
        try{
            $request->execute();
            // recuperer le resultat de la requete dans un tableau listBook 
            // $listBook c'est la variable qui stocke les valeurs de tableau ou il ya la liste des Book
            $listBook=$request->fetchAll();
            return $listBook;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // methode pour emprunter un livre
    public static function borrowBook($user,$book){
        //se connecter a la base de données 
        $db=Database::dbConnect();

        // preparer la requete
        $request=$db->prepare("INSERT INTO borrows (start_date,user_id,book_id) VALUES (NOW(), ?,?)");
        // executer la requete
        try{
            $request->execute(array($user,$book));
            // requete pour mettre le statut du livre a unavailable 
            $request1=$db->prepare("UPDATE books SET state=? WHERE id_book=?");
            // executer la requete
            try{
             $request1->execute(array("unavailable",$book));
             header("Location:http://localhost/biblio_poo/views/logs");
            }catch(PDOException $e){
               echo $e->getMessage();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // methode pour rendre un livre
    public static function returnBook($borrow, $bookId)
    {
        // se connecter a bd
        $db = Database::dbConnect();
        // preparer la requete
        $request = $db->prepare("UPDATE borrows SET end_date = NOW() WHERE id_borrow = ?");
        // executer la requete
        try {
            $request->execute(array($borrow));
            // la requete pour metre a jour le livre a available
            $request1 = $db->prepare("UPDATE books SET state = ? WHERE id_book = ?");
            try {
                $request1->execute(array("available", $bookId));
                header("Location: http://localhost/biblio_poo/views/logs");
            } catch (PDOException $e) {
                $e->getMessage();
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}