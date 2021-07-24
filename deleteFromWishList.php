<?php

session_start();
if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail']) && isset($_SESSION['ownerID'])){

    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userID= $_SESSION['ownerID'];
    $prodID= $_GET['id'];

    // print_r($userID);
    // echo "<br>";
    // print_r($prodID);

    $addToWishlist="DELETE FROM wishlist WHERE product_id=$prodID AND customer_id='$userID'";

    try{
      $dbcon->exec($addToWishlist);
      ?>
        <script>window.location.assign('wishlist.php');</script>
      <?php
    }
    catch(PDOException $ex){
      ?>
        <script>window.location.assign('customerHome.php');</script>
      <?php 
    }
  
}


else{
    ?>
        <script>window.location.assign('index.php');</script>
    <?php 
}


?>