<?php
// $conn_error = 'Could not connect';
//
// $mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
// $mysql_user = 'vinodsai';
// $mysql_pass = 'Sai_1234';
//
// $mysql_db = 'coupons_app_data';
// $mysql_table = 'sign_in_table';
//
// $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_pass, $mysql_db);
// if($conn === false){
//
//  die($conn_error);
//
// }else{
// 	// echo '<p align="center">Connected</p>';
// }

require 'db_connect.php';
$mysql_table = 'sign_in_table';


// <form action="sign_up.php" method="GET">
//
// 	<p>Name: </p><input type="text" name="username"/></br>
// 	<p>Password: </p><input type="password" name="password"/></br>
// 	<p>Referred By: </p><input type="text" name="referred_by"/></br>
// 	<p>Referral Code: </p><input type="text" name="referral_code"/></br>
// 	<p>Wallet Balance: </p><input type="text" name="wallet_balance"/></br>
// 	<input type="Submit" value="Signup"/>
// </form>

?>
<?php
	if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['referral_code'])
			 && isset($_GET['referred_by']))
      {
		$username = $_GET['username'];
		$password = $_GET['password'];
		$referred_by = $_GET['referred_by'];
		$referral_code = $_GET['referral_code'];
		// $wallet_balance = $_GET['wallet_balance'];

		if((!empty($username)) && (!empty($password)) && (!empty($referral_code)) )
    {
			// $query = "INSERT INTO '".$mysql_table."' (id, username,password,referred_by,referral_code,wallet_balance) VALUES(NULL,'".$username."','".$password."','".$referred_by."','".$referral_code."','".$wallet_balance."')";
      $query = "INSERT INTO `sign_in_table` (`id`, `username`, `password`, `referred_by`,
         `referral_code`, `wallet_balance`) VALUES (NULL, '".$username
         ."', '".$password."', '".$referred_by
         ."', '".$referral_code."', '0')";

				if($query_run  = mysqli_query($conn, $query)){
          $last_id = mysqli_insert_id($conn);
          // primary database updated once
          // echo ''.$referred_by.'</br>'.$last_id;
        // echo 'Successfully Updated';


          $returnData['success'] = true;
				  if($referred_by == null){
				      $returnData['referral_null']= true;
							echo json_encode($returnData);
							return true;
          }else{
				      $returnData['referral_null'] =false;
							// echo "</br> Result error".mysqli_error($conn)."</br>";
          // echo ''.$referred_by;
          $query = "SELECT * FROM sign_in_table WHERE referral_code = '".$referred_by."'";
          $myquery = mysqli_query($conn, $query);
				  if(!$myquery){
				    $returnData['referral_code'] = false;
            // echo "".mysqli_error($conn);
          }else{
				  $rowcount=mysqli_num_rows($myquery);
          // echo "Result set has %d rows.".$rowcount;
  					if(mysqli_num_rows($myquery)>0){
					    while ($row = mysqli_fetch_assoc($myquery)) {
					      $messMe = $row["id"];
	              // echo '</br>hi '.$messMe.' Hello '.$row['referral_code'].' me '.$last_id.' Hello</br>';
	              $addingbalancequery = "INSERT INTO wallet_transactions(user_id,
	                  amount, description, referred_id) VALUES('".$row['id']."',
	                  '49','Referred by Him','".$row["referral_code"]."')";
	              if($data = mysqli_query($conn, $addingbalancequery)){
	                // echo 'success';
					        $returnData['referral_activation'] = true;
	                $returnData['referral_code'] = true;
	              }else{
					        // echo "</br> Result error".mysqli_error($conn);
	              }
					      # updated database for 2nd user_id
	              $firstpersonquery = "INSERT INTO wallet_transactions (user_id,
	                  amount, description,referred_id) VALUES('".$last_id."',
	                  '49','Referral inserted','".$row['referral_code']."')";
	              if($data = mysqli_query($conn, $firstpersonquery)){
	              // echo 'success';
	                $returnData['referred_by_activation'] = true;
	                $returnData['referral_code'] = true;
	              }else{
	              // echo "</br> Result error".mysqli_error($conn)."</br>";
	            }


	            }

	            echo json_encode($returnData);
	            return true;
            // echo 'referral exists. You earn Rs.49';
          }

          else {

              $returnData['referral_code']=false;
              echo json_encode($returnData);
              return true;
          }
        }
      }

        }else{
				    $returnData['success']=false;
            echo json_encode($returnData);
            return true;
            // echo "error: ".mysqli_error($conn);
          }

      }
    }
//
//           $newwithwalletbalance = 49;
//           $addbalancequery = "UPDATE 'sign_in_table' SET 'wallet_balance' = ".$newwithwalletbalance." WHERE 'username' = ".$username ;
//           mysqli_query($conn, $addbalancequery);
//           if(mysqli_num_rows($myquery)>0){
//             while ($row = mysqli_fetch_assoc($myquery)) {
//               $final_balance = $row['wallet_balance'] + 49
//               // $querygetbalance = "SELECT * from 'sign_in_table' where 'referral_code' = '".$row['referral_code']."'";
//                 # code...
//             }
//           }else{ echo 'your friend is not found in the database';}
//
//           $query = "UPDATE 'sign_in_table' SET 'wallet_balance' = ".$final_balance
//             ." WHERE 'username' LIKE ".$row['username'];
//           if($setquery = mysqli_query($conn, $query)){
//             echo 'updated wallet balance for your friend';
//
//           } else{
//             echo 'something went wrong, contact help..'
//           }
//
//           //////////////////////////////////////////////////////////////////////////////pending query
//
//           // $query ="INSERT INTO 'sign_in_table' ('wallet_balance') VALUES('"
//           //     .(wallet_balance+Rs49)."') WHERE 'username' LIKE ".username;
//         }else{
//           echo ("Basic Search for Friend Error: Contact Admin. Error description: " . mysqli_error($conn))
//         }
//       }
//       else{
//         // echo "".$query."";
//         // echo 'query didnt run';
//         echo ("Error in Updating Query... Error description: " . mysqli_error($conn));
//       }
// 	}else{
//     echo 'data should not be empty';
//   }
// }else {
//   echo " not getting the required data";
// }
mysqli_close($conn);
?>
