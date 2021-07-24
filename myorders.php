<?php
    session_start();
    if(isset($_SESSION['useremail']) && !empty($_SESSION['useremail']) && $_SESSION['userType']==0 && isset($_SESSION['ownerID'])){
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
                <title>My orders | beshVusha</title>

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
                              <a class="nav-link active" href="myorders.php">My Orders</a>
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
              
                <div class="container" style="padding-top: 40px; text-align: center;">

                    <h2 style="padding: 40px;color: red;"><span style="color: green;">MY</span> ORDERS</h2>

                    <div class="row d-flex justify-content-center">
                    <?php

                      try{
                        $myorders= "SELECT a.id, a.prod_name, a.product_size, a.quantity, a.total_amt, a.req_sts, a.status, c.shop_name,b.replacement_days, DATEDIFF(CURRENT_DATE, a.order_time) AS 'replace_days' FROM all_orders AS a
                                            JOIN products AS b
                                            ON a.product_id = b.id
                                            JOIN shop AS c
                                            ON b.shopid = c.id
                                            WHERE a.cid = '$customer_id_forWishList'";

                          ?>

                          <table id="wishlistTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Product Name</th>
                                                <th>Product Size</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                                <th>Shop Name</th>
                                                <th>Replacement</th>
                                                <th>Order Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                
                                                try{
                                                  $resultReturn=$dbcon->query($myorders);
                                                  $allResult=$resultReturn->fetchAll();

                                                  foreach($allResult as $resultData){
                                                    ?>
                                                      <tr style="vertical-align: middle;">
                                                        <td><?php echo $resultData['id'] ?></td>
                                                        <td><?php echo $resultData['prod_name'] ?></td>
                                                        <td><?php echo $resultData['product_size'] ?></td>
                                                        <td><?php echo $resultData['quantity'] ?></td>
                                                        <td><?php echo $resultData['total_amt'] ?></td>
                                                        <td><?php echo $resultData['shop_name'] ?></td>
                                                        <td>
                                                            <?php
                                                                $original_replacement_days = $resultData['replacement_days'];
                                                                $order_replacement_days = $resultData['replace_days'];
                                                                $request_status = $resultData['req_sts'];
                                                                $ordSts = $resultData['status'];
                                                                
                                                                if($order_replacement_days <= $original_replacement_days && $request_status == 0 && $ordSts == 1){
                                                                    ?>
                                                                        <button class="btn btn-danger" type="button" onclick="replaceReq(<?php echo $resultData['id'] ?>)">Request Replacement</button>
                                                                    <?php
                                                                }
                                                      
                                                                else{
                                                                    ?>
                                                                        <button class="btn btn-danger" type="button" disabled>Request Replacement</button>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $orderStatus = $resultData['status'];
                                                               
                                                                
                                                                if($orderStatus == 0){
                                                                    ?>
                                                                        <p>Pending</p>
                                                                    <?php    
                                                                }
                                                      
                                                                else{
                                                                    ?>
                                                                        <p>Completed</p>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('shopOwnerLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
                    </div>

                </div>

                <script>
                    
                    var elm=document.getElementById('logoutbtn');
                    elm.addEventListener('click',processlogout);
                    
                    function processlogout(){
                        window.location.assign('logoutprocess.php');
                    }
                
                </script>

                <script>
                  
                    function details(prodID){
                      window.location.assign("productDetails.php?id="+prodID);
                    }
                    
                </script>

                <script>
                    function addToWishlist(prodID){
                      window.location.assign("wishList.php?id="+prodID);
                    }
                </script>

                <script>
                    function deleteWishlist(prodID){
                      window.location.assign("deleteFromWishList.php?id="+prodID);
                    }
                </script>
                    
                <script>
                    function replaceReq(orderID){
                      window.location.assign("replacement_request.php?id="+orderID);
                    }
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
            window.location.assign('customerLogin.php');
        </script>
        <?php
    }


?>