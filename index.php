<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- font load -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="sources/css/style.css" type="text/css">

    <title>BeshVusha</title>
  </head>

  <body>
    <!-- navbar -->
    <header class="index_header">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="index.php">
            <img src="sources/images/logo2.png" width="150" height="55" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-lg-auto">
              <li class="nav-item active">
                <button type="button" class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#loginBtn">Login</button>
              </li>
              <li class="nav-item">
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#regBtn">Signup</button>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      
      <!-- Login Modal -->
      <div class="modal fade" id="loginBtn" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loginModal">Login as</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div>
                      <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" onclick="customerLogin()">Customer</button>
                    </div>
                    <h6 style="text-align:center;color: grey;">--- OR ---</h6>
                    <div>
                      <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" onclick="shopOwnerLogin()">Shop Owner</button>
                    </div>
                    <h6 style="text-align:center;color: grey;">--- OR ---</h6>
                    <div>
                      <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" onclick="adminLogin()">Admin</button>
                    </div>
              </div>
          </div>
        </div>
      </div>

      <!-- Registration Modal -->
      <div class="modal fade" id="regBtn" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="loginModal">Register as</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div>
                      <button type="button" class="btn btn-outline-primary btn-lg btn-block mb-2" onclick="customerRegister()">Customer</button>
                    </div>
                    <h6 style="text-align:center;color: grey;">--- OR ---</h6>
                    <div>
                      <button type="button" class="btn btn-outline-primary btn-lg btn-block" onclick="shopOwnerRegister()">Shop Owner</button>
                    </div>
              </div>
          </div>
        </div>
      </div>

    </header>

    <section class="banner">
      <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <img src="sources/images/image2.png" alt="" class="img-fluid">
              <h2>Largest Online Clothing Store</h2>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae itaque hic odit dolorem sint labore.</p>
              <button type="button" class="btn btn-outline-dark ">EXPLORE MORE ABOUT US</button>
            </div>
          </div>
      </div>
    </section>

    <section class="about">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2>ABOUT US</h2>
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus ut eius debitis nostrum earum facere saepe dolores harum laborum esse, voluptas natus magnam nisi tenetur pariatur! Voluptate, at modi aut asperiores dignissimos autem deleniti mollitia! Nisi expedita commodi at, saepe omnis earum natus soluta officia dolorem, quo doloribus veritatis voluptas?</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam voluptatum corporis autem eveniet rerum vel sunt, cupiditate atque ea dolorum non neque, sapiente velit asperiores iste. Id pariatur minima deserunt.</p>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In obcaecati tempore modi veniam corrupti at doloribus pariatur ea fuga quidem?</p>
            </div>
          </div>
        </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p>Copyright © 2021 | All Rights Reserved by BeshVusha</p>
          </div>
        </div>
      </div>
    </footer>

    <script>
      //login part
      function customerLogin() {
         window.location.assign('customerLogin.php');
       }

       function shopOwnerLogin() {
         window.location.assign('shopOwnerLogin.php');
       }

       function adminLogin() {
         window.location.assign('adminLogin.php');
       }


       //registration part
       function customerRegister(){
         window.location.assign('customerRegistration.php');
       }

       function shopOwnerRegister(){
         window.location.assign('shopOwnerRegister.php');
       }

    </script>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>