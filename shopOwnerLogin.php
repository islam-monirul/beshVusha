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
    <title>Shop Owner Login</title>
    
</head>

<body>
    <div class="container" style="padding-top: 40px;">

        <div class="row">
            <h3 style="text-align: center;font-weight: 700;">Shop Owner Login</h3>
            <div class="col-lg-3"></div>
            <div class="col-lg-6 mt-3" style="border: 1px solid #E9EBEC;padding: 50px;">

              <form action="verifyShopOwner.php" method="POST">
                <div class="mb-3">
                  <label for="ownerEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="ownerEmail" name="emailOwner" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="ownerPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="ownerPassword" name="passwordOwner">
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-success">Login</button>
                </div>
              </form>

              <a href="shopOwnerRegister.php" id="login_anchor"><i class="fas fa-user-plus"></i>  New here ? Open an Account. </a>
              <h6 style="text-align:center;margin-top: 10px;color: grey;">--- OR ---</h6>
              <a href="index.php" style="text-decoration: none;color: green;font-weight: 600;display: block;text-align: center;margin-top: 10px;"><i class="fas fa-arrow-circle-left"></i>  Return to Homepage</a>

            </div>
            <div class="col-lg-3"></div>

        </div>

    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>