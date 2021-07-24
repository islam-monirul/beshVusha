<?php

    session_start();
    if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail']) && $_SESSION['userType']==0 && isset($_SESSION['ownerID'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $shopID = $_GET['id'];
            $userID = $_SESSION['ownerID'];
            try{
              //database connect
              $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
              $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $shopNamequery = "SELECT shop_name FROM shop WHERE id='$shopID'";
              $temp = $dbcon->query($shopNamequery);

              $nameTable = $temp->fetchAll();
              $getShop = $nameTable[0];

              $userq="SELECT * FROM rating WHERE shopid=$shopID AND userid='$userID'";
              try{
                $alluser = $dbcon->query($userq);
    ?>
                <!doctype html>
                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">


                    <!-- font load -->
                    <link rel="preconnect" href="https://fonts.gstatic.com">
                    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

                    <!-- font awesome cdn -->
                    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


                    <style>
                .loader_bg{
                    position: fixed;
                    z-index: 999999;
                    background: #fff;
                    width: 100%;
                    height: 100%;
                }

                .loader{
                    border: 0 solid transparent;
                    border-radius: 50%;
                    width: 150px;
                    height: 150px;
                    position: absolute;
                    top: calC(50vh - 75px);
                    left: calc(50vw - 75px);
                }

                .loader:before, .loader:after{
                    content: "";
                    border: 1em solid #8DA3FD;
                    border-radius: 50%;
                    width: inherit;
                    height: inherit;
                    position: absolute;
                    top: 0;
                    left: 0;
                    animation: loader 2s linear infinite;
                    opacity: 0;
                }

                .loader:before{
                    animation-delay: .5s;
                }

                @keyframes loader{
                    0%{
                        transform: scale(0);
                        opacity: 0;
                    }

                    50%{
                        opacity: 1;
                    }

                    100%{
                        transform: scale(1);
                        opacity: 0;
                    }
                }
            </style>


                    <link rel="stylesheet" href="sources/css/style.css" type="text/css">
                    <title>Rating | beshVusha</title>

                </head>

                <body>
                
                    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8DA3FD">
                      <div class="container-fluid">
                            <a class="navbar-brand" href="customerHome.php">BeshVusha</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">
                              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                  <a class="nav-link" aria-current="page" href="customerHome.php">Home</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="complaintbox.php">Complaint Box</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="allShopCustomer.php">Shops</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="myorders.php">My Orders</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="allProduct.php">Products</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="myProfile.php">My profile</a>
                                </li>
                              </ul>
                              
                              <div class="d-flex">
                                  <button type="button" class="btn-danger" id="logoutbtn" style="padding: 5px 35px;">Logout</button>
                              </div>
                              
                            </div>
                        
                      </div>
                    </nav>

                    <div class="loader_bg">
                      <div class="loader"></div>
                    </div>

                    <div class="container" style="padding-top: 40px; text-align: center;">

                        <div class="row">
                              <?php
                                if($alluser->rowCount()==0){
                                  ?>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                      <h4>SHOP NAME: &nbsp<strong><?php echo $getShop['shop_name'] ?></strong></h4>
                                      <form action="giverating.php" method="POST" style="border: 1px solid #E9EBEC;padding: 30px;">
                                        <select class="form-select mb-3" aria-label="Default select example" name="rtng" id="rtng">
                                          <option value="0">Select Your Rating</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                        </select>
                                        <input type="hidden" id="shopid" name="shopid" value="<?php echo $shopID ?>">
                                        <div class="d-grid gap-2">
                                          <button type="submit" class="btn btn-primary">SUBMIT RATING</button>
                                        </div>
                                      </form>
                                    </div>
                                    <div class="col-lg-4"></div>
                                  <?php
                                }
                                else{
                                  ?>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4" style="border: 1px solid #E9EBEC;padding: 30px;">
                                    <i class="far fa-store-alt" style="color: #8DA3FD; font-size: 50px;padding-bottom: 20px;padding-top: 30px;"></i>
                                    <h5>SHOP NAME: &nbsp<strong><?php echo $getShop['shop_name'] ?></strong></h5>
                                      <?php
                                      $table = $alluser->fetchAll();
                                        $your_rate = $table[0];
                                      ?>
                                      <h5 style="font-weight: 700;">Your Rating : <?php echo $your_rate['rating_point'] ?> out of 5</h4>
                                      <form action="updaterating.php" method="POST" style="border: 1px solid #E9EBEC;padding: 30px;">
                                        <select class="form-select mb-3" aria-label="Default select example" name="rate" id="rate">
                                          <option value="0">Select Your Rating</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                        </select>
                                        <input type="hidden" id="shopid" name="shopid" value="<?php echo $shopID ?>">
                                        <div class="d-grid gap-2">
                                          <button type="submit" class="btn btn-primary">UPDATE YOUR RATING</button>
                                        </div>
                                      </form>
                                    </div>
                                    <div class="col-lg-4"></div>
                                  <?php
                                }
                              ?>
                        </div>

                    </div>

                    <script>
                        
                        var elm=document.getElementById('logoutbtn');
                        elm.addEventListener('click',processlogout);
                        
                        function processlogout(){
                            window.location.assign('logoutprocess.php');
                        }
                    
                    </script>

                    <!-- <script>
                        function viewShop(shopID){
                          window.location.assign("viewShop.php?id="+shopID);
                        }
                        function rateShop(shopID){
                          window.location.assign("rateShop.php?id="+shopID);
                        }
                    </script> -->

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script>
                        setTimeout(function(){
                            $('.loader_bg').fadeToggle();
                        }, 1000);
                    </script>


                    <!-- Option 1: Bootstrap Bundle with Popper -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
                    
                </body>

                </html>
                    
            <?php
              }
              catch(PDOException $ex){
                  ?>
                  <script>
                  window.location.assign('customerHome.php');
                  </script>
                  <?php
              }
            }
            catch(PDOException $ex){
                ?>
                <script>
                window.location.assign('customerHome.php');
                </script>
                <?php
            }
          }
          else{
            ?>
            <script>
                window.location.assign('customerHome.php');
            </script>
            <?php
          }

        }

        else{
            ?>
            <script>
                window.location.assign('customerLogin.php');
            </script>
            <?php
        }


    ?>