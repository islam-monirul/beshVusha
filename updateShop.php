<?php

session_start();
if(isset($_SESSION['useremail'])&& !empty($_SESSION['useremail'])&& isset($_POST['shopName']) && isset($_POST['shopNumber']) &&  isset($_POST['areaSelect']) &&  isset($_POST['detailedAddress']) ){

    $shopID=$_POST['shopID'];
    $name=$_POST['shopName'];
    $number=$_POST['shopNumber'];
    $addr=$_POST['detailedAddress'];
    $area=$_POST['areaSelect'];

    // echo $shopID;
    // echo $name;
    // echo $number;
    // echo $addr;
    // echo $area;

    try{
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $updateShop="UPDATE shop SET shop_name='$name', shop_no='$number', detailed_address='$addr', area='$area' WHERE id='$shopID'";
        try{
            $dbcon->exec($updateShop);
            ?>
            <script>window.location.assign('successShopOwner.php');</script>
            <?php 
        }
        catch(PDOException $ex){
          ?>
            <script>window.location.assign('shopOwnerDashboard.php');</script>
          <?php 
        }
    }
    catch(PDOException $ex){
      ?>
      <script>window.location.assign('shopOwnerDashboard.php');</script>
      <?php
    }


}

else{
    ?>
        <script>window.location.assign('shopOwnerLogin.php');</script>
    <?php 
}


?>