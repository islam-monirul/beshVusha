<?php

    //saving the values into variable
    $name = $_POST['nameCustomer'];
    // echo $name;
    $mail = $_POST['emailCustomer'];
    // echo $mail;
    $pass = md5($_POST['passwordCustomer']);
    // echo $pass;
    $house = $_POST['houseCustomer'];
    // echo $house;
    $road = $_POST['roadCustomer'];
    // echo $road;
    $area = $_POST['areaCustomer'];
    // echo $area;
    $city = $_POST['cityCustomer'];
    // echo $city;
    $phone = $_POST['phoneCustomer'];
    // echo $phone;

    try{
        
      //database connect
      $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
      $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      
      $sqlquery="SELECT COUNT(*) FROM user WHERE type=0";
      
      try{
          $result= $dbcon->query($sqlquery);
          $num_rows = $result->fetchColumn();
          // echo "$num_rows Rows\n";

          $id_no = $num_rows + 1;
          $id = "C-" . $id_no;
          // echo "$id \n";

          $insertInUser = "INSERT INTO user(id,email,name,password,type,contact_number,status) VALUES('$id','$mail','$name','$pass',0,'$phone',1)";

          // print $insertInUser;
          
          try{
            //mysql query execution
            $dbcon->query($insertInUser);

            $insertInCustomer = "INSERT INTO customer VALUES('$id','$house','$road','$area','$city')";

            try{
              //mysql query execution
              $dbcon->query($insertInCustomer);
              
              ?>
              <script>window.location.assign('customerLogin.php')</script>
              <?php
            }
            catch(PDOException $ex){
                ?>
                <script>window.location.assign('customerRegistration.php')</script>
                <?php
            }
          }
          catch(PDOException $ex){
              ?>
              <script>window.location.assign('customerRegistration.php')</script>
              <?php
          }



      }
      catch(PDOException $ex){
          ?>
          <script>window.location.assign('customerRegistration.php')</script>
          <?php
      }
      
    }
    catch(PDOException $ex){
        ?>
        <script>window.location.assign('customerRegistration.php')</script>
        <?php
    }


?>