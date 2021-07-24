<?php

session_start();
if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail']) && isset($_SESSION['ownerID'])){

    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userID= $_SESSION['ownerID'];

    $preOrder="SELECT * FROM cart WHERE userID='$userID'";
    // print_r($preOrder);

    $resultFromPreOrder=$dbcon->query($preOrder);
    $allResult=$resultFromPreOrder->fetchAll();

    if($resultFromPreOrder->rowCount()>0){

          foreach($allResult as $row){
              $pid=$row['product_code'];
              $psize=$row['size'];
              $qnt=$row['quantity'];
              $tamt=$row['total_price'];
              $cid=$row['userID'];
              $pname=$row['product_name'];

              // print_r($pid);
              // echo "<br>";
              // print_r($qnt);
              // echo "<br>";
              // print_r($tamt);
              // echo "<br>";
              // print_r($cid);

              // echo "<br>";
              // echo "<br>";
              // echo "<br>";

              $tempQ="INSERT INTO all_orders(product_id,product_size,quantity,total_amt,cid,prod_name) VALUES($pid,'$psize',$qnt,$tamt,'$cid','$pname')";

              try{
                $dbcon->exec($tempQ);


                $afterOrder="DELETE FROM cart WHERE userID='$cid' AND product_code=$pid";

                $dbcon->exec($afterOrder);

                ?>
                  <script>alert("Thank you ! We have received your order. A member of our team will contact you soon.")</script>
                  <script>window.location.assign('customerHome.php');</script>
                <?php 

              }

              catch(PDOException $ex){
                ?>
                  <script>window.location.assign('cart.php');</script>
                <?php 
              }

          }

    }

    else{
      ?>
          <script>window.location.assign('cart.php');</script>
      <?php 
    }
  
}


else{
    ?>
        <script>window.location.assign('index.php');</script>
    <?php 
}


?>