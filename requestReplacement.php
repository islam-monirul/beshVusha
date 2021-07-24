<?php

session_start();
if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail']) && isset($_SESSION['ownerID'])){

    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $orderID = $_POST['ordID'];
    $prev_size = $_POST['prevsize'];
    $new_size = $_POST['sizeSelect'];
    $reason = $_POST['reason'];

//    print_r($orderID);
//    echo "<br>";
//    print_r($prev_size);
//    echo "<br>";
//    print_r($new_size);
//    echo "<br>";
//    print_r($reason);
    
    $insertIntoReplacement = "INSERT INTO all_replacement_request(order_id,reason,desired_size) VALUES($orderID,'$reason','$new_size')";
    
    try{
        $dbcon->exec($insertIntoReplacement);
        
        $updatereqsts = "UPDATE all_orders
                         SET req_sts=1
                         WHERE id=$orderID";
        $dbcon->exec($updatereqsts);

        ?>  
            <script>alert('Thank You! Your request has been submitted successfully.')</script>
            <script>window.location.assign('myorders.php');</script>
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