<?php
session_start();
?>

<html>
<head>
<title>Final Invoice</title>
</head>

<body bgcolor="#EF9A9A">

<h1 align="center"> ONLINE RETAIL MANAGMENT SYSTEM </h1>

<form method='post'>
<?php

	$username=$email="";
	if(isset($_SESSION["username"]) && isset($_SESSION["email"]))
	{
		$username = $_SESSION['username'];
		$email = $_SESSION['email'];
	}
if(isset($_POST['logout']))
{
	session_destroy();
	header("location: http://localhost/Php-practice/Online-Retail-Management-System-master/dbms%20code/retailindex.php");
	exit();
}
echo "<input type='submit' name='logout' value='Logout'>"
	."<div align='right'>Welcome ".$username." <br>". $email."</div>";



?>
</form>

	<h2 align="center">Connecting to Online Transaction Portal . . .</h2>
<?php
$i=0;$j=0;$myid=0;$total = 0;$gt=0;

					$host="localhost";
					$user="harsh";
					$password="H";
					$database="mydb";
		
					$connect=mysqli_connect($host,$user,$password,$database);
					if($connect)
					{
					}
					else
					die(mysqli_error());
					
					if (mysqli_connect_errno())
  					{
  						echo "Failed to connect to server: " . mysqli_connect_error();
  					}
		
					$select = mysqli_select_db($connect,$database);
					if($select)
					{
					}
					else
					die(mysqli_error($connect));
				echo"<h3 align='center'>INVOICE</h3>
					<table border='1' bgcolor='#00B8D4' align='center' width='40%'>
					<tr>
					<td width='20%'><strong><h4 align='center'>Product Name</h4></strong></td>
					<td width='10%'><strong><h4 align='center'>Cost</h4></strong></td>
					<td width='10%'><strong><h4 align='center'>Quantity</h4></strong></td>
					<td width='10%'><strong><h4 align='center'>Total</h4></strong></td>
					</tr>";
while($i<=$_SESSION['count'])
{			


					


	if(!empty($_SESSION['id'][$i]))
	{
					$myid = $_SESSION['id'][$i];
					$myquantity = $_SESSION['quantity'][$i];
					$query = "SELECT*
						FROM product
						WHERE p_id='$myid'";
					$result = mysqli_query($connect,$query) or die(mysqli_error());

					while($rows = mysqli_fetch_assoc($result))
						{
							extract($rows);
							$total = $p_cost * $myquantity;
							$gt = $gt + $total;
							echo "
								<tr bgcolor='#FFF9C4'>
								<td width='10%'><strong>$p_name</strong></td>
								<td width='10%'><strong>$p_cost/-</strong></td>
								<td width='10%'><strong>".$myquantity."</strong></td>
								<td width='10%'><strong>".$total."</strong></td>
								</tr>
								";


						}
					
						

						


// print_r($_SESSION['id'][$i]);echo "<br>";
// print_r($_SESSION['quantity'][$i]);echo "<br>";

	}
$i++;
}
?>
<?php
echo"</table>";
echo"<table border='1' bgcolor='#00B8D4' align='center' width='40%'>
						<tr>
							
						<td width='41%' align='right'><strong>Grand Total:</strong></td>
						<td width='10%'><strong>".$gt."/-</strong></td>
					</tr></table>";
	echo"<form method='post'>
	<p align = 'center'><input type='submit' name='cancel' value='Go back to shop'>
	<input type='submit' name='Done' value='Proceed'></p></form>";


	if(isset($_POST['cancel']))
{
	echo "hi";
	header("location: http://localhost/Php-practice/Online-Retail-Management-System-master/dbms code/retailshop.php");
	exit();
}

if(isset($_POST['Done']))
{
$i=0;$j=0;$myid=0;$total = 0;$gt=0;

while($i<=$_SESSION['count'])
{			


					


	if(!empty($_SESSION['id'][$i]))
	{
					$myid = $_SESSION['id'][$i];
					$myquantity = $_SESSION['quantity'][$i];
					$query = "UPDATE
						product
						set p_quantity=p_quantity-'$myquantity'
						WHERE p_id='$myid'";
					$result = mysqli_query($connect,$query) or die(mysqli_error());


				
						

						


// print_r($_SESSION['id'][$i]);echo "<br>";
// print_r($_SESSION['quantity'][$i]);echo "<br>";

	}
$i++;
}
	header("location: http://localhost/Php-practice/Online-Retail-Management-System-master/dbms code/retailshop.php");
	exit();
}
?>

</body>
</html>

