<?php

session_start();

          if(isset($_GET['acc_row']) && !empty($_GET['acc_row'])){
                
                  $userID=$_GET['acc_row'];
                  
                  try{

                    //database connect
                    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sqlquery1="DELETE FROM shop_owner WHERE userid='$userID'";
                    $sqlquery2="DELETE FROM user WHERE id='$userID'";

                    try{

                        //mysql query execution
                        $dbcon->exec($sqlquery1);
                        $dbcon->exec($sqlquery2);

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