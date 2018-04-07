<?php
// $conn_error = 'Could not connect';
// $mysql_host = 'peak.cwtinczi5fmr.us-east-2.rds.amazonaws.com';
// $mysql_user = 'vinodsai';
// $mysql_pass = 'Sai_1234';
//
// $mysql_db = 'coupons_app_data';
// $mysql_table = 'offers_database';
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
$mysql_table = 'offers_database';
$presentDate = getDate()['year']."-".getDate()['mon']."-".getDate()['mday'];
?>
<?php


$categories = ['Fashion', 'Food & Dining', 'Travel', 'Mobiles & Tablets',
'Beauty & Health', 'Recharge', 'Computers, Laptops & Gaming', 'Appliances',
'Home Furnishing & Decor', 'Computers & Accessories', 'Flowers,Gifts & Jewellery',
'Miscellaneous'];
// 'Kids,Babies & Toys', 'Web Hosting & Domains', 'Books & Stationary',
// 'Automotive', 'Adult','Education & Learning', 'Local Services'];

$sub_categories=['Clothing','Footwear','Bags & Accessories','Lingerie',
'Food & Ordering', 'Pizza', 'Drinks & beverages', 'Grocery',
'Flight','Hotel','Bus','Cabs',
'Mobiles','Mobile Accessories','Tablet','Tablet & Accessories',
'Personal Care & Beauty', 'Nutrition', 'Health & Devices' ,'Perfumes & Deos',
'Bill Payments','Mobile Recharge','DTH','Recharges',
'Computer & Accessories','Laptops Monitors & Desktops', 'Gaming', 'Software',
'Kitchen Appliances','Personal Care & Appliances', 'Home Appliances','Cleaning & Appliances',
'Furniture & Decor', 'Kitchen & Dining', 'Bed & Bath', 'Tools',
'Camera Accessories', 'Cameras',' ' ,' ',
'Jewellery', 'Gifts', 'Flowers & Cakes', 'Gold Coins & Bars',
'Others','Pet & products', 'Matrimonial','Financial & Services'];

$categ_array = array();

$i=0;
$j=4;
$cont =0;

foreach ($categories as $category) {
  // '$'.str_replace(" ","", $category);
  # code...
  $k=1;
  $sub_cat = array();
  $sub_cat['name'] = 'All';
  for ($i=$i;$i<$j;$i++) {
    # code...

    if(strpos($sub_categories[$i], ' ') !== false || strpos($sub_categories[$i], '&') !==  false)   {

      if(strpos($sub_categories[$i], '&') !== false){
        $cont =1;
        $word = explode(' & ', $sub_categories[$i]);
      }
      $sub_category = str_replace(" ", "%",$sub_categories[$i] );
      $sub_category = str_replace("&%", "",$sub_category );

    }else{
      $sub_category = $sub_categories[$i];
    }

if($cont == 0){
    $query = "SELECT * FROM `offers_database`  where `offer_expiry_date` > '".$presentDate."'
    and offer_description LIKE '%".$sub_category."%' OR  offer_company LIKE '%".$sub_category
    ."%' OR offer_title LIKE '%".$sub_category."%';";

    $myquery = mysqli_query($conn, $query);
    $count = mysqli_num_rows($myquery);
    // if($count >10){

    // }

// echo $i.'</br>';

    $sub_cat['name'.$k] = $sub_categories[$i];
    $sub_cat['data'.$k] = $count;
    $k++;
    // $sub_cat[$sub_categories[$i]] = $count;
  }else{
    $query = "SELECT * FROM `offers_database`  where `offer_expiry_date` > '"
      .$presentDate."' and offer_description LIKE '%".$word[0]."%' OR
      offer_description LIKE '%".$word[1]."%' OR  offer_company LIKE '%".$word[0]
      ."%' OR  offer_company LIKE '%".$word[1]."%'  OR offer_title
      like '%".$word[0]."%' or offer_title like '%".$word[1]."%'";

        $myquery = mysqli_query($conn, $query);
        $count = mysqli_num_rows($myquery);
        $sub_cat['name'.$k] = $sub_categories[$i];
        $sub_cat['data'.$k] = $count;
        $cont =0;
        $k++;
        // $sub_categories[$i]
  }


  }

  $j=$j+4;
  // echo $category.'</br>';

  $hey['offer_category'] = $category;
  $hey['data'] =  $sub_cat;
  array_push($categ_array,$hey);

}
echo json_encode($categ_array);
?>
