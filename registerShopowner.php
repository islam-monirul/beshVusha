<?php

    //saving the values into variable
    $name = $_POST['nameOwner'];
    $mail = $_POST['emailOwner'];
    $pass = md5($_POST['passwordOwner']);
    $nid = $_POST['ownerNID'];
    $bank = $_POST['ownerBank'];
    $acc = $_POST['ownerBankNo'];
    $phone = $_POST['ownerPhone'];
    

    try{
        
      //database connection
      $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
      $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      
      $sqlquery="SELECT COUNT(*) FROM user WHERE type=1";
      
      try{
          $result= $dbcon->query($sqlquery);
          $num_rows = $result->fetchColumn();
          // echo "$num_rows Rows\n";

          $id_no = $num_rows + 1;
          $id = "SO-" . $id_no;
          // echo "$id \n";

          $insertInUser = "INSERT INTO user(id,email,name,password,type,contact_number,status) VALUES('$id','$mail','$name','$pass',1,'$phone',0)";

          // print $insertInUser;
          
          try{
            //mysql query execution
            $dbcon->query($insertInUser);

            $insertInOwner = "INSERT INTO shop_owner VALUES('$id','$nid','$bank','$acc')";

            try{
              //mysql query execution
              $dbcon->query($insertInOwner);
              
              ?>
              <script>window.location.assign('requestPendingPage.php')</script>
              <?php
            }
            catch(PDOException $ex){
                ?>
                <script>window.location.assign('shopOwnerRegister.php')</script>
                <?php
            }
          }
          catch(PDOException $ex){
              ?>
              <script>window.location.assign('shopOwnerRegister.php')</script>
              <?php
          }



      }
      catch(PDOException $ex){
          ?>
          <script>window.location.assign('shopOwnerRegister.php')</script>
          <?php
      }
      
    }
    catch(PDOException $ex){
        ?>
        <script>window.location.assign('shopOwnerRegister.php')</script>
        <?php
    }


?>