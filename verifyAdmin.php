<?php

    
if(isset($_POST['usernameAdmin']) && isset($_POST['usernameAdmin']) && !empty($_POST['passwordAdmin']) && !empty($_POST['passwordAdmin'])){
    
    $username=$_POST['usernameAdmin'];
    $pass=$_POST['passwordAdmin'];
    
    try{
        
        //database connect
        $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $sqlquery="SELECT * FROM admin WHERE username='$username' AND password='$pass'";
        
        try{
            $returnvalue=$dbcon->query($sqlquery);
            if($returnvalue->rowCount()==1){
                session_start();
                
                $_SESSION['username']=$username;
                $_SESSION['userType']=2;
                
                ?>
                <script>window.location.assign('admin_dashboard.php')</script>
                <?php
            }
            
            else{
                ?>
                <script>window.location.assign('adminLogin.php')</script>
                <?php
            }
        }
        catch(PDOException $ex){
            ?>
            <script>window.location.assign('adminLogin.php')</script>
            <?php
        }
        
    }
    catch(PDOException $ex){
        ?>
        <script>window.location.assign('adminLogin.php')</script>
        <?php
    }
    
}

else{
    ?>
    <script>window.location.assign('adminLogin.php')</script>
    <?php
}

?>