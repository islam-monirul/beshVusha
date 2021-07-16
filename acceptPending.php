<?php

session_start();

          if(isset($_GET['acc_row']) && !empty($_GET['acc_row'])){
                
                  $userID=$_GET['acc_row'];
                  
                  try{

                    //database connect
                    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sqlquery="UPDATE user SET status=1 WHERE id='$userID'";

                    try{

                        //mysql query execution
                        $dbcon->exec($sqlquery);

                        ?>
                        <script>window.location.assign('successAdmin.php')</script>
                        <?php
                    }
                    catch(PDOException $ex){
                        ?>
                        <script>window.location.assign('admin_dashboard.php')</script>
                        <?php
                    }

              }
              catch(PDOException $ex){
                  ?>
                  <script>window.location.assign('admin_dashboard.php')</script>
                  <?php
              }

          }

          else{
              ?>
              <script>window.location.assign('adminLogin.php');</script>
              <?php 
          }


?>