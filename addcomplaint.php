<?php

session_start();
if(isset($_SESSION['useremail'])&& !empty($_SESSION['useremail'])&& isset($_POST['subject']) && isset($_POST['details']) ){
    $i=$_POST['subject'];
    $j=$_POST['details'];
    $k=$_SESSION['useremail'];

    try{
        $co=new PDO("mysql:host=localhost:3306;dbname=beshvusha", "root", "");
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $m="SELECT id FROM user WHERE email='$k'";
        $m1=$co->query($m);
        if($m1->rowCount()==1){
            $table=$m1->fetchAll();
            $row=$table[0];
            $id=$row['id'];
            $r=0;
            $sql="INSERT INTO complaint_box(subject,details,status,userid) VALUES('$i','$j','$r','$id')";            
            try{
                $co->exec($sql);
                ?><script>window.location.assign('customerHome.php')</script>
                <?php
                
            }
            catch(PDOException $ex){
                echo "<script>location.assign('index.php');</script>";
            }
            
        }
        
       else{
            ?>
            <script>window.location.assign('customerLogin.php')</script>
            <?php
        }

    }
    catch(PDOException $ex){
        echo "<script>location.assign('customerLogin.php');</script>";
    }

}

else{
    ?>
        <script>window.location.assign('index.php');</script>
    <?php 
}


?>