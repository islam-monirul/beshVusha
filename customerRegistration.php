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

    
    <link rel="stylesheet" href="sources/css/style.css" type="text/css">
    <title>Customer Registration</title>
    
</head>

<body>

    <div class="container" style="padding-top: 40px;">

        <div class="row">
            <h3 style="text-align: center;font-weight: 700;">Customer Registration</h3>
            <div class="col-lg-3"></div>
            <div class="col-lg-6 mt-3" style="border: 1px solid #E9EBEC;padding: 50px;">

                  <form action="registerCustomer.php" method="POST">
                      <div class="mb-3">
                        <label for="customerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="customerName" name="nameCustomer" required>
                      </div>

                      <div class="mb-3">
                        <label for="customerEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="customerEmail" name="emailCustomer" aria-describedby="emailHelp" placeholder="example@mail.com" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                      </div>
                      
                      <div class="mb-3">
                        <label for="customerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="customerPassword" name="passwordCustomer" required>
                      </div>

                      <div class="row">
                        <div class="col-lg-6 mb-3">
                          <label for="customerHouse" class="form-label">House No.</label>
                          <input type="text" class="form-control" id="customerHouse" name="houseCustomer" required>
                        </div>

                        <div class="col-lg-6 mb-3">
                          <label for="customerRoad" class="form-label">Road No.</label>
                          <input type="text" class="form-control" id="customerRoad" name="roadCustomer" required>
                        </div>
                      </div>

                      <div class="row">
                        <!-- area select -->
                        <div class="col-lg-6 mb-3">
                          <label for="customerArea" class="form-label">Area</label>
                          <!-- <input type="text" class="form-control" id="customerArea" name="areaCustomer" placeholder="Location" required> -->
                          <?php

                            try{
                              $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
                              $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                              $q="SELECT * FROM area";

                              try{
                                $returnvalue=$dbcon->query($q);
                                $data=$returnvalue->fetchAll();

                                ?>

                                  <select class="form-select" aria-label="Default select example" name="areaCustomer">

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
                              
                            }
                            catch(PDOException $ex){
                                ?>
                                <script>window.location.assign('index.php')</script>
                                <?php
                            }

                          ?>

                        </div>

                        <div class="col-lg-6 mb-3">
          
                          <label for="customerCity" class="form-label">City</label>
                          <input type="text" class="form-control" id="customerCity" name="cityCustomer" placeholder="Dhaka" value="Dhaka" readonly="readonly">
                          
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="customerPhone" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="customerPhone" name="phoneCustomer" placeholder="Write Your Phone Number Here" required>
                      </div>

                      <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-success">Register</button>
                      </div>

                  </form>

                  <a href="index.php" id="reg_anchor"><i class="fas fa-arrow-circle-left"></i>  Return to Homepage</a>

            </div>
            <div class="col-lg-3"></div>

        </div>

    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>