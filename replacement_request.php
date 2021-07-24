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
            
          $order_id = $_GET['id'];
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
                <title>Replacement Request | BeshVusha</title>

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

              

              <section></section>
                <div class="container" style="padding-top: 40px;">
                    <h2 style="padding: 40px;color: red; text-align: center;"><span style="color: green;">REQUEST</span> REPLACEMENT</h2>
                </div>
                
                      <div class="container" style="padding-top: 20px;padding-bottom: 50px;">
                                      <div class="row">
                                        <div class="col-lg-3"></div>
                                        
                                        <div class="col-lg-6" style="border: 1px solid #E9EBEC;padding: 50px;">
                                          <?php 
                                            if(isset($_POST['submit_button']))
                                            $clicked = 'You have clicked the button';

                                          ?>
                                          <!-- replacement request form -->
                                          <form action="requestReplacement.php" method="POST">
                                           
                                            <!-- order ID -->
                                            <div class="mb-3">
                                              <label for="ordID" class="form-label">Order ID</label>
                                              <input type="text" class="form-control" id="ordID" name="ordID" value="<?php echo $order_id ?>" required readonly>

                                            </div>
                                            
                                            <!-- previous size -->
                                            <div class="mb-3">
                                              <?php
                                                    $sqlquery="SELECT product_size FROM all_orders WHERE id=$order_id";
        
                                                    try{
                                                        $returnvalue=$dbcon->query($sqlquery);
                                                        if($returnvalue->rowCount()==1){
                                                         
                                                            $table = $returnvalue->fetchAll();
                                                            $row = $table[0];
                                                            
                                                            $prev_size = $row['product_size'];
                                                        }

                                                        else{
                                                            ?>
                                                            <script>window.location.assign('customerHome.php')</script>
                                                            <?php
                                                        }
                                                    }
                                                    catch(PDOException $ex){
                                                        ?>
                                                        <script>window.location.assign('customerLogin.php')</script>
                                                        <?php
                                                    }
                                              ?>
                                              <label for="prevsize" class="form-label">Previous Size</label>
                                              <input type="text" class="form-control" id="prevsize" name="prevsize" value="<?php echo $prev_size ?>" required readonly>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                              <label class="mb-2">Desired Size</label>
                                              <?php
                                                  
                                                $product_id_finder = "SELECT product_id FROM all_orders WHERE id=$order_id";
                                                $returnvalue=$dbcon->query($product_id_finder);
                                                    if($returnvalue->rowCount()==1){
                                                         
                                                        $table = $returnvalue->fetchAll();
                                                        $row = $table[0];
                                                            
                                                        $order_prod_id = $row['product_id'];
                                                    }

                                                    else{
                                                        ?>
                                                        <script>window.location.assign('customerHome.php')</script>
                                                        <?php
                                                    }
            
            
                                                $sizeQ = "SELECT * FROM size WHERE productsid=$order_prod_id";

                                                try{
                                                    $returnvalue=$dbcon->query($sizeQ);
                                                    $data=$returnvalue->fetchAll();

                                                ?>

                                                <select class="form-control" id="sizeSelect" name="sizeSelect">

                                                <?php
                                                  foreach($data as $row){
                                                ?>    
                                                    <option value="<?php echo $row['size'] ?>"><?php echo $row['size'] ?></option>
                                                <?php
                                                  }

                                                ?>                                   

                                                </select>

                                                <?php
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('index.php')</script>
                                                  <?php
                                                }

                                             ?>
                                            </div>
                                            
                                            <!-- Reason -->
                                            <div class="form-group mb-3">
                                              <label for="reason">Reason of Replacement</label>
                                              <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                                            </div>

                                            <input type="submit" class="btn btn-primary" style="padding-top: 10px;padding-bottom: 10px;font-size: 16px;" value="Submit Request" name="submit">
                                          </form>
                                        </div>
                                     </div>
                                    </div>
                                    <div class="col-lg-3"></div>   

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

    else{
        ?>
        <script>
            window.location.assign('customerLogin.php');
        </script>
        <?php
    }


?>