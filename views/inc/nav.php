<nav>
    <a href="http://localhost/home">Home</a>
    <?php if(isset($_COOKIE['user_role'])&& $_COOKIE['user_role']=="admin"){ ?>
       <a href="http://localhost/home">Add Book</a>
   <?php } else { ?>
       <a href="http://localhost/logs">Log</a>
  <?php  } ?>
</nav>