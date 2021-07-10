<?php

    
if(isset($_POST['emailOwner']) && isset($_POST['passwordOwner']) && !empty($_POST['emailOwner']) && !empty($_POST['passwordOwner'])){
    
    $mail=$_POST['emailOwner'];
    $pass=md5($_POST['passwordOwner']);
    
    try{
        
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="SELECT * FROM user WHERE email='$mail' AND password='$pass' AND type=1";
        try{
            $returnvalue=$dbcon->query($sqlquery);
            if($returnvalue->rowCount()==1){
                session_start();
                
                $_SESSION['useremail']=$mail;
                $_SESSION['userType']=1;

                // getting user id
                $table = $returnvalue->fetchAll();
                $row = $table[0];

                // $id = $row['id'];
                // echo $id;
                
                //saving id into session
                $_SESSION['ownerID'] = $row['id'];

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
              ?>
              <script>window.location.assign('shopOwnerLogin.php')</script>
              <?php
          }
        
    }
    catch(PDOException $ex){
        ?>
        <script>window.location.assign('shopOwnerLogin.php')</script>
        <?php
    }
    
}

else{
    ?>
    <script>window.location.assign('shopOwnerLogin.php')</script>
    <?php
}

?>