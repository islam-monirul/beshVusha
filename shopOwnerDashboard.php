<?php

  session_start();
  if(isset($_SESSION['useremail']) && isset($_SESSION['ownerID']) && !empty($_SESSION['useremail']) && !empty($_SESSION['ownerID']) && $_SESSION['userType']==1){
    ?>       
       
       <!doctype html>
        <html lang="en">
          <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
            
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">

            <!-- font-awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" />

            <link rel="stylesheet" href="sources/css/dashboards.css" type="text/css">

            <title>Shop Owner Dashboard</title>
          </head>
          <body class="bg-right">
            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-md-10 col-11 mx-auto">
                    <nav aria-label="breadcrumb" class="mb-3">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Shop Owner</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                      </ol>
                    </nav>

                    <div class="row">
                      <!-- right side navbar -->
                      <div class="col-lg-3 col-md-4 d-md-block">
                          <div class="card bg-common card-left">
                              <div class="card-body">
                                <nav class="nav d-md-block d-none">
                                  <a data-toggle='tab' class="nav-link active" aria-current="page" href="#dashboard">
                                    <i class="fas fa-columns mr-1"></i> Dashboard</a>

                                  <a data-toggle='tab' class="nav-link" href="#shopList">
                                    <i class="fas fa-store-alt mr-1"></i> Shop List</a>

                                  <a data-toggle='tab' class="nav-link" href="#productList">
                                    <i class="fas fa-list-alt mr-1"></i> Products</a>

                                  <a data-toggle='tab' class="nav-link" href="#addShop">
                                    <i class="fas fa-store-alt mr-1"></i> Add New Shop</a>

                                  <a data-toggle='tab' class="nav-link" href="#addProduct">
                                    <i class="fas fa-list-alt mr-1"></i> Add New Product</a>
                                  
                                  <a data-toggle='tab' class="nav-link" href="#complaints">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Complaints</a>
                                    
                                  <a data-toggle='tab' class="nav-link" id="logOut" href="#logout">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout</a>

                                </nav>
                              </div>
                          </div>
                      </div>

                      <!-- right side div starts -->
                      <div class="col-lg-9 col-md-8">
                          <div class="card">
                              <div class="card-header border-bottom mb-3 d-md-none">
                                <ul class="nav nav-tabs card-header-tabs nav-fill">
                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link active" aria-current="page" href="#dashboard">
                                      <i class="fas fa-columns mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#shopList">
                                      <i class="fas fa-store-alt mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#productList">
                                      <i class="fas fa-list-alt mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#addShop">
                                      <i class="fas fa-store-alt mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#addProduct">
                                      <i class="fas fa-list-alt mr-1"></i></a>
                                  </li>
                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#complaints">
                                      <i class="fas fa-exclamation-triangle mr-1"></i></a>
                                  </li>
                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" id="logOut" href="#logout">
                                    <i class="fas fa-sign-out-alt mr-1"></i></a>
                                  </li>
                                </ul>
                              </div>
                              
                              <?php
                                try{
                                    //database connect
                                    $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
                                    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                              ?>

                              <!-- actual data which is live starts -->

                              <div class="card-body tab-content border-0">

                                  <!-- //dashboard data -->
                                  <div class="tab-pane active" id="dashboard">
                                      <h5 style="text-align: center;">
                                        Welcome <b style="color: #8EA4FD;"><?php echo $_SESSION['useremail'] ?></b>
                                      </h5>
                                  </div>

                                  <!-- //shop list data -->
                                  <div class="tab-pane " id="shopList">
                                    <h3 style="text-align: center;">My Shop List</h3>
                                    <table id="shopTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Shop Name</th>
                                                <th>Shop Number</th>
                                                <th>Shop Address</th>
                                                <th>Location</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $shopOwnerID = $_SESSION['ownerID'];
                                                $shopQuery="SELECT * FROM shop WHERE shop_owner_id='$shopOwnerID'";
                                                try{
                                                  $shopReturn=$dbcon->query($shopQuery);
                                                  $allShop=$shopReturn->fetchAll();

                                                  foreach($allShop as $shopData){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $shopData['shop_name'] ?></td>
                                                        <td><?php echo $shopData['shop_no'] ?></td>
                                                        <td><?php echo $shopData['detailed_address'] ?></td>
                                                        <td><?php echo $shopData['area'] ?></td>
                                                        <td style="text-align: center;">
                                                        <button class="btn btn-warning m-1" onclick="updateShop(<?php echo $shopData['id'] ?>)">Update</button>
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

                                  <!-- //shop owner data -->
                                  <div class="tab-pane " id="productList">
                                    <h3 style="text-align: center;">My Product List</h3>
                                    <table id="productTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Shop Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // $shopOwnerID = $_SESSION['ownerID'];
                                                $shop_cat_find = "SELECT products.name, shop.shop_name, category.category_name, products.price
                                                FROM products
                                                JOIN shop ON shop.id = products.shopid
                                                JOIN category ON products.categoryid = category.id
                                                WHERE shop.shop_owner_id LIKE '$shopOwnerID'";

                                                // $shopQuery="SELECT * FROM shop WHERE shop_owner_id='$shopOwnerID'";
                                                try{
                                                  $productReturn=$dbcon->query($shop_cat_find);
                                                  $allProduct=$productReturn->fetchAll();

                                                  foreach($allProduct as $pData){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $pData['name'] ?></td>
                                                        <td><?php echo $pData['shop_name'] ?></td>
                                                        <td><?php echo $pData['category_name'] ?></td>
                                                        <td>BDT <?php echo $pData['price'] ?></td>
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

                                  <!-- //Shop data -->
                                  <div class="tab-pane " id="addShop">
                                    <h3 style="text-align: center;">Add a new shop</h3>
                                    <div class="container" style="padding-top: 20px;padding-bottom: 50px;">
                                      <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6" style="border: 1px solid #E9EBEC;padding: 50px;">
                                          <!-- shop adding form starts -->
                                          <form action="addNewShop.php" method="POST">
                                            <!-- shop name -->
                                            <div class="mb-3">
                                              <label for="shopName" class="form-label">Shop Name</label>
                                              <input type="text" class="form-control" id="shopName" name="shopName" required>
                                            </div>
                                            <!-- shop number -->
                                            <div class="mb-3">
                                                <label for="shopNumber" class="form-label">Shop Number</label>
                                                <input type="text" class="form-control" id="shopNumber" name="shopNumber" required>
                                            </div>
                                            <!-- shop Area Select -->
                                            <div class="form-group mb-3">
                                              <label for="areaSelect">Area</label>
                                              <?php

                                                  $q="SELECT * FROM area";

                                                  try{
                                                    $returnvalue=$dbcon->query($q);
                                                    $data=$returnvalue->fetchAll();

                                                    ?>

                                                      <select class="form-control" id="areaSelect" name="areaSelect">

                                                          <?php
                                                            foreach($data as $row){
                                                          ?>    
                                                            <option value="<?php echo $row['location'] ?>"><?php echo $row['location'] ?></option>
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
                                            
                                            <!-- Detailed Address -->
                                            <div class="form-group">
                                              <label for="detailedAddress">Detailed Address</label>
                                              <textarea class="form-control" id="detailedAddress" name="detailedAddress" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm btn-block" style="padding-top: 10px;padding-bottom: 10px;font-size: 16px;">Add New Shop</button>
                                          </form>
                                          <!-- shop adding form ends -->
                                        </div>
                                     </div>
                                    </div>
                                    <div class="col-lg-3"></div>   
                                  </div>

                                  <!-- //products data -->
                                  <div class="tab-pane " id="addProduct">
                                    <h3 style="text-align: center;">Add a new product</h3>
                                    <div class="container" style="padding-top: 20px;padding-bottom: 50px;">
                                      <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6" style="border: 1px solid #E9EBEC;padding: 50px;">
                                          <!-- product adding form starts -->
                                          <form action="addNewProduct.php" method="POST" enctype="multipart/form-data">
                                            <!-- Product name -->
                                            <div class="mb-3">
                                              <label for="name" class="form-label">Product Name</label>
                                              <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                           
                                            <div class="row">
                                            <div class="col-lg-6 mb-3">
                                              <label for="shopSelect">Shop</label>
                                              <?php
                                                  $q="SELECT * FROM shop WHERE shop_owner_id='$shopOwnerID'";

                                                  try{
                                                    $returnvalue=$dbcon->query($q);
                                                    $data=$returnvalue->fetchAll();

                                                    ?>

                                                      <select class="form-control" id="shopSelect" name="shopSelect">

                                                          <?php
                                                            foreach($data as $row){
                                                          ?>    
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['shop_name'] ?></option>
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
                                            <div class="col-lg-6 mb-3">
                                              <label for="category">Category</label>
                                              <?php
                                                  $cq="SELECT * FROM category";

                                                  try{
                                                    $creturnvalue=$dbcon->query($cq);
                                                    $cdata=$creturnvalue->fetchAll();

                                                    ?>

                                                      <select class="form-control" id="category" name="category">

                                                          <?php
                                                            foreach($cdata as $row){
                                                          ?>    
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['category_name'] ?></option>
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
                                            </div>
                                            

                                             <!-- Price -->
                                             <div class="mb-3">
                                                <label for="prodPrice" class="form-label">Product Price</label>
                                                <input type="text" class="form-control" id="prodPrice" name="prodPrice" required>
                                            </div>

                                          
                                            <label>Upload Product Image</label>
                                            <input class="mb-3" type="file" name="image">
                                            
                                            
                                            <!-- Details -->
                                            <div class="form-group">
                                              <label for="details">Description</label>
                                              <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                                            </div>
                                            
                                            <div class="form-group mb3">
                                              <label>Select Sizes</label><br>
                                              <input type="checkbox" name="check_list[]" value="S"><label>&nbsp S</label><br/>
                                              <input type="checkbox" name="check_list[]" value="M"><label>&nbsp M</label><br/>
                                              <input type="checkbox" name="check_list[]" value="L"><label>&nbsp L</label><br/>
                                              <input type="checkbox" name="check_list[]" value="XL"><label>&nbsp XL</label><br/>
                                              <input type="checkbox" name="check_list[]" value="KID"><label>&nbsp KID</label>
                                            </div>

                                            <div class="form-group mb-3">
                                              <label for="replaceD">Replacement Days</label>
                                              <select class="form-control" id="replaceD" name="replaceD">
                                                <option value="1">1 day</option>
                                                <option value="2">2 days</option>
                                              </select>
                                            </div>

                                            <input type="submit" class="btn btn-primary btn-sm btn-block" style="padding-top: 10px;padding-bottom: 10px;font-size: 16px;" value="Add New Product" name="submit">
                                          </form>
                                          <!-- shop adding form ends -->
                                        </div>
                                     </div>
                                    </div>
                                    <div class="col-lg-3"></div>   
                                  </div>

                                  <!-- //complaints data -->
                                  <div class="tab-pane " id="complaints">
                                    <h3 style="text-align: center;">Are you facing any problem?</h3>
                                    <form action="addcomplaintShopOwner.php" method="POST" style="border: 1px solid #E9EBEC;padding: 50px;">

                                        <div class="form-floating mb-3">
                                        <label for="floatingInput">Subject</label>
                                          <input type="text" class="form-control" name="subject" id="floatingInput">
                                        </div>
                                        
                                        <div class="form-floating">
                                          <label for="floatingTextarea2">Leave your comment here</label>
                                          <textarea class="form-control" name="details" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        </div>
                                        
                                        <div class="mt-4" style="text-align:left;">
                                        <button type="submit" class="btn btn-primary" style="padding: 10px 82px;">Submit Complaint</button>
                                        </div>
                                    </form>
                                  </div>
                                  
                                  <!-- //logout data -->
                                  <div class="tab-pane " id="logout" style="padding-top: 50px;padding-bottom: 50px;">
                                    <h6 style="text-align:center;">Are you sure you want to log out?</h6>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-success mr-2" onclick="proceedLogout()">Yes</button>
                                        <button type="button" class="btn btn-danger" onclick="cancelLogout()">No</button>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php
                        }
                        catch(PDOException $ex){
                            ?>
                            <script>window.location.assign('shopOwnerLogin.php');</script>
                            <?php
                        }
                      ?>
                    </div>
                </div>
              </div>
            </div>
            
            <script>
                function proceedLogout(){
                    window.location.assign('logoutprocess.php');
                }
                
                function cancelLogout(){
                    window.location.assign('shopOwnerDashboard.php');
                }   
            </script>

            <script>
                function delShop(shopID){
                  window.location.assign("deleteShop.php?shop="+shopID);
                }

                function updateShop(shopID){
                  window.location.assign("updateShopInfo.php?shop="+shopID);
                }
            </script>
            
            
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
            
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <!--
            <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
        -->
            <script>
                $(document).ready(function() {
                    var table = $('#shopTable').DataTable({
                    lengthChange: false,
                    });
                } );
            </script>

            <script>
                $(document).ready(function() {
                    var table = $('#productTable').DataTable({
                    lengthChange: false,
                    });
                } );
            </script>

          </body>
        </html>


    <?php
  }

  else{
    ?>
      <script>
          window.location.assign('shopOwnerLogin.php');
      </script>
    <?php
  }

?>