<?php

session_start();
if(isset($_SESSION['useremail'])&& !empty($_SESSION['useremail'])&& isset($_POST['shopName']) && isset($_POST['shopNumber']) &&  isset($_POST['areaSelect']) &&  isset($_POST['detailedAddress']) ){
    $i=$_POST['shopName'];
    $j=$_POST['shopNumber'];
    $k=$_POST['detailedAddress'];
    $l=$_POST['areaSelect'];
    $id0=$_SESSION['useremail'];

    try{
        $co=new PDO("mysql:host=localhost:3306;dbname=beshvusha", "root", "");
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $m="SELECT id FROM user WHERE email='$id0'";
        $m1=$co->query($m);
        if($m1->rowCount()==1){
            $table=$m1->fetchAll();
            $row=$table[0];
            $id=$row['id'];
            $sql="INSERT INTO shop(shop_name,shop_no,detailed_address,area,shop_owner_id) VALUES('$i','$j','$k','$l','$id')";            
            try{
                $co->exec($sql);
                ?><script>window.location.assign('shopOwnerDashboard.php')</script>
                <?php
                
            }
            catch(PDOException $ex){
                echo "<script>location.assign('shopOwnerLogin.php');</script>";
            }
            
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

else{
    ?>
        <script>window.location.assign('index.php');</script>
    <?php 
}


?>