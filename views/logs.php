<?php
require_once "../models/userModel.php";
$borrowList=User:: borrowLog($_COOKIE['id_user']);
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
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowList as $borrow){ ?>
             <tr>
                <td><?= $borrow['id_borrow'] ;?></td>
                <td><?= $borrow['start_date']; ?></td>
                <td><?= $borrow['end_date']; ?></td>
                <td><?= $borrow['title']; ?></td>

                <?php if($borrow['end_date']== NULL) { ?>
                  <td><a href="traitement/action.php?borrow=<?=$borrow['id_borrow'] ; ?>&bookid=<?=$borrow['book_id']; ?>">Return the book</a></td>
               <?php } ?>
             </tr>
           <?php } ?>
        </tbody>
    </table>
</body>
</html>