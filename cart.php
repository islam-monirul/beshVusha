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

          
          $db = new mysqli('Localhost', 'root', '', 'beshvusha');

          $userid = $_SESSION['ownerID'];
          $prodFetch="SELECT * from cart where userID='$userid';";
          try{
            $allprodData=$dbcon->query($prodFetch);
            $prodResult=$allprodData->fetchAll();

           
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
                <title>Cart | beshVusha</title>

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
   
    <!-- cart start -->
    <div class="pa-cart spacer-top spacer-bottom">
        <div class="container">
            <div class="row" style="padding-top: 100px;">
                <div class="col-12">

                            <?php 

                                foreach($prodResult as $key=> $data)
                                {
                            ?>


                            <?php 
                                }

                            ?>


                    <table class="table table-bordered table-striped text-center">
						<thead>
							<tr>
							<td colspan="8" style="background-color: #6610f2;">
								<h4 class="text-center m-0" style="color: white;">Products in you cart</h4>
								
							</td>

						</tr>

						<tr>
							<th>No.</th>
							<th>Image</th>
							<th>Product</th>
                            <th>Size</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total Price</th>
							<th>
								<a style="color:red;" href="action.php?clear=<?= $userid ?>" class="badge-danger badge p-2" onclick="return confirm('Are you sure want to clear the CART?')"><i class="fa fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
							</th>

						</tr>
						
						</thead>

						<tbody>
							<?php
								$userID = $_SESSION['ownerID'];
								$sql=$db->prepare("Select * from cart where userID='$userID'");
								$sql->execute();
								$result= $sql->get_result();
								$grand_total=0;
								$i=1;
								while ($row = $result->fetch_assoc()):
							?>

							<tr>
								<td><?= $i ?></td>
								<input type="hidden" class="pid" value="<?= $row['id'] ?>">
								<td><img src="sources/products/<?= $row['product_image'] ?>" width="50"></td>
								<td><?= $row['product_name']?></td>
								<td>BDT <?= number_format($row['product_price'],2); ?></td>
								<td><?= $row['size'] ?></td>
								<input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">


								<!--auto update with quantity in cart page--->
								<td class="text-center"><input type="number" class="form-control itemQty" value="<?= $row['quantity'] ?>"  style="width:75px;">
								</td>

								<td>BDT <?= number_format($row['total_price'],2); ?></td>

								<td>
								<a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure to Remove this ITEM?');"><i class="fa fa-trash"></i></a>
								</td>
							</tr>

							<?php $grand_total+= $row['total_price']; ?>
						<?php $i=$i+1; endwhile; ?>

						<tr>
							<td colspan="3" style="text-align: left;padding: 15px;">
								<a href="customerHome.php" class="btn btn-warning"><i class="fa fa-cart-plus"></i>&nbsp; Continue Shopping</a>
								
							</td>


							<td colspan="3" style="padding: 15px;"><b>Grand Total</b> </td>
							<td style="padding: 15px;"><b>BDT <?= number_format($grand_total,2); ?></b></td>
							<td style="padding: 15px;">
								<a href="placeOrder.php" class="btn btn-success"><i class="fa fa-credit-card"></i>&nbsp;&nbsp; Place Order</a>

								
							</td>
						</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
    <!-- cart end -->

                <script>
                    
                    var elm=document.getElementById('logoutbtn');
                    elm.addEventListener('click',processlogout);
                    
                    function processlogout(){
                        window.location.assign('logoutprocess.php');
                    }
                
                </script>

                <script>
                    function addToWishlist(prodID){
                      window.location.assign("wishList.php?id="+prodID);
                    }

                    function details(prodID){
                      window.location.assign("productDetails.php?id="+prodID);
                    }
                    
                </script>

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        ///this funxtion works with updating the quantity update in the cart table
                        $(".itemQty").on('change', function(){
                            var $el =$(this).closest('tr');

                            var pid = $el.find(".pid").val();
                            var pprice = $el.find(".pprice").val();
                            var qty = $el.find(".itemQty").val() ;
                            location.reload(true);


                            $.ajax({
                                url: 'action.php',
                                method: 'post',
                                cache : false,
                                data: {qty:qty, pid:pid, pprice:pprice},
                                success: function(response){

                                    console.log(response);
                                }
                            });
                        });
                        

                    });


                </script>
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