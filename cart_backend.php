<?php 
session_start();
          $dbcon = new PDO("mysql:host=localhost:3306;dbname=beshvusha;","root","");
          $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $db = new mysqli('localhost', 'root','', 'beshvusha');
         
    if(isset($_POST['btn-addToCart']))
    {
        $size=$_POST['size'];
        $quantity=$_POST['quantity'];
        $productid=$_POST['productid'];
       
        $data=SearchProductDetails($db,$productid);

       
			$pname =  $data['name'];
			$pprice = $data['price'];
			$pimage = $data['product_image'];
			$pcode =  $data['id'];
            $userid = $_SESSION['ownerID'];
			$total_price=(int)$quantity * (int)$pprice;
            

           
         


            $sql = "INSERT INTO cart(product_name,product_price,product_image,quantity,total_price,product_code,userID,size) VALUES ('$pname', '$pprice', '$pimage','$quantity','$total_price', $pcode,'$userid','$size')";
            
            $dbcon->query($sql);
            
          
            
			

			header("Location:cart.php");	

    }


    function SearchProductDetails($db,$pid)
	{
		$sql="select * from products where id ='$pid';";
		$result = mysqli_query($db,$sql);

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
		mysqli_free_result($result);
		mysqli_close($db);

		return $row;
	}

?>