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

          $shopFetch="SELECT * from shop";
          try{
            $allshopData=$dbcon->query($shopFetch);
            $shopResult=$allshopData->fetchAll();
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

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
    <title>My Profile | beshVusha</title>

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
                        <a class="nav-link active" href="myProfile.php">My profile</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <a href="wishlist.php" class="btn btn-outline-light m-2"><i class="fas fa-heart"></i> &nbsp
                        <?php echo $wishRow['cnt'] ?>
                    </a>
                    <a href="cart.php" class="btn btn-outline-light m-2"><i class="fas fa-shopping-cart"></i> &nbsp
                        <?php echo $cartRow['cnt'] ?>
                    </a>
                    <button type="button" class="btn-danger" id="logoutbtn" style="padding: 5px 35px;">Logout</button>
                </div>

            </div>

        </div>
    </nav>

    <div class="loader_bg">
        <div class="loader"></div>
    </div>

    <div class="container mb-5" style="padding-top: 40px;">

        <div class="mb-3" style="padding: 30px; border: 1px solid #E9EBEC;">

            <h5 style="color:Red;text-align: center;"><strong>MY PROFILE</strong></h5>
            <?php
                                            $customerDetails="SELECT * 
                                                                FROM customer AS c
                                                                JOIN user AS u
                                                                ON c.userid=u.id
                                                                WHERE c.userid='$customer_id_forWishList'";
              
                                            $det = $dbcon->query($customerDetails);

                                            $mydet = $det->fetchAll();
                                            $mydetails = $mydet[0];
                                          ?>
            <div class="row m-1 mt-3 mb-3">                              
                <div class="col-lg-12" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>Name : </span></strong> &nbsp; <?php echo $mydetails['name'] ?></h6>
                </div>
            </div>
            
            <div class="row m-1 mb-3">                              
                <div class="col-lg-6" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>Email : </span></strong> &nbsp; <?php echo $mydetails['email'] ?></h6>
                </div>

                <div class="col-lg-6" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>Phone : </span></strong> &nbsp; <?php echo $mydetails['contact_number'] ?></h6>
                </div>
            </div>
            
            <div class="row m-1 mb-3">                              
                <div class="col-lg-3" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>House : </span></strong> &nbsp; <?php echo $mydetails['house_no'] ?></h6>
                </div>

                <div class="col-lg-3" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>Road : </span></strong> &nbsp; <?php echo $mydetails['road_no'] ?></h6>
                </div>
                
                <div class="col-lg-3" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>Area : </span></strong> &nbsp; <?php echo $mydetails['area'] ?></h6>
                </div>
                
                <div class="col-lg-3" style="padding:10px;border: 1px solid #E9EBEC;text-align:left;">
                    <h6><strong><span>City : </span></strong> &nbsp; <?php echo $mydetails['city'] ?></h6>
                </div>
            </div>
            
            <button class="btn btn-warning" type="button" onclick="backToHome()">Back To Dashboard</button>

        </div>

    </div>

    <script>
        var elm = document.getElementById('logoutbtn');
        elm.addEventListener('click', processlogout);

        function processlogout() {
            window.location.assign('logoutprocess.php');
        }
    </script>

    <script>
        function viewShop(shopID) {
            window.location.assign("viewShop.php?id=" + shopID);
        }

        function rateShop(shopID) {
            window.location.assign("rateShop.php?id=" + shopID);
        }
    </script>

    <script>
        function backToHome(){
            window.location.assign('customerHome.php');
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