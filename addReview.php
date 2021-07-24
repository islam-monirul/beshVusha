<?php
  session_start();
  if($_SESSION['userType']==0){
    $shopID = $_POST['shop'];
    $userID = $_POST['customer'];
    $details = $_POST['details'];  
    
      try{
          
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="INSERT INTO review(details,shopid,userid) VALUES('$details',$shopID,'$userID')";
        
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