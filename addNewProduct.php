<?php

session_start();
if( isset($_POST['name']) && isset($_POST['prodPrice']) &&  isset($_POST['category']) &&  isset($_POST['details']) &&  isset($_POST['replaceD']) && isset($_POST['shopSelect']) && !empty($_POST['check_list']) && isset($_FILES['image'])){
    
    $name = $_POST['name'];
    $price = $_POST['prodPrice'];
    $cat = $_POST['category'];
    $shp = $_POST['shopSelect'];
    $det = $_POST['details'];
    $rd = $_POST['replaceD'];
    $f3 = substr($name, 0, 3);
    $rn = rand(10,1000);
    $pid = $f3. '-'. $rn;

    try{
      //database connect
      $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
      $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $img = $_FILES["image"]["name"];

      $insertQuery = "INSERT INTO products(prod_id,name,product_image,price,description,replacement_days,shopid,categoryid) VALUES('$pid','$name','$img', $price,'$det', $rd, $shp, $cat)";

      try{
        $dbcon->exec($insertQuery);
        // echo "<script>alert('Done 1');</script>";
        $dir = 'sources/products';
        move_uploaded_file($_FILES['image']['tmp_name'], "sources/products/$img");
        // echo "<script>alert('Done 2');</script>";

        $selection = "SELECT * FROM products WHERE prod_id LIKE '$pid'";
        // print_r($selection);

        $returnvalue=$dbcon->query($selection);
        if($returnvalue->rowCount()==1){

          $table = $returnvalue->fetchAll();
          $row = $table[0];

          $prod_ID = $row['id'];
          // print_r($prod_ID);

          foreach($_POST['check_list'] as $selected){
            $temp_query = "INSERT INTO size(size,productsid) VALUES('$selected',$prod_ID)";
            $dbcon->exec($temp_query);
            // echo "<script>alert('Done');</script>";
          }

          ?>
            <script>window.location.assign('shopOwnerDashboard.php')</script>
          <?php
        }

        else{
          ?>
          <script>window.location.assign('shopOwnerLogin.php')</script>
          <?php
        }
      }
      catch(PDOException $ex){
        echo "<script>location.assign('shopOwnerLogin.php');</script>";
      }

    }
    catch(PDOException $ex){
        echo "<script>location.assign('shopOwnerLogin.php');</script>";
    }

}

else{
    ?>
        <script>window.location.assign('index.php');</script>
    <?php 
}


?>