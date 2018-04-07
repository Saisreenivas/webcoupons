<?php
$conn_error = 'Could not connect';

// $mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
// $mysql_user = 'vinodsai';
// $mysql_pass = 'Sai_1234';
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "1";

// $mysql_host = 'localhost';
// $mysql_user = 'digvaypr';
// $mysql_pass = 'Amitarun22@@';

$mysql_db = 'coupons_app_data';
// $mysql_db = 'digvaypr_couponsapp';
$mysql_table = 'sign_in_table';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
if($conn === false){

 die($conn_error);

}else{
	// echo '<p align="center">Connected</p>';
}

// <!-- <form action="sign_in.php" method="GET" id="hello">
//
// 	<p>Name: </p><input type="text" name="username"/></br>
// 	<p>Password: </p><input type="password" name="password"/></br>
// 	<input type="Submit" value="SignIn"/>
// </form> -->

?>
