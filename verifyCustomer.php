<?php

    
if(isset($_POST['emailCustomer']) && isset($_POST['passwordCustomer']) && !empty($_POST['emailCustomer']) && !empty($_POST['passwordCustomer'])){
    
    $mail=$_POST['emailCustomer'];
    $pass=md5($_POST['passwordCustomer']);
    echo $mail;
    
    try{
        
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="SELECT * FROM user WHERE email='$mail' AND password='$pass' AND type=0";
        
        try{
            $returnvalue=$dbcon->query($sqlquery);
            if($returnvalue->rowCount()==1){
                session_start();
                
                $_SESSION['useremail']=$mail;
                $_SESSION['userType']=0;

                // getting user id
                $table = $returnvalue->fetchAll();
                $row = $table[0];

                // $id = $row['id'];
                // echo $id;
                
                //saving id into session
                $_SESSION['ownerID'] = $row['id'];
                
                ?>
                <script>window.location.assign('customerHome.php')</script>
                <?php
            }
            
            else{
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