<?php
    //delete session variable & go to index page
    session_start();
    
    unset($_SESSION['username']);
    unset($_SESSION['userType']);
    session_destroy();

    ?>
        <script>window.location.assign('index.php')</script>
    <?php
    
?>