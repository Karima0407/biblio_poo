<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/biblio_poo/models/database.php";
class User
{

    // methode pour s'inscrire
    public static function inscription($name, $email, $password)
    {
        // connexion a la bd
        $db = Database::dbConnect();
        // preparation de la requete
        $request = $db->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?) ");

        // executer la requete
        try {
            $request->execute(array($name, $email, $password));


            // rediriger vers la page login.php
            header("Location:http://localhost/biblio_poo/views/login");



        } catch (PDOException $e) {
            $e->getMessage();
        }

    }
    // methode pour se connecter 
    public static function connexion($email, $password)
    {
        // se connecter a la bd
        $db = Database::dbConnect();
        // preparer la requete 
        $request = $db->prepare("SELECT *FROM users WHERE email=? ");
        try {
            $request->execute(array($email));
            $user = $request->fetch();
            // verifier si le mot de passe existe
            if (empty($user)) {
                $_SESSION['error_message'] = "cet email n'existe pas";
                header("Location:" . $_SERVER['HTTP_REFERER']);
            } else if (password_verify($password, $user['password'])) {

                setcookie("id_user", $user['id_user'], time() + 86400, "/", "localhost", false, true);
                setcookie("user_role", $user['role'], time() + 86400, "/", "localhost", false, true);
                header("Location: http://localhost/biblio_poo/views/list_book");
                
            } else {

                $_SESSION['error_message'] = "Mot de passe incorrect";
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }


    }

    // methode pour se deconnecter

    public static function logout()
    {


    }

    // methode pour avoir l'historique des emprunts d'un membre 

    public static function borrowLog($idUser){
        // se connecter a la base de données 
         $db=Database::dbConnect();
         // preparer la requete
         $request=$db->prepare("SELECT id_borrow, user_id, book_id, id_book,start_date,end_date, title FROM borrows, books WHERE borrows.book_id = books.id_book AND user_id=? ");
         //executer la requete
         try{
            $request->execute(array($idUser));
            // recuperer le resultat dans un tableau
            $borrowList=$request->fetchAll();
            return $borrowList;
         }catch(PDOException $e){
            $e->getMessage();
         }
         
    }
    

    // methode pour se désinscrire

    // public static function 
}