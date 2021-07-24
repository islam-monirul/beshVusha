<?php

  session_start();
  if($_SESSION['userType']=1){
    if(isset($_GET['shop']) && !empty($_GET['shop'])){
                
      $shopID=$_GET['shop'];
      try{
           //database connect
           $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
           $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           $shopDataSelect="SELECT * FROM shop WHERE id='$shopID'";
           $returnData=$dbcon->query($shopDataSelect);
           if($returnData->rowCount()==1){
            $table = $returnData->fetchAll();
            $shopInfo = $table[0];
           }
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
          
          <link rel="stylesheet" href="sources/css/style.css" type="text/css">
          <title>Shop Data update</title>
          
      </head>

      <body>


          <div class="container" style="padding-top: 40px;">

              <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6 mt-3" style="border: 1px solid #E9EBEC;padding: 50px;">
                    
                  <form action="updateShop.php" method="POST">
                                <!-- shop name -->
                                <div class="mb-3">
                                  <label for="shopName" class="form-label">Shop Name</label>
                                  <input type="text" class="form-control" id="shopName" name="shopName" value="<?php echo $shopInfo['shop_name'] ?>" required>
                                </div>
                                <!-- shop id -->
                                <input type="hidden" class="form-control" name="shopID" value="<?php echo $shopID ?>">
                                <!-- shop number -->
                                <div class="mb-3">
                                  <label for="shopNumber" class="form-label">Shop Number</label>
                                  <input type="text" class="form-control" id="shopNumber" name="shopNumber" value="<?php echo $shopInfo['shop_no'] ?>" required>
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
                        <div class="form-group mb-3">
                            <label for="detailedAddress">Detailed Address</label>
                            <input type="text" class="form-control" id="detailedAddress" name="detailedAddress" value="<?php echo $shopInfo['detailed_address'] ?>" required>
                        </div>

                        <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-success">Update Shop Info</button>
                        </div>
                    </form>

                    <a href="shopOwnerDashboard.php" id="login_anchor" style="padding-top: 20px;"><i class="fas fa-arrow-circle-left"></i> Back to Dashboard</a>

                  </div>
                  <div class="col-lg-3"></div>

              </div>

          </div>


          <!-- Option 1: Bootstrap Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
      </body>

      </html>
<?php
      }
      catch(PDOException $ex){
          ?>
          <script>window.location.assign('shopOwnerLogin.php');</script>
          <?php
      }
    }
    else{
      ?>
      <script>window.location.assign('shopOwnerLogin.php');</script>
      <?php
    }
  }
  else{
    ?>
    <script>window.location.assign('shopOwnerLogin.php');</script>
    <?php
  }
?>