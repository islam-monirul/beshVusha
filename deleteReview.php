<?php
  session_start();
  if($_SESSION['userType']==0){
    $reviewID = $_GET['id'];
    
      try{
          
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="DELETE FROM review WHERE id=$reviewID";
        
        try{
                $dbcon->exec($sqlquery);
                
                ?>
                <script>window.location.assign('allShopCustomer.php')</script>
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