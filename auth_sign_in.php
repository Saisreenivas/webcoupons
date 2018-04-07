<?php

require 'db_connect.php';
$mysql_table = 'sign_in_table';


?>
<?php
	if(isset($_GET['username']) && isset($_GET['login_via']))
      {
		$username = $_GET['username'];
		$login_via = $_GET['login_via'];

		if((!empty($username)) && (!empty($login_via)))
    {
			// $query = "INSERT INTO '".$mysql_table."' (id, username,password,referred_by,referral_code,wallet_balance) VALUES(NULL,'".$username."','".$password."','".$referred_by."','".$referral_code."','".$wallet_balance."')";
      $query = "SELECT * FROM sign_in_table WHERE username LIKE '".$username."'";
      $query_run = mysqli_query($conn, $query);
      if(mysqli_num_rows($query_run)>0){


          while ($row = mysqli_fetch_assoc($query_run)) {
            $returnData['referral_code'] = $row['referral_code'];
            $query = 'SELECT SUM(amount) as wallet_balance FROM `wallet_transactions` WHERE user_id = '.$row['id'];

            if(mysqli_num_rows(mysqli_query($conn, $query))>0){
              while($row = mysqli_fetch_assoc(mysqli_query($conn, $query))){
                // echo $row['wallet_balance'].': Wallet Balance';

								$returnData['wallet_balance'] = $row['wallet_balance'];
                $returnData['success'] = true;
                //
								if($returnData['wallet_balance'] == null){
									$returnData['wallet_balance'] = 0;
								}
                echo json_encode($returnData);
                return true;
                // $myObj->success = true;
                // $myObj->wallet_balance = $row['wallet_balance'];
                // $myObj->city = "New York";

                // $myJSON = json_encode($myObj);

                // return $myJSON;
              }
            }else{
              return mysqli_error($conn);
            }

            # code...
          }
      }
      else{
        if(isset($_GET['sp_referral'])){
          // include('sign_up.php?username='.$username.'&password='.$login_via.'&referral_code='.$_GET['referral_code'].'&referred_by='.$_GET['sp_referral']);
					// include ('sign_up.php');
					$url = 'http://localhost/Coupons/sign_up.php?username='.$username.'&password='.$login_via.'&referral_code='.$_GET['referral_code'].'&referred_by='.$_GET['sp_referral'];
// echo $url.'</br>';
					$client = file_get_contents('http://localhost/Coupons/sign_up.php?username='.$username.'&password='.$login_via.'&referral_code='.$_GET['referral_code'].'&referred_by='.$_GET['sp_referral']);
// echo "1"."</br>";
					// echo $client;
					$decodedData = json_decode($client);
					// var_dump(json_decode($client));
					// foreach ($decodedData as $data) {
// echo "1"."</br>";
						if($decodedData->success == true){
							$query = "SELECT * FROM sign_in_table WHERE username LIKE '".$username."'";

							$query_run = mysqli_query($conn, $query);
// echo "1"."</br>";
							if(mysqli_num_rows($query_run)>0){
// echo "1"."</br>";

				          while ($row = mysqli_fetch_assoc($query_run)) {
// echo "1"."</br>";
								    $returnData['referral_code'] = $row['referral_code'];
				            $query = 'SELECT SUM(amount) as wallet_balance FROM `wallet_transactions` WHERE user_id = '.$row['id'];

				            if(mysqli_num_rows(mysqli_query($conn, $query))>0){
// echo "1"."</br>";
								      while($row = mysqli_fetch_assoc(mysqli_query($conn, $query))){
// echo "1"."</br>";
								        // echo $row['wallet_balance'].': Wallet Balance';
												$returnData['wallet_balance'] = $row['wallet_balance'];

				                $returnData['success'] = true;

												if($row['wallet_balance'] == null){
													$returnData['wallet_balance'] = 0;
												}
				                //
				                echo json_encode($returnData);
				                return true;
				                // $myObj->success = true;
				                // $myObj->wallet_balance = $row['wallet_balance'];
				                // $myObj->city = "New York";

				                // $myJSON = json_encode($myObj);

				                // return $myJSON;
				              }
				            }else{
				              return mysqli_error($conn);
				            }

				            # code...
				          }
				      }
						}
						# code...

				}else{
          $returnData['success']= 'new_user';
					echo json_encode($returnData);
					return true;
        }
        // return "error: ".mysqli_error($conn)."</br>";
      }
		}
		// else if(isset($_GET['login_via'])){
		// 	if($_GET['login_via'] == z6Wnf456Ond67GNEl114kjd45Fg){
		// 		$returnData['auth_verify']= 'new_user';
		// 		echo json_encode($returnData);
		// 		return true;
		// 	}
		// }
	}else{
    return 'data should not be empty';
  }


?>
