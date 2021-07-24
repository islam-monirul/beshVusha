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
                
              $customer_id_forWishList = $_SESSION['ownerID'];
              $wishQ="SELECT COUNT(*) AS 'cnt' FROM wishlist WHERE customer_id='$customer_id_forWishList'";
              $wishC=$dbcon->query($wishQ);
              $wishCount = $wishC->fetchAll();
              $wishRow = $wishCount[0];

              $cartQ="SELECT COUNT(*) AS 'cnt' FROM cart WHERE userID='$customer_id_forWishList'";
              $cartC=$dbcon->query($cartQ);
              $cartCount = $cartC->fetchAll();
              $cartRow = $cartCount[0];

              $shopNamequery = "SELECT * FROM shop WHERE id='$shopID'";
              $temp = $dbcon->query($shopNamequery);

              $nameTable = $temp->fetchAll();
              $getShop = $nameTable[0];

              $userq="SELECT * FROM review WHERE shopid=$shopID AND userid='$userID'";
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

                      #content{
                        width: 100%;
                      }

                      #content tr td{
                        border: 1px solid #E9EBEC;
                        /* text-align: center; */
                        padding: 20px;
                      }
                  

                    
                
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
                                <a href="wishlist.php" class="btn btn-outline-light m-2"><i class="fas fa-heart"></i> &nbsp 
                                  <?php echo $wishRow['cnt'] ?>
                                </a>
                                <a href="cart.php" class="btn btn-outline-light m-2"><i class="fas fa-shopping-cart"></i> &nbsp 
                                  <?php echo $cartRow['cnt'] ?>
                                </a>
                                <button type="button" class="btn-danger" id="logoutbtn" style="padding: 2px 35px;">Logout</button>
                              </div>
                              
                            </div>
                        
                      </div>
                    </nav>

                    <div class="loader_bg">
                      <div class="loader"></div>
                    </div>

                  <section style="padding-bottom: 100px;">
                    <div class="container" style="padding-top: 40px;margin-bottom: 30px; text-align: center;">

                        <div class="row">
                              <?php
                                if($alluser->rowCount()==0){
                                  ?>
                                    <div class="col">
                                      <h4>SHOP NAME: &nbsp<strong><?php echo $getShop['shop_name'] ?></strong></h4>
                                      
                                      <div style="border: 1px solid #E9EBEC;padding: 30px;">
                                         <h5 style="text-align:left;color:#8DA3FD">Location: &nbsp<strong><?php echo $getShop['detailed_address'] ?>,</strong> &nbsp<strong><?php echo $getShop['area'] ?></strong></h5>
                                         
                                         <div style="padding:15px;border: 1px solid #E9EBEC;margin-top: 25px; margin-bottom:25px; text-align:left;">
                                            <h5 style="color: #8DA3FD;"><strong>PRODUCTS</strong></h5>
                                            <div class="row d-flex justify-content-around">
                                             <?php
                                                  $prodFetch="SELECT * from products WHERE shopid=$shopID";
                                    
                                                    $allprodData=$dbcon->query($prodFetch);
                                                    $prodResult=$allprodData->fetchAll();

                                                        foreach($prodResult as $data){
                                                          ?>
                                                          <div class="col-lg-3 m-1" style="text-align:center;border: 2px solid #E9EBEC; background-color: #fff;">
                                                              <img src="sources/products/<?php echo $data['product_image'] ?>"  class="mb-3 mt-2" alt="img-$" height="220px" width="200px">

                                                              <h4 style="color: grey;font-size: 20px;">
                                                              BDT <span style="color: red;font-weight: 500;"><?php echo $data['price'] ?></span>
                                                              </h4>

                                                              <div class="d-grid gap-2 d-block mb-3">
                                                                <button class="btn btn-outline-primary" type="button" onclick="details(<?php echo $data['id'] ?>)">Shop</button>
                                                              </div>
                                                          </div>

                                                          <?php
                                                        }
                                                      ?>
                                          </div>
                                         </div>
                                         
                                          <div style="padding:15px;border: 1px solid #E9EBEC;margin-top: 25px; margin-bottom:25px; text-align:left;">
                                            <h5 style="color:#8DA3FD;"><strong>MY REVIEW</strong></h5>
                                            <form action="addReview.php" method="POST" style="border: 1px solid #E9EBEC;padding: 25px;">
                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- <label for="customer" class="form-label">Customer ID</label> -->
                                                        <input type="text" class="form-control" id="customer" name="customer" value="<?php echo $userID ?>" hidden required readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- <label for="shop" class="form-label">Shop ID</label> -->
                                                        <input type="text" class="form-control" id="shop" name="shop" value="<?php echo $shopID ?>" hidden required readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                  <textarea class="form-control" name="details" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                  <label for="floatingTextarea2">Write your review here</label>
                                                </div>

                                                <div class="mt-4" style="text-align:left;">
                                                <button type="submit" class="btn btn-success" style="padding: 10px 82px;">Submit Your Review</button>
                                                </div>
                                            </form>
                                          </div>

                                          <div style="text-align: left;margin-left: 5px;padding-top: 20px;">
                                            <h5 style="color:#8DA3FD;"><strong>CHECK ALL REVIEWS OF THIS SHOP</strong></h5>
                                            <button id="ajaxBtn" class="btn btn-outline-dark">Show All Reviews</button>
                                            <!-- <div id="content"></div> -->
                                            <table id="content"></table>
                                          </div>
                                      </div>
                                    </div>
                                  <?php
                                }
                                else{
                                  ?>
                                    <div class="col">
                                      <h4>SHOP NAME: &nbsp<strong><?php echo $getShop['shop_name'] ?></strong></h4>

                                      <div style="border: 1px solid #E9EBEC;padding: 30px;">
                                         
                                         <h5 style="text-align:left;color:#8DA3FD">Location: &nbsp<strong><?php echo $getShop['detailed_address'] ?>,</strong> &nbsp<strong><?php echo $getShop['area'] ?></strong></h5>

                                         <div style="padding:15px;border: 1px solid #E9EBEC;margin-top: 25px; margin-bottom:25px; text-align:left;">
                                            <h5 style="color:#8DA3FD;"><strong>PRODUCTS</strong></h5>
                                            <div class="row d-flex justify-content-around">
                                             <?php
                                                  $prodFetch="SELECT * from products WHERE shopid=$shopID";
                                    
                                                    $allprodData=$dbcon->query($prodFetch);
                                                    $prodResult=$allprodData->fetchAll();

                                                        foreach($prodResult as $data){
                                                          ?>
                                                          <div class="col-lg-3 m-1" style="text-align:center;border: 2px solid #E9EBEC; background-color: #fff;">
                                                              <img src="sources/products/<?php echo $data['product_image'] ?>"  class="mb-3 mt-2" alt="img-$" height="220px" width="200px">

                                                              <h4 style="color: grey;font-size: 20px;">
                                                              BDT <span style="color: red;font-weight: 500;"><?php echo $data['price'] ?></span>
                                                              </h4>

                                                              <div class="d-grid gap-2 d-block mb-3">
                                                                <button class="btn btn-outline-primary" type="button" onclick="details(<?php echo $data['id'] ?>)">Shop</button>
                                                              </div>
                                                          </div>

                                                          <?php
                                                        }
                                                      ?>
                                          </div>
                                         </div>
                                         
                                          <?php
                                            $myreviewQ="SELECT * FROM review WHERE userid='$userID'";
                                            $myreview = $dbcon->query($myreviewQ);

                                            $myrev = $myreview->fetchAll();
                                            $myrv = $myrev[0];
                                          ?>
                                          <div style="padding:15px;border: 1px solid #E9EBEC;margin-top: 25px; margin-bottom:25px; text-align:left;">
                                            <h5 style="color:#8DA3FD;"><strong>MY REVIEW</strong></h5>
                                            <p>
                                                <?php echo $myrv['details'] ?>
                                            </p>
                                            
                                            <button class="btn btn-danger" type="button" onclick="delReview(<?php echo $myrv['id'] ?>)">Delete Review</button>
                                          </div>
                                        
                                          <div style="text-align: left;margin-left: 5px;padding-top: 20px;">
                                            <h5 style="color:#8DA3FD;"><strong>CHECK ALL REVIEWS OF THIS SHOP</strong></h5>
                                            <button id="ajaxBtn" class="btn btn-outline-dark">Show All Reviews</button>
                                            <!-- <div id="content"></div> -->
                                            <table id="content"></table>
                                          </div>
                                      </div>
                                    </div>
                                  <?php
                                }
                              ?>

                        

                        </div>

                                
                        </div>
                    
                    </div>

                  </section>

                    <script>
                        
                        var elm=document.getElementById('logoutbtn');
                        elm.addEventListener('click',processlogout);
                        
                        function processlogout(){
                            window.location.assign('logoutprocess.php');
                        }
                    
                    </script>
                    
                    <script>
                         function delReview(revID){
                            window.location.assign("deleteReview.php?id="+revID);
                         }       
                    </script>
                    
                    <script>
                  
                        function details(prodID){
                          window.location.assign("productDetails.php?id="+prodID);
                        }

                    </script>

                    <script type="text/javascript">
                        var btn = document.getElementById('ajaxBtn');
                        btn.addEventListener('click', loadFromServer);
                        
                        function loadFromServer() {
                          var xmlhttp = new XMLHttpRequest();
                          xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                              var myObj = JSON.parse(this.responseText);
                              document.getElementById("content").style.color = "black";
                              document.getElementById("content").innerHTML = "";
                              if (myObj.status === "OK")
                              {
                                for (let i = 0; i < myObj.content.length; i++)
                                  document.getElementById("content").innerHTML += "<tr>" + "<td>" + "<strong>" + myObj.content[i].name + "</strong>" + "</td>" + "<td>" + myObj.content[i].details + "</td>" + "</tr>";

                                            document.getElementById("content").style.padding = "30px";
                                            document.getElementById("content").style.border = "1px solid #E9EBEC";
                                            document.getElementById("content").style.marginTop = "30px";
                                            // document.getElementById("content").style.color = "green";
                              }
                              else {
                                document.getElementById("content").innerHTML = "An error has occured <br>" + myObj.content;
                                document.getElementById("content").style.color = "red";
                              }
                              // console.log(myObj);
                            }
                          };
                          xmlhttp.open("GET", "ajax_backend.php", true);
                          xmlhttp.send();
                        }

                        document.querySelector('button').addEventListener('click', loadFromServer);
                        
                      </script>

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