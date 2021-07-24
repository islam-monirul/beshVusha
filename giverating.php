<?php
  session_start();
  if($_SESSION['userType']==0){
    $shopID = $_POST['shopid'];
    $rating = $_POST['rtng'];
    $userID = $_SESSION['ownerID'];
    
      try{
          
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="INSERT INTO rating(rating_point,shopid,userid) VALUES($rating,$shopID,'$userID')";
        
        try{
                $dbcon->query($sqlquery);
                
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