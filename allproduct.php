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
                <title>Products | beshVusha</title>

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
                              <a class="nav-link active" href="allProduct.php">Products</a>
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


                <section style="padding: 100px 0 100px 0;">

                <div class="container mb-3" style="padding: 30px; border: 1px solid #E9EBEC;">
                    <form action="productSearchResult.php" method="POST">
                        <div class="row">
                          <div class="col-lg-2">
                              <input type="text" class="form-control" id="minPrice" placeholder="Min Price" name="minPrice" required>
                          </div>
                          <div class="col-lg-2">
                              <input type="text" class="form-control" id="maxPrice" placeholder="Max Price" name="maxPrice" required>
                          </div>
                          <div class="col-lg-3">
                            <?php

                              $q="SELECT * FROM category";

                              try{
                                $returnvalue=$dbcon->query($q);
                                $data=$returnvalue->fetchAll();

                                ?>

                              <select class="form-control" id="catSelect" name="catSelect">

                              <?php
                                        foreach($data as $row){
                                      ?>
                              <option value="<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></option>
                              <?php
                                        }
                                    
                                      ?>

                              </select>

                              <?php
                              }
                              catch(PDOException $ex){
                                ?>
                              <script>
                              window.location.assign('index.php')
                              </script>
                              <?php
                              }

                            ?>
                          </div>
                          <div class="col-lg-3">
                            <select class="form-control" id="sizeSelect" name="sizeSelect">
                              <option value="S">S size</option>
                              <option value="M">M size</option>
                              <option value="L">L size</option>
                              <option value="XL">XL size</option>
                            </select>
                          </div>
                          <div class="col-lg-2">
                              <button type="submit" class="btn btn-primary" style="font-size: 16px;padding: 5px 45px;">Filter Product</button>
                          </div>
                        </div>
                    </form>
                  </div>

                  <div class="container" style="padding-top: 40px;padding-bottom: 60px; text-align: center;border: 1px solid #E9EBEC;">

                      <h2 style="padding: 40px;color: red;"><span style="color: green;">ALL</span> PRODUCTS</h2>

                      <div class="row d-flex justify-content-center">
                      <?php
                        $prodFetch="SELECT * from products";
                        try{
                          $allprodData=$dbcon->query($prodFetch);
                          $prodResult=$allprodData->fetchAll();

                              foreach($prodResult as $data){
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 m-1" style="border: 2px solid #E9EBEC; background-color: #fff;">
                                    <img src="sources/products/<?php echo $data['product_image'] ?>"  class="mb-3 mt-2" alt="img-$" height="220px" width="200px">

                                    <h4 style="color: grey;font-size: 20px;">
                                    BDT <span style="color: red;font-weight: 500;"><?php echo $data['price'] ?></span>
                                    </h4>

                                    <div class="d-grid gap-2 d-md-block mb-5">
                                      <button class="btn btn-outline-dark" type="button" onclick="addToWishlist(<?php echo $data['id'] ?>)">Add to wishlist</button>
                                      <button class="btn btn-outline-primary" type="button" onclick="details(<?php echo $data['id'] ?>)">Shop</button>
                                    </div>
                                </div>

                                <?php
                              }
                            ?>
                      </div>

                  </div>

                </section>

                <footer>
                  <div class="container">
                    <div class="row">
                      <div class="col-sm-12">
                        <p>Copyright ?? 2021 | All Rights Reserved by BeshVusha</p>
                      </div>
                    </div>
                  </div>
                </footer>

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
                      window.location.assign("wishListAdd.php?id="+prodID);
                    }
                </script>

                <script>
                  function forwardToProductpage(){
                    window.location.assign("allproduct.php");
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