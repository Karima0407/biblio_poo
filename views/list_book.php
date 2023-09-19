<?php
if(isset($_COOKIE['user_role'])){
    echo "Bienvenue ".$_COOKIE['user_role'];
}
// if (isset($_SESSION['user_role'])) {
//     echo "Bienvenue" . $_SESSION['user_role'];
// }
require_once "inc/nav.php";
require_once "../models/BookModel.php";
$listBook=Book::listBook();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../views/assets/css/style.css">
</head>
<body>
   <div class="container">
     <?php foreach ($listBook as $book){ ?>
       <div class="book">
         <h1><?=$book['title'] ;?></h1>
         <h2><?= $book['author']; ?></h2>
         <p><?= $book['publication']; ?></p>
         
         <?php if($book['state']=="available") { ?>
             <a href="traitement/action.php?book=<?=$book ['id_book'] ; ?>">Borrow this book</a>
         <?php } ?>
       </div>
   <?php } ?>
   </div>
</body>
</html>

