<?php

  session_start();
  if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['userType']==2){
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

            <title>Admin Panel</title>
          </head>
          <body class="bg-right">

            <div class="container-fluid mt-5">
              <div class="row">
                <div class="col-md-10 col-11 mx-auto">
                    <nav aria-label="breadcrumb" class="mb-3">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="admin_dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Panel</li>
                      </ol>
        <!--              <button type="button" class="btn btn-danger mr-auto">Logout</button>-->
                    </nav>

                    <div class="row">
                      <!-- right side navbar -->
                      <div class="col-lg-3 col-md-4 d-md-block">
                          <div class="card bg-common card-left">
                              <div class="card-body">
                                <nav class="nav d-md-block d-none">
                                  <a data-toggle='tab' class="nav-link active" aria-current="page" href="#dashboard">
                                    <i class="fas fa-columns mr-1"></i> Dashboard</a>

                                  <a data-toggle='tab' class="nav-link" href="#userList">
                                    <i class="fas fa-users mr-1"></i> User List</a>

                                  <a data-toggle='tab' class="nav-link" href="#pending">
                                    <i class="fas fa-user-clock mr-1"></i> Pending Users</a>

                                  <a data-toggle='tab' class="nav-link" href="#products">
                                    <i class="far fa-list-alt mr-1"></i> Products</a>

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
                                    <a data-toggle='tab' class="nav-link" href="#userList">
                                      <i class="fas fa-users mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#pending">
                                      <i class="fas fa-user-clock mr-1"></i></a>
                                  </li>

                                  <li class="nav-item">
                                    <a data-toggle='tab' class="nav-link" href="#products">
                                      <i class="far fa-list-alt mr-1"></i></a>
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
                                      <h3 style="text-align: center;">Welcome to Admin Panel Dashboard</h3>
                                  </div>

                                  <!-- //customer list data -->
                                  <div class="tab-pane " id="userList" style="text-align: center;">
                                    <h3>User's List</h3>
                                    <table id="customerTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>User Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $userQuery="SELECT * FROM user WHERE status=1";
                                                try{
                                                  $userReturn=$dbcon->query($userQuery);
                                                  $allUsers=$userReturn->fetchAll();

                                                  foreach($allUsers as $userData){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $userData['id'] ?></td>
                                                        <td><?php echo $userData['name'] ?></td>
                                                        <td><?php echo $userData['email'] ?></td>
                                                        <td><?php echo $userData['contact_number'] ?></td>
                                                        <?php
                                                          $state=$userData['type'];
                                                          if($state==0){
                                                        ?>
                                                              <td>Customer</td>
                                                        <?php   
                                                          }
                                                          else{
                                                        ?>
                                                              <td>Shop Owner</td>
                                                        <?php
                                                          }
                                                      ?>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('adminLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
                                  </div>

                                  <!-- //pending users data -->
                                  <div class="tab-pane " id="pending">
                                    <h3 style="text-align: center;">Pending Shop Owners</h3>
                                    <table id="pendingVerifyTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $newquery="SELECT * FROM user WHERE status=0";
                                                try{
                                                  $newValue=$dbcon->query($newquery);
                                                  $pending_user=$newValue->fetchAll();

                                                  foreach($pending_user as $pending_data){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $pending_data['id'] ?></td>
                                                        <td><?php echo $pending_data['name'] ?></td>
                                                        <td><?php echo $pending_data['email'] ?></td>
                                                        <td><?php echo $pending_data['contact_number'] ?></td>
                                                        <td style="text-align: center;">
                                                        <button class="btn btn-success m-1" onclick="addUser('<?php echo $pending_data['id'] ?>')">Accept</button>
                                                        <button class="btn btn-danger m-1" onclick="delUser('<?php echo $pending_data['id'] ?>')">Reject</button>
                                                      </td>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('adminLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
                                      <h3 style="text-align: center;padding-top: 50px;">Data for verification</h3>
                                      <table id="pendingVerificationData" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>NID no</th>
                                                <th>Bank</th>
                                                <th>Bank Account no</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query="SELECT * FROM shop_owner";
                                                try{
                                                  $valReturn=$dbcon->query($query);
                                                  $userS=$valReturn->fetchAll();

                                                  foreach($userS as $udata){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $udata['userid'] ?></td>
                                                        <td><?php echo $udata['nid_no'] ?></td>
                                                        <td><?php echo $udata['bank_name'] ?></td>
                                                        <td><?php echo $udata['bank_acc'] ?></td>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('adminLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
                                  </div>

                                  <!-- //products data -->
                                  <div class="tab-pane " id="products">
                                    <h3 style="text-align: center;">Product List</h3>
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
                                                  JOIN category ON products.categoryid = category.id";

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

                                  <!-- //complaints data -->
                                  <div class="tab-pane " id="complaints">
                                    <h3 style="text-align: center;">Pending Complaints</h3>
                                    <table id="complaintTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Details</th>
                                                <th>Submitted By</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $comQuery="SELECT * FROM complaint_box WHERE status=0";
                                                try{
                                                  $comReturn=$dbcon->query($comQuery);
                                                  $allCom=$comReturn->fetchAll();

                                                  foreach($allCom as $comData){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $comData['subject'] ?></td>
                                                        <td><?php echo $comData['details'] ?></td>
                                                        <td><?php echo $comData['userid'] ?></td>
                                                      <td style="text-align: center;">
                                                        <button class="btn btn-success m-1" onclick="resolveComplaint(<?php echo $comData['id'] ?>)">Resolve</button>
                                                      </td>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('adminLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
                                      <h3 style="text-align: center;padding-top: 50px;">Resolved Complaints</h3>
                                      <table id="complaintTableTwo" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Details</th>
                                                <th>Submitted By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $comQuery="SELECT * FROM complaint_box WHERE status=1";
                                                try{
                                                  $comReturn=$dbcon->query($comQuery);
                                                  $allCom=$comReturn->fetchAll();

                                                  foreach($allCom as $comData){
                                                    ?>
                                                      <tr>
                                                        <td><?php echo $comData['subject'] ?></td>
                                                        <td><?php echo $comData['details'] ?></td>
                                                        <td><?php echo $comData['userid'] ?></td>
                                                      </tr>
                                                    <?php
                                                  }
                                                }
                                                catch(PDOException $ex){
                                                  ?>
                                                  <script>window.location.assign('adminLogin.php');</script>
                                                  <?php
                                                }
                                            ?>  
                                        </tbody>
                                      </table>
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
                            <script>window.location.assign('adminLogin.php');</script>
                            <?php
                        }
                      ?>
                    </div>
                </div>
              </div>
            </div>
            
            <script>
                function proceedLogout(){
                    window.location.assign('logoutAdmin.php');
                }
                
                function cancelLogout(){
                    window.location.assign('admin_dashboard.php');
                }   
            </script>

            <script>
                function addUser(userID){
                  window.location.assign("acceptPending.php?acc_row="+userID);
                }
            </script>
            <script>
                function delUser(userID){
                  window.location.assign("deletePending.php?acc_row="+userID);
                }
            </script>
            <script>
                function resolveComplaint(complaintID){
                  window.location.assign("resolveComplaints.php?com_row="+complaintID);
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
                    var table1 = $('#customerTable').DataTable({
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

            <script>
                $(document).ready(function() {
                    var table2 = $('#pendingVerifyTable').DataTable({
                    lengthChange: false,
                    });
                } );
            </script>

            <script>
                $(document).ready(function() {
                    var table3 = $('#pendingVerificationData').DataTable({
                    lengthChange: false,
                    });
                } );
            </script>

            <script>
                $(document).ready(function() {
                    var table4 = $('#complaintTable').DataTable({
                    lengthChange: false,
                    });
                } );
            </script>

            <script>
                $(document).ready(function() {
                    var table5 = $('#complaintTableTwo').DataTable({
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
          window.location.assign('adminLogin.php')
      </script>
    <?php
  }

?>