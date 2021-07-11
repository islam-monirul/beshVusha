<?php

    $db = new mysqli('localhost', 'root', '', 'beshvusha'); 

	if(isset($_POST['qty'])){
		$qty= $_POST['qty'];
		$pid =$_POST['pid'];
		$pprice= $_POST['pprice'];

		$tprice = $qty*$pprice;

		$stmt = $db->prepare("update cart set quantity=?, total_price=? where id=?");

		$stmt-> bind_param("isi", $qty,$tprice,$pid);
		$stmt-> execute();


	}


    if(isset($_GET['clear']))
	{

		$user_id=$_GET['clear'];

        
		$sql= $db->prepare("delete from cart where userID like '$user_id'");
		$sql->execute();
		
		header('location:cart.php');

	}

    if(isset($_GET['remove'])){
		$id = $_GET['remove'];

		$sql = $db->prepare("delete from cart where id=?");
		$sql->bind_param("i", $id);
		$sql->execute();

		
		header('location:cart.php');

	}


?>