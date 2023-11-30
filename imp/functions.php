<?php
/*
login function
*/
function login($email , $password){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select * from users where email='".$email."' and password='".md5($password)."' and ( user_status='ACTIVE')";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "Invalid Username and / or Password 1";
						$status[2] = $sql;
					}
					else{
						while($rw = mysqli_fetch_array($xsql)){
							
							$_SESSION['user']['user_id'] = $rw['user_id'];
							$_SESSION['user']['email'] = $rw['email'];
							$_SESSION['user']['password'] = $rw['password'];
							$_SESSION['user']['firstname'] = $rw['firstname'];
							$_SESSION['user']['lastname'] = $rw['lastname'];
							$_SESSION['user']['phone_number'] = $rw['phone'];
							$_SESSION['user']['address'] = $rw['address'];
							$_SESSION['user']['city'] = $rw['city'];
							$_SESSION['user']['state'] = $rw['state'];
							$_SESSION['user']['user_type_id'] = $rw['user_type_id'];
							$_SESSION['user']['status'] = $rw['user_status'];
							$_SESSION['user']['last_logon_date'] = $rw['last_logon'];
							
							
							
							$sql2 = "UPDATE `users` SET `last_logon`='".date("Y-m-d H:i:s")."' WHERE email='".$_SESSION['user']['email']."'";
							
							$xsql2 = mysqli_query($conn,$sql2);
							
							if($xsql2){
								$status[0] = true;
								$status[1] = "loggon on successful";
								$status[2] = $sql2;
							}
						}
					}
				}
				else{
					$status[0] = false;
					$status[1] = "server busy, try again";
					
				}
				
	return $status;
}
/*
end login function
*/

/*
register function
*/
function register($email, $cpassword, $vpassword, $firstname, $lastname, $phone_number, $user_type_id){
	global $conn;
	$status[0] = false;
	$status[1] = "";
	
	if($cpassword == $vpassword){		
		$sql = "select * from users where email='".$email."'";
		$xsql = mysqli_query($conn,$sql);
		if($xsql){
			if(mysqli_affected_rows($conn)==0){
				$status[1] = "User does not exist yet";
					$ins = "INSERT INTO `users`(`email`, `phone`, `password`, `firstname`, `lastname`,`last_logon`, `user_status`,`user_type_id`) 
					VALUES ('". strtolower($email)."' , '".$phone_number."' , '".md5($cpassword)."' , '". ucfirst(strtolower($firstname))."', '".ucfirst(strtolower($lastname))."' ,  '".date("Y-m-d H:i:s")."' , 'ACTIVE', '".$user_type_id."') ";
				
				$status[2] = $ins;
				
				//$status[0] = true;
				//$status[1] = "User Successfully Registered";
				$xins = mysqli_query($conn,$ins);
				if($xins){
					$status = login( $email , $cpassword);
				}

			}	
			else{
				$status[0] = false;
				$status[1] = "Email already registered, please login / recover password";
				$status[2] = $ins;
			}
		}
		else{
			$status[1] = "trying to select user failed";
			$status[2] = "User does not exist yet";
		}
	}
	else{
		$status[0] = false;
		$status[1] = $sql;
	}

return $status;		
}
/*
end register function
*/

/*
logout function
*/
function logout($user_id){
	global $conn;
	$sql2 = "UPDATE `users` SET 1=1 WHERE user_id='".$user_id."'";
							
							$xsql2 = mysqli_query($conn,$sql2);
							if($xsql2){
									
								}
								else{
									
								}
}
/*
end logout function
*/

/*
calculate number of items in cart
*/
function calc_num_of_items(){
	
		$numofitems = 0;
		$totalamount = 0;
if(!isset($_SESSION['cart'])){ $numofitems=0;}
else{
	
	//var_dump($_SESSION['cart']);
	  foreach($_SESSION['cart'] as $product_id => $quantity){
			  
			  $numofitems = $numofitems + $quantity;
			  
	  }
}
	 return $numofitems;
}


function calc_total_cart(){
	global $conn;
$numofitems = 0;
$totalamount=0;

if(!isset($_SESSION['cart'])){ $totalamount=0.00;}
else{
foreach($_SESSION['cart'] as $product_id => $valx){
		  
		  foreach($_SESSION['cart'] as $product_id => $quantity){
			  //$prod_det = fetch_prod($product_id);
			  $product_id;
			  $sql = "select product_price from product where product_id='".$product_id."'";
			  $xsql = mysqli_query($conn,$sql);
			  $quantity;
			  $numofitems = $numofitems + $quantity;
			  if($xsql){
					while($rw=mysqli_fetch_array($xsql)){
							$totalamount = $totalamount + ($rw['product_price'] *$quantity);		
					} 
				}
			  
		  }

}
}
return number_format((float)($totalamount), 2, '.', '');	
}

/**
category function
**/
function category(){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select * from product_category";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "No category";
					}
					else{
						$count = 0;
						$status[0] = true;
						$status[1] = "success";
						while($rw=mysqli_fetch_array($xsql)){
							
							$status[2][$count]['category_id'] = $rw['category_id'];
							$status[2][$count]['category_name'] = $rw['category_name'];
							$count++;
						}	
					}
				}
				else{
					$status[0] = false;
					$status[1] = "Error";
				}
	return $status;
}
/**
end category function
**/




/**
farm function
**/
function farm(){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select * from farm";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "No Farm";
					}
					else{
						$count = 0;
						$status[0] = true;
						$status[1] = "success";
						while($rw=mysqli_fetch_array($xsql)){
							
							$status[2][$count]['farm_id'] = $rw['farm_id'];
							$status[2][$count]['farm_name'] = $rw['farm_name'];
							$status[2][$count]['address'] = $rw['address'];
							$status[2][$count]['email'] = $rw['email'];
							$status[2][$count]['phone'] = $rw['phone'];
							$status[2][$count]['admin_id'] = $rw['admin_id'];
							$count++;
						}	
					}
				}
				else{
					$status[0] = false;
					$status[1] = "Error";
				}
	return $status;
}
/**
end farm function
**/




/**
get farm function
**/
function get_farm($farm_id){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select * from farm where farm_id='".$farm_id."'";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "No Farm";
					}
					else{
						$count = 0;
						$status[0] = true;
						$status[1] = "success";
						while($rw=mysqli_fetch_array($xsql)){
							
							$status[2][$count]['farm_id'] = $rw['farm_id'];
							$status[2][$count]['farm_name'] = $rw['farm_name'];
							$status[2][$count]['address'] = $rw['address'];
							$status[2][$count]['email'] = $rw['email'];
							$status[2][$count]['phone'] = $rw['phone'];
							$status[2][$count]['admin_id'] = $rw['admin_id'];
							$count++;
						}	
					}
				}
				else{
					$status[0] = false;
					$status[1] = "Error";
				}
	return $status;
}
/**
end get farm function
**/

/**
get_product_cat($val['farm_id']);
**/
function get_product_cat_id($farm_id){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select distinct category_id from  product where store_id='".$farm_id."'";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "No Farm";
					}
					else{
						$count = 0;
						$status[0] = true;
						$status[1] = "success";
						while($rw=mysqli_fetch_array($xsql)){
							
							$status[2][$count]['category_id'] = $rw['category_id'];
							$count++;
						}	
					}
				}
				else{
					$status[0] = false;
					$status[1] = "Error";
				}
	return $status;
}
/**
end get_product_cat($val['farm_id']);
**/



/**
get_products($farm_id) function
**/
function get_products($farm_id){
	global $conn;
	$status[0] = false;
	$status[1] = "";
						//$status[1] = "Invalid Username and / or Password";
	$sql = "select * from product where store_id='".$farm_id."'";
				$xsql = mysqli_query($conn,$sql);
				
				
				if($xsql){
					if(mysqli_affected_rows($conn)==0){
						$status[0] = false;
						$status[1] = "No Farm";
					}
					else{
						$count = 0;
						$status[0] = true;
						$status[1] = "success";
						while($rw=mysqli_fetch_array($xsql)){
							
							$status[2][$count]['product_id'] = $rw['product_id'];
							$status[2][$count]['product_name'] = $rw['product_name'];
							$status[2][$count]['product_description'] = $rw['product_description'];
							$status[2][$count]['product_price'] = $rw['product_price'];
							$status[2][$count]['category_id'] = $rw['category_id'];
							$status[2][$count]['store_id'] = $rw['store_id'];
							$count++;
						}	
					}
				}
				else{
					$status[0] = false;
					$status[1] = "Error";
				}
	return $status;
	
}
/**
end get_products($farm_id) function
**/

/**
add to cart function;
**/
function add_to_cart(){
	if(isset($_POST['addtocart'])){
		
		
		
			if(!empty($_POST['prodid'])){
					$product_id = $_POST['prodid'];
					$quantity = 1;
					
					//$stat = calc_remaining_prod($product_id);
					$stat[0] =true;
					$stat[1] = $quantity +1;
					
					if($stat[0]==true and $stat[1] >= $quantity){
						
											if(isset($_SESSION['cart'][$product_id])){
											//if the product and size has been formally selected
												$temp = $_SESSION['cart'][$product_id] + $quantity;
												if($temp <= $stat[1]){
							
												$_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] + $quantity;
												}
												//else{
						
												//}
					
											//end if the product and size has been formally selected					
											}
											else{
													$_SESSION['cart'][$product_id] = $quantity ;	
											
												}
												
					}
					else{
						
						if(isset($_SESSION['cart'][$product_id])){
							$_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] + $quantity;
						}
						else{
							$_SESSION['cart'][$product_id] = $quantity ;	
						}
						//echo"stock is lesser than: ". $quantity;	
					}
		
			}
	}	
}
/**
add to cart function;
**/
?>
