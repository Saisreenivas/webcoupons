<?php
$conn_error = 'Could not connect';

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '1';

$mysql_db = 'coupons_app_data';
$mysql_table = 'sign_in_table';

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
if($conn === false){

 die($conn_error);

}else{
	// echo '<p align="center">Connected</p>';
}?>
<?php
// <form action="icubes_api_my_db.php" method="GET" id="hello">
// <p>Name: </p><input type="text" name="username"/></br>
// <p>Password: </p><input type="password" name="password"/></br>
// <input type="Submit" value="SignIn"/>
// </form>
$store="icubeswire";
$presentDate = getDate()['year']."-".getDate()['mon']."-".getDate()['mday'];
$query = "SELECT * FROM offers_database WHERE api_name LIKE 'icubeswire' AND offer_expiry_date > '".$presentDate."'  ";

$query_run = mysqli_query($conn, $query);
$my_array = array();
if(mysqli_num_rows($query_run)>0){
  while($row = mysqli_fetch_assoc($query_run)){
    $returnData['ID'] = $row['offer_id'];
    $returnData['Campaign_Name']=$row['offer_company'];
    $returnData['Title']= $row['offer_title'];
    $returnData['Description'] =$row['offer_description'];
    $returnData['Category'] = $row['offer_category'];
    $returnData['Tracking_URL'] =$row['offer_tracking_url'];

    array_push($my_array, $returnData);
  }

  echo json_encode($my_array);
}

?>
