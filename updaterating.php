<?php
  session_start();
  if($_SESSION['userType']==0){
    $shopID = $_POST['shopid'];
    $rating = $_POST['rate'];
    $userID = $_SESSION['ownerID'];
    
      try{
          
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="UPDATE rating SET rating_point=$rating WHERE shopid=$shopID AND userid='$userID'";
        
        try{
                $dbcon->exec($sqlquery);
                
                ?>
                <script>window.location.assign('ratingGiven.php')</script>
                <?php 
        }
        catch(PDOException $ex){
            ?>
            <script>window.location.assign('customerLogin.php')</script>
            <?php
        }
        
    }
    catch(PDOException $ex){
        ?>
        <script>window.location.assign('customerLogin.php')</script>
        <?php
    }
  }
  else{
    ?>
    <script>window.location.assign('customerLogin.php')</script>
    <?php
  }
?>