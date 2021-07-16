<?php

session_start();

          if(isset($_GET['com_row']) && !empty($_GET['com_row'])){
                
                  $comID=$_GET['com_row'];
                  
                  try{

                    //database connect
                    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $sqlquery="UPDATE complaint_box SET status=1 WHERE id='$comID'";

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